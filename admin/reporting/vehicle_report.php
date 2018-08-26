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
			$this->Cell(50,10,'Vin Number',1,0,'C');
			$this->Cell(40,10,'Registration No.',1,0,'C');
			$this->Cell(32,10,'Make',1,0,'C');
			$this->Cell(30,10,'Vehicle Type',1,0,'C');
			$this->Cell(22,10,'Model',1,0,'C');
			$this->Cell(40,10,'Colour',1,0,'C');
			$this->Cell(30,10,'Customer ID',1,0,'C');
			$this->Cell(32,10,'Total Bookings',1,1,'C');
		}

		function viewTable($db){
			$total = 0;
			$stmt = "";
			$vin_num = "";
			$this->SetFont('Times','',12);

			$bookings = $_POST['car_bookings'];

			if (isset($_POST['car_vin1'])) {
				$vin_num = $_POST['car_vin1'];
			}
			
			if($bookings == "most_booked"){
				$stmt1 = $db->query("SELECT vehicle.vin_number, vehicle.registration_no, vehicle.make, vehicle.vehicle_type, vehicle.model, vehicle.colour, vehicle.customer_no, COUNT(vehicle.vin_number) AS total FROM vehicle, booking WHERE vehicle.vin_number = booking.vin_number GROUP BY vehicle.vin_number ORDER BY total DESC limit 1");

				while($data = $stmt1->fetch(PDO::FETCH_OBJ)){
					$total = $data->total;
				}
				
				$stmt = $db->query("SELECT vehicle.vin_number, vehicle.registration_no, vehicle.make, vehicle.vehicle_type, vehicle.model, vehicle.colour, vehicle.customer_no, COUNT(vehicle.vin_number) AS total FROM vehicle, booking WHERE vehicle.vin_number = booking.vin_number GROUP BY vehicle.vin_number having total = " .$total ."");

			}else if ($bookings == "least_booked") {
				$stmt1 = $db->query("SELECT vehicle.vin_number, vehicle.registration_no, vehicle.make, vehicle.vehicle_type, vehicle.model, vehicle.colour, vehicle.customer_no, COUNT(vehicle.vin_number) AS total FROM vehicle, booking WHERE vehicle.vin_number = booking.vin_number GROUP BY vehicle.vin_number ORDER BY total ASC limit 1");

				while($data = $stmt1->fetch(PDO::FETCH_OBJ)){
					$total = $data->total;
				}
				
				$stmt = $db->query("SELECT vehicle.vin_number, vehicle.registration_no, vehicle.make, vehicle.vehicle_type, vehicle.model, vehicle.colour, vehicle.customer_no, COUNT(vehicle.vin_number) AS total FROM vehicle, booking WHERE vehicle.vin_number = booking.vin_number GROUP BY vehicle.vin_number having total = " .$total ."");

			}else if (strlen($vin_num) > 0) {
				$stmt = $db->query("SELECT vehicle.vin_number, vehicle.registration_no, vehicle.make, vehicle.vehicle_type, vehicle.model, vehicle.colour, vehicle.customer_no, COUNT(vehicle.vin_number) AS total FROM vehicle, booking WHERE vehicle.vin_number = booking.vin_number AND vehicle.vin_number =" .$vin_num);
			}else{

				$stmt = $db->query("SELECT vehicle.vin_number, vehicle.registration_no, vehicle.make, vehicle.vehicle_type, vehicle.model, vehicle.colour, vehicle.customer_no, COUNT(vehicle.vin_number) AS total FROM vehicle, booking WHERE vehicle.vin_number = booking.vin_number GROUP BY vehicle.vin_number ORDER BY  vehicle.vin_number");
			}

			while($data = $stmt->fetch(PDO::FETCH_OBJ)){
				$this->Cell(50,10, $data->vin_number ,1,0,'L');
				$this->Cell(40,10, $data->registration_no ,1,0,'L');
				$this->Cell(32,10, $data->make ,1,0,'L');
				$this->Cell(30,10, $data->vehicle_type ,1,0,'L');
				$this->Cell(22,10, $data->model ,1,0,'L');
				$this->Cell(40,10, $data->colour ,1,0,'L');
				$this->Cell(30,10, $data->customer_no ,1,0,'L');
				$this->Cell(32,10, $data->total ,1,0,'L');
				$this->Ln();
			}
		}
	}

	$pdf = new myPDF();
	$pdf->AliasNbPages();
	$pdf->AddPage('L', 'A4',0);
	$pdf->headerTable();
	$pdf->viewTable($db);
	$pdf->Output();
?>