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
$pdf->Cell(120, 10, 'Khomanani Contruction',0, "R");
$pdf->Ln(10);
$pdf->Cell(120, 10, 'Email: admin@khomanani.co.za',0, "R");
$pdf->Ln(10);
$pdf->Cell(120, 10, 'Contact: 073 587 5280',0, "R");
$pdf->Ln(15);
$pdf->Cell(120, 10, 'Service Report', 1, 1, "C");
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(30, 10, 'Service ID.', 1);
$pdf->Cell(30, 10, 'Service Type.', 1);
$pdf->Cell(30, 10, 'Cost.', 1);
$pdf->Cell(30, 10, 'Category.', 1);



$query = "SELECT * FROM service";
$result = mysqli_query($con, $query);
$no = 0;
while ($row = mysqli_fetch_array($result)) {

    $no = $no + 1;
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(30, 10, $row['ServiceID'], 1);
    $pdf->Cell(30, 10, $row['ServiceType'], 1);
    $pdf->Cell(30, 10, "R".$row['Cost'], 1);
    $Category="";
    if($row['Category_ID']==1){
        $Category="Roadworks";
    }else if($row['Category_ID']==2){
        $Category="Buildings";
    }else if($row['Category_ID']==3){
        $Category="Other Services";
    }
    $pdf->Cell(30, 10, $Category, 1);

}





$pdf->Output();
?>