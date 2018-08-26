<?php
	require '../fpdf/fpdf.php';
	$db = new PDO('mysql:host=localhost;dbname=dbcar2','root','');

	class myPDF extends FPDF{
		function header(){
			$this->Image('../images/rsz_logo.jpg', 10, 6);
			$this->SetFont('Arial', 'B', 16);
			$this->Ln(10);
			$this->Cell(276,5,'CASH RECEIPT REPORT',0,0,'C');
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
			$this->Cell(40,10,'Cash Receipt No',1,0,'C');
			$this->Cell(50,10,'Job Number',1,0,'C');
			$this->Cell(50,10,'Date',1,0,'C');
			$this->Cell(48,10,'Status',1,0,'C');
			$this->Cell(50,10,'Transaction Type',1,0,'C');
			$this->Cell(40,10,'Amount',1,1,'C');
		}	

		function viewTable($db){
			$total = 0.0;
			//$stmt = "";
			$this->SetFont('Times','',12);

			$pay_type = $_POST['pay_type'];
			$pay_status = $_POST['pay_status'];
			$start_date = $_POST['receipt_from_date'];
			$end_date = $_POST['receipt_to_date'];
			$amount = $_POST['receipt_amt'];

			if(strlen($start_date)>2 && strlen($end_date)>2 && $pay_type != "all" && $pay_status != "all" && $amount != "all"){
				$stmt = $db->query("SELECT * FROM cash_receipt WHERE date BETWEEN '" .$start_date ."' AND '" .$end_date ."' AND transaction_type ='" .$pay_type ."' AND status = '" .$pay_status ."' AND amount > " .$amount);
				
				$stmt2 = $db->query("SELECT sum(amount) as total FROM cash_receipt WHERE date BETWEEN '" .$start_date ."' AND '" .$end_date ."' AND transaction_type ='" .$pay_type ."' AND status = '" .$pay_status ."' AND amount > " .$amount);
				if($data = $stmt2->fetch(PDO::FETCH_OBJ)){
					$total = $data->total;
				}
				
			}else if(strlen($start_date)>2 && strlen($end_date)>2 && $pay_type != "all" && $pay_status != "all" && $amount == "all"){
				$stmt = $db->query("SELECT * FROM cash_receipt WHERE date BETWEEN '" .$start_date ."' AND '" .$end_date ."' AND transaction_type ='" .$pay_type ."' AND status = '" .$pay_status ."'");
				
				$stmt2 = $db->query("SELECT sum(amount) as total FROM cash_receipt WHERE date BETWEEN '" .$start_date ."' AND '" .$end_date ."' AND transaction_type ='" .$pay_type ."' AND status = '" .$pay_status ."'");
				if($data = $stmt2->fetch(PDO::FETCH_OBJ)){
					$total = $data->total;
				}

			}else if(strlen($start_date)>2 && strlen($end_date)>2 && $pay_type != "all" && $pay_status == "all" && $amount != "all"){
				$stmt = $db->query("SELECT * FROM cash_receipt WHERE date BETWEEN '" .$start_date ."' AND '" .$end_date ."' AND transaction_type ='" .$pay_type ."' AND amount > " .$amount);
				
				$stmt2 = $db->query("SELECT sum(amount) as total FROM cash_receipt WHERE date BETWEEN '" .$start_date ."' AND '" .$end_date ."' AND transaction_type ='" .$pay_type ."' AND amount > " .$amount);
				if($data = $stmt2->fetch(PDO::FETCH_OBJ)){
					$total = $data->total;
				}
				
			}else if(strlen($start_date)>2 && strlen($end_date)>2 && $pay_type == "all" && $pay_status == "all" && $amount != "all"){
				$stmt = $db->query("SELECT * FROM cash_receipt WHERE date BETWEEN '" .$start_date ."' AND '" .$end_date ."' AND amount > " .$amount);
				
				$stmt2 = $db->query("SELECT sum(amount) as total FROM cash_receipt WHERE date BETWEEN '" .$start_date ."' AND '" .$end_date ."' AND amount > " .$amount);
				if($data = $stmt2->fetch(PDO::FETCH_OBJ)){
					$total = $data->total;
				}
				
			}else if(strlen($start_date)>2 && strlen($end_date)>2 && $pay_type == "all" && $pay_status == "all" && $amount == "all"){
				$stmt = $db->query("SELECT * FROM cash_receipt WHERE date BETWEEN '" .$start_date ."' AND '" .$end_date ."'");
				
				$stmt2 = $db->query("SELECT sum(amount) as total FROM cash_receipt WHERE date BETWEEN '" .$start_date ."' AND '" .$end_date ."'");
				if($data = $stmt2->fetch(PDO::FETCH_OBJ)){
					$total = $data->total;
				}
				
			}else if(strlen($start_date)>2 && $pay_type == "all" && $pay_status == "all" && $amount == "all"){
				$stmt = $db->query("SELECT * FROM cash_receipt WHERE date >= '" .$start_date ."'");
				
				$stmt2 = $db->query("SELECT sum(amount) as total FROM cash_receipt WHERE date >= '" .$start_date ."'");
				if($data = $stmt2->fetch(PDO::FETCH_OBJ)){
					$total = $data->total;
				}

			}else if ($pay_type != "all" && $pay_status != "all") {
				$stmt = $db->query("SELECT * FROM cash_receipt WHERE transaction_type ='" .$pay_type ."' AND status = '" .$pay_status ."'");
				
				$stmt2 = $db->query("SELECT sum(amount) as total FROM cash_receipt WHERE transaction_type ='" .$pay_type ."' AND status = '" .$pay_status ."'");
				if($data = $stmt2->fetch(PDO::FETCH_OBJ)){
					$total = $data->total;
				}
			}else if($pay_type != "all" && $pay_status == "all"){
				$stmt = $db->query("SELECT * FROM cash_receipt WHERE transaction_type ='" .$pay_type ."'");
				
				$stmt2 = $db->query("SELECT sum(amount) as total FROM cash_receipt WHERE transaction_type ='" .$pay_type ."'");
				if($data = $stmt2->fetch(PDO::FETCH_OBJ)){
					$total = $data->total;
				}
			}else{
				$stmt = $db->query("SELECT * FROM cash_receipt");
				
				$stmt2 = $db->query("SELECT sum(amount) as total FROM cash_receipt");
				if($data = $stmt2->fetch(PDO::FETCH_OBJ)){
					$total = $data->total;
				}
			}

			while($data = $stmt->fetch(PDO::FETCH_OBJ)){
				$this->Cell(40,10, $data->cash_receipt_no ,1,0,'L');
				$this->Cell(50,10, $data->job_no ,1,0,'L');
				$this->Cell(50,10, $data->date ,1,0,'L');
				$this->Cell(48,10, $data->Status ,1,0,'L');
				$this->Cell(50,10, $data->transaction_type ,1,0,'L');
				$this->Cell(40,10, $data->amount ,1,0,'L');
				$this->Ln();
			}
				
				$this->Cell(40,10, "" ,0,0,'L');
				$this->Cell(50,10, "" ,0,0,'L');
				$this->Cell(50,10, "" ,0,0,'L');
				$this->SetFont('Times','B',12);
				$this->Cell(48,10, "" ,0,0,'L');
				$this->Cell(50,10, "" ,0,0,'L');
				$this->Cell(40,10, "Total: R". number_format((float)$total, 2, '.', '') ,1,0,'L');
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