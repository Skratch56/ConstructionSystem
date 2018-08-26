<?php
	require '../fpdf/fpdf.php';
	$db = new PDO('mysql:host=localhost;dbname=dbcar2','root','');

	class myPDF extends FPDF{
		function header(){
			$this->Image('../images/rsz_logo.jpg', 10, 6);
			$this->SetFont('Arial', 'B', 16);
			$this->Ln(10);
			$this->Cell(276,5,'EVALUATION REPORT',0,0,'C');
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
			$this->Cell(35,10,'Evaluation No.',1,0,'C');
			$this->Cell(35,10,'Evaluation Date',1,0,'C');
			$this->Cell(35,10,'Evaluation Time',1,0,'C');
			$this->Cell(48,10,'Quoted Amount',1,0,'C');
			$this->Cell(50,10,'Evaluation Status',1,0,'C');
			$this->Cell(37,10,'Booking ID',1,0,'C');
			$this->Cell(37,10,'Staff No.',1,1,'C');
		}

		function viewTable($db){
			$total = 0;
			$stmt = "";
			
			$this->SetFont('Times','',12);

			$start_date = $_POST['evaluation_from_date'];
			$end_date = $_POST['evaluation_to_date'];
			$staff_num = $_POST['evaluation_staff'];

			if (strlen($start_date)>2 && strlen($end_date)>2 && strlen($staff_num)>2) {
				$stmt = $db->query("SELECT * FROM evaluation WHERE date BETWEEN '" .$start_date ."' AND '" .$end_date ."' AND staff_no = '" .$staff_num ."'");

				$stmt2 = $db->query("SELECT count(*) as total FROM evaluation WHERE date BETWEEN '" .$start_date ."' AND '" .$end_date ."' AND staff_no = '" .$staff_num ."'");
				if($data = $stmt2->fetch(PDO::FETCH_OBJ)){
					$total = $data->total;
				}

			}else if (strlen($start_date)>2 && strlen($end_date)>2) {
				$stmt = $db->query("SELECT * FROM evaluation WHERE date BETWEEN '" .$start_date ."' AND '" .$end_date ."'");

				$stmt2 = $db->query("SELECT count(*) as total FROM evaluation WHERE date BETWEEN '" .$start_date ."' AND '" .$end_date ."'");
				if($data = $stmt2->fetch(PDO::FETCH_OBJ)){
					$total = $data->total;
				}

			}else if (strlen($start_date)>2 && strlen($staff_num)>2) {
				$stmt = $db->query("SELECT * FROM evaluation WHERE date >= '" .$start_date ."' AND staff_no = '" .$staff_num ."'");

				$stmt2 = $db->query("SELECT count(*) as total FROM evaluation WHERE date >= '" .$start_date ."' AND staff_no = '" .$staff_num ."'");
				if($data = $stmt2->fetch(PDO::FETCH_OBJ)){
					$total = $data->total;
				}

			}else if (strlen($staff_num)>2) {
				$stmt = $db->query("SELECT * FROM evaluation WHERE staff_no = '" .$staff_num ."'");

				$stmt2 = $db->query("SELECT count(*) as total FROM evaluation WHERE staff_no = '" .$staff_num ."'");
				if($data = $stmt2->fetch(PDO::FETCH_OBJ)){
					$total = $data->total;
				}

			}else{
				$stmt = $db->query('SELECT * FROM evaluation');

				$stmt2 = $db->query("SELECT count(*) as total FROM evaluation");
				if($data = $stmt2->fetch(PDO::FETCH_OBJ)){
					$total = $data->total;
				}

			}
			
			while($data = $stmt->fetch(PDO::FETCH_OBJ)){
				$this->Cell(35,10, $data->evaluation_no ,1,0,'L');
				$this->Cell(35,10, $data->date ,1,0,'L');
				$this->Cell(35,10, $data->time ,1,0,'L');
				$this->Cell(48,10, $data->quoted_amt ,1,0,'L');
				$this->Cell(50,10, $data->evaluation_status ,1,0,'L');
				$this->Cell(37,10, $data->booking_id ,1,0,'L');
				$this->Cell(37,10, $data->staff_no ,1,0,'L');
				$this->Ln();
			}

				$this->Cell(35,10, "" ,0,0,'L');
				$this->Cell(35,10, "" ,0,0,'L');
				$this->Cell(35,10, "" ,0,0,'L');
				$this->SetFont('Times','B',12);
				$this->Cell(48,10, "" ,0,0,'L');
				$this->Cell(50,10, "" ,0,0,'L');
				$this->Cell(37,10, "" ,0,0,'L');
				$this->Cell(37,10, "Total: ". $total ,1,0,'L');
		}
	}

	$pdf = new myPDF();
	$pdf->AliasNbPages();
	$pdf->AddPage('L', 'A4',0);
	$pdf->headerTable();
	$pdf->viewTable($db);
	$pdf->Output();
?>