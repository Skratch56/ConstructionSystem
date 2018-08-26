<?php

require('fpdf/fpdf.php');
include '../includes/dbcon.php';
//$id = $_GET['cash_receipt_no'];



$pdf = new FPDF();
///var_dump(get_class_methods($pdf));

$pdf->AddPage('L');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(50, 10, 'Date:' . date('d-m-Y') . '', 0, "R");
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(225, 10, 'Khomanani Contruction',0, "R");
$pdf->Ln(10);
$pdf->Cell(225, 10, 'Email: admin@khomanani.co.za',0, "R");
$pdf->Ln(10);
$pdf->Cell(225, 10, 'Contact: 073 587 5280',0, "R");
$pdf->Ln(15);
$pdf->Cell(225, 10, 'Employees', 1, 1, "C");
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(20, 10, 'Employee ID.', 1);
$pdf->Cell(25, 10, 'Name.', 1);
$pdf->Cell(30, 10, 'Surname.', 1);
$pdf->Cell(25, 10, 'Email.', 1);
$pdf->Cell(25, 10, 'City.', 1);
$pdf->Cell(25, 10, 'Postal Code.', 1);
$pdf->Cell(25, 10, 'Phone Number.', 1);
$pdf->Cell(25, 10, 'Employee_Type.', 1);
$pdf->Cell(25, 10, 'Job_Title.', 1);


$query = "SELECT * FROM employee";
$result = mysqli_query($con, $query);
$no = 0;
while ($row = mysqli_fetch_array($result)) {

    $no = $no + 1;
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(20, 10, $row['employee_id'], 1);
    $pdf->Cell(25, 10, $row['name'], 1);
    $pdf->Cell(25, 10, $row['surname'], 1);
    $pdf->Cell(30, 10, $row['email'], 1);
    $pdf->Cell(25, 10, $row['city'], 1);
    $pdf->Cell(25, 10, $row['postalcode'], 1);
    $pdf->Cell(25, 10, $row['phonenumber'], 1);
    $pdf->Cell(25, 10, $row['employeetype'], 1);
    $pdf->Cell(25, 10, $row['jobtitle'], 1);
}





$pdf->Output();
?>