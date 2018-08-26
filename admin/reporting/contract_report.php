<?php
	require '../fpdf/fpdf.php';
	$db = new PDO('mysql:host=localhost;dbname=finalwalk','root','');

	class myPDF extends FPDF{
		function header(){
			
			$this->SetFont('Arial', 'B', 16);
			$this->Ln(10);
			$this->Cell(276,5,'QUOTATION REPORT',0,0,'C');
			$this->Ln(20);
			$this->SetFont('Times','',12);
		}

		function footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','',8);
			$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		}

		function headerTable(){
			$this->SetFont('Times','B',12);
			$this->Cell(40,10,'Quotation ID',1,0,'C');
			$this->Cell(50,10,'Quotation Date',1,0,'C');
			$this->Cell(50,10,'Quotation Cost',1,0,'C');
			$this->Cell(76.5,10,'Customer Details',1,0,'C');
			$this->Cell(76.5,10,'Employee Details',1,0,'C');
			
		}

		function viewTable($db){
			$total = 0;
			$stmt = "";
			$this->SetFont('Times','',12);

			
			$start_date = $_POST['quotation_from_date'];
			$end_date = $_POST['quotation_to_date'];
	
			
			
			if(strlen($start_date)>2 && strlen($end_date)>2){
				$stmt = $db->query('SELECT * FROM quotation WHERE Date BETWEEN "' .$start_date .'" AND "' .$end_date .'"');
				
				$stmt2 = $db->query("SELECT count(*) as total FROM quotation WHERE Date BETWEEN '" .$start_date ."' AND '" .$end_date ."'");
				if($data1 = $stmt2->fetch(PDO::FETCH_OBJ)){
					$total = $data1->total;
				}					
			}else{
				$stmt = $db->query('SELECT * FROM quotation');
				
				$stmt2 = $db->query("SELECT count(*) as total FROM quotation");
				if($data1 = $stmt2->fetch(PDO::FETCH_OBJ)){
					$total = $data1->total;
				}
			}

			while($data = $stmt->fetch(PDO::FETCH_OBJ)){
				$this->Cell(40,10, $data->QuotationID ,1,0,'L');
				$this->Cell(50,10, $data->Date ,1,0,'L');
				$this->Cell(50,10, $data->Cost ,1,0,'L');
                                $stmt3 = $db->query('SELECT * FROM customer where customer_id='.$data->CustomerID);
                                if($data3 = $stmt3->fetch(PDO::FETCH_OBJ)){
                                    $CustomerName=$data3->name;
                                }else{
                                    $CustomerName="None";
                                }
                                $stmt4 = $db->query('SELECT * FROM employee where employee_id='.$data->EmployeeID);
                                if($data4 = $stmt4->fetch(PDO::FETCH_OBJ)){
                                    $EmployeeName=$data4->name . ' ' .$data4->surname;
                                }else{
                                    $EmployeeName="None";
                                }
				$this->Cell(76.5,10, $CustomerName ,1,0,'L');
				$this->Cell(76.5,10, $EmployeeName ,1,0,'L');
				$this->Ln();
			}
			
			$this->Cell(40,10, "" ,0,0,'L');
				$this->Cell(50,10, "" ,0,0,'L');
				$this->Cell(50,10, "" ,0,0,'L');
				$this->Cell(50,10, "" ,0,0,'L');
				$this->Cell(50,10, "" ,0,0,'L');
				$this->SetFont('Times','B',12);
				$this->Cell(37,10, "Total: ". $total ,1,0,'L');
				$this->Ln();
		}
	}

	$pdf = new myPDF();
	$pdf->AliasNbPages();
	$pdf->AddPage('L', 'A4',0);
	$pdf->headerTable();
	$pdf->viewTable($db);
	$pdf->Output();
?>