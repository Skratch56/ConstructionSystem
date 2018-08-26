<?php
	require '../fpdf/fpdf.php';
	$db = new PDO('mysql:host=localhost;dbname=dbcar2','root','');

	class myPDF extends FPDF{
		function header(){
			$this->Image('../images/rsz_logo.jpg', 10, 6);
			$this->SetFont('Arial', 'B', 16);
			$this->Ln(10);
			$this->Cell(276,5,'RENTAL REPORT',0,0,'C');
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
			$this->Cell(40,10,'Booking ID',1,0,'C');
			$this->Cell(50,10,'Booking Date',1,0,'C');
			$this->Cell(50,10,'Booking Time',1,0,'C');
			$this->Cell(50,10,'Status',1,0,'C');
			$this->Cell(50,10,'Vin Number',1,0,'C');
			$this->Cell(37,10,'Customer ID',1,1,'C');
		}

		function viewTable($db){
			$total = 0;
			$stmt = "";
			$this->SetFont('Times','',12);

			$status = $_POST['bookingStatus'];
			$start_date = $_POST['booking_from_date'];
			$end_date = $_POST['booking_to_date'];
			$vin_num = $_POST['booking_vin_num'];
			$cust_id = $_POST['booking_cust_id'];
			
			if($status != "all"){
				$stmt = $db->query('SELECT * FROM booking WHERE status="' .$status .'"');
				
				$stmt2 = $db->query("SELECT count(*) as total FROM booking WHERE status='" .$status ."'");
				if($data = $stmt2->fetch(PDO::FETCH_OBJ)){
					$total = $data->total;
				}
			}else{
				$stmt = $db->query('SELECT * FROM booking');
			}
			
			//$stmt = $db->query('SELECT * FROM booking WHERE status="' .$status .'"');

			while($data = $stmt->fetch(PDO::FETCH_OBJ)){
				$this->Cell(40,10, $data->booking_id ,1,0,'L');
				$this->Cell(50,10, $data->booking_date ,1,0,'L');
				$this->Cell(50,10, $data->booking_time ,1,0,'L');
				$this->Cell(50,10, $data->status ,1,0,'L');
				$this->Cell(50,10, $data->vin_number ,1,0,'L');
				$this->Cell(37,10, $data->customer_id ,1,0,'L');
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