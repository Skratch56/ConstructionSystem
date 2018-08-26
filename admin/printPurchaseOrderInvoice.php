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
$pdf->Cell(195, 10, 'Khomanani Contruction',0, "R");
$pdf->Ln(10);
$pdf->Cell(195, 10, 'Email: admin@khomanani.co.za',0, "R");
$pdf->Ln(10);
$pdf->Cell(195, 10, 'Contact: 073 587 5280',0, "R");
$pdf->Ln(15);
$pdf->Cell(195, 10, 'Purchase Order', 1, 1, "C");
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(40, 10, 'Purchase Order ID.', 1);
$pdf->Cell(25, 10, 'Date.', 1);
$pdf->Cell(30, 10, 'Cost.', 1);
$pdf->Cell(50, 10, 'Employee Details.', 1);
$pdf->Cell(50, 10, 'Supplier Details.', 1);



$query = "SELECT * FROM purchaseorder where PurchaseOrderID=" . $_GET['pid'];
$result = mysqli_query($con, $query);
$no = 0;
while ($row = mysqli_fetch_array($result)) {

    $no = $no + 1;
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(40, 10, $row['PurchaseOrderID'], 1);
    $pdf->Cell(25, 10, $row['Date'], 1);
    $pdf->Cell(30, 10, $row['Amount'], 1);
    $query2 = "SELECT * FROM supplier where supplier_id=" .$row['supplier_id'];
    $result2 = mysqli_query($con, $query2);
    while ($row2 = mysqli_fetch_array($result2)) {
        $Custname = $row2['Name'];
    }
    $query3 = "SELECT * FROM employee where employee_id=" .$row['employee_id'];
    $result3 = mysqli_query($con, $query3);
    while ($row3 = mysqli_fetch_array($result3)) {
        $Empname = $row3['name'].' '.$row3['surname'];
    }
    
    $pdf->Cell(50, 10, $Empname, 1);
    $pdf->Cell(50, 10, $Custname, 1);
}





$pdf->Output();
?>