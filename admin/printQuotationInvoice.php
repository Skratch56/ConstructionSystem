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
$pdf->Cell(175, 10, 'Khomanani Contruction',0, "R");
$pdf->Ln(10);
$pdf->Cell(175, 10, 'Email: admin@khomanani.co.za',0, "R");
$pdf->Ln(10);
$pdf->Cell(175, 10, 'Contact: 073 587 5280',0, "R");
$pdf->Ln(15);
$pdf->Cell(175, 10, 'Quotation', 1, 1, "C");
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(20, 10, 'Quotation ID.', 1);
$pdf->Cell(25, 10, 'Date.', 1);
$pdf->Cell(30, 10, 'Cost.', 1);
$pdf->Cell(50, 10, 'Customer Details.', 1);
$pdf->Cell(50, 10, 'Employee Details.', 1);



$query = "SELECT * FROM quotation where QuotationID=" . $_GET['qid'];
$result = mysqli_query($con, $query);
$no = 0;
while ($row = mysqli_fetch_array($result)) {

    $no = $no + 1;
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(20, 10, $row['QuotationID'], 1);
    $pdf->Cell(25, 10, $row['Date'], 1);
    $pdf->Cell(30, 10, $row['Cost'], 1);
    $query2 = "SELECT * FROM customer where customer_id=" .$row['CustomerID'];
    $result2 = mysqli_query($con, $query2);
    while ($row2 = mysqli_fetch_array($result2)) {
        $Custname = $row2['name'];
    }
    $query3 = "SELECT * FROM employee where employee_id=" .$row['EmployeeID'];
    $result3 = mysqli_query($con, $query3);
    while ($row3 = mysqli_fetch_array($result3)) {
        $Empname = $row3['name'].' '.$row3['surname'];
    }
    
    $pdf->Cell(50, 10, $Custname, 1);
    $pdf->Cell(50, 10, $Empname, 1);
}





$pdf->Output();
?>