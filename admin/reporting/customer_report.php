<?php
	require '../fpdf/fpdf.php';
	$db = new PDO('mysql:host=localhost;dbname=dbcar2','root','');

	class myPDF extends FPDF{
		function header(){
			$this->Image('../images/rsz_logo.jpg', 10, 6);
			$this->SetFont('Arial', 'B', 16);
			$this->Ln(10);
			$this->Cell(276,5,'CUSTOMER REPORT',0,0,'C');
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
				$this->Cell(59,10,'Customer ID',1,0,'C');
				$this->Cell(60,10,'First Name',1,0,'C');
				$this->Cell(60,10,'Surname',1,0,'C');
				$this->Cell(60,10,'Phone Number',1,0,'C');
				$this->Cell(39,10,'Total Bookings',1,1,'C');
				$total = 0;
		}

		function viewTable($db){
			$total = 0;
			$stmt = "";
			$this->SetFont('Times','',12);

			$bookings = $_POST['cust_bookings'];
			$customer_id = $_POST['cust_id1'];
			
			if($bookings == "most_bookings"){
				$stmt1 = $db->query("SELECT customer.customer_id, customer.first_name, customer.surname, customer.phone_number, COUNT(customer.customer_id) AS total FROM customer, booking WHERE customer.customer_id = booking.customer_id GROUP BY customer.customer_id ORDER BY total DESC limit 1");

				while($data = $stmt1->fetch(PDO::FETCH_OBJ)){
					$total = $data->total;
				}
				
				$stmt = $db->query("SELECT customer.customer_id, customer.first_name, customer.surname, customer.phone_number, COUNT(customer.customer_id) AS total FROM customer, booking WHERE customer.customer_id = booking.customer_id GROUP BY customer.customer_id having total = " .$total ."");

			}else if ($bookings == "least_bookings") {
				$stmt1 = $db->query("SELECT customer.customer_id, customer.first_name, customer.surname, customer.phone_number, COUNT(customer.customer_id) AS total FROM customer, booking WHERE customer.customer_id = booking.customer_id GROUP BY customer.customer_id ORDER BY total ASC limit 1");

				while($data = $stmt1->fetch(PDO::FETCH_OBJ)){
					$total = $data->total;
				}
				
				$stmt = $db->query("SELECT customer.customer_id, customer.first_name, customer.surname, customer.phone_number, COUNT(customer.customer_id) AS total FROM customer, booking WHERE customer.customer_id = booking.customer_id GROUP BY customer.customer_id having total = " .$total ."");
			}else if (strlen($customer_id) > 0) {
				$stmt = $db->query("SELECT customer.customer_id, customer.first_name, customer.surname, customer.phone_number, COUNT(customer.customer_id) AS total FROM customer, booking WHERE customer.customer_id = booking.customer_id AND customer.customer_id =" .$customer_id);
			}else{

				$stmt = $db->query("SELECT customer.customer_id, customer.first_name, customer.surname, customer.phone_number, COUNT(customer.customer_id) AS total FROM customer, booking WHERE customer.customer_id = booking.customer_id GROUP BY customer.customer_id ORDER BY  customer.customer_id");
			}

			while($data = $stmt->fetch(PDO::FETCH_OBJ)){
				$this->Cell(59,10, $data->customer_id ,1,0,'L');
				$this->Cell(60,10, $data->first_name ,1,0,'L');
				$this->Cell(60,10, $data->surname ,1,0,'L');
				$this->Cell(60,10, $data->phone_number ,1,0,'L');
				$this->Cell(39,10, $data->total ,1,0,'L');
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