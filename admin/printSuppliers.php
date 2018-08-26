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
    $pdf->Cell(80, 10, 'Suppliers', 1,1, "C");
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(20, 10, 'Supplier ID.', 1);
    $pdf->Cell(30, 10, 'Supplier Name', 1);
    $pdf->Cell(30, 10, 'Supplier Number', 1);
    

    $query = "SELECT * FROM supplier";
    $result = mysqli_query($con, $query);
    $no = 0;
    while ($row = mysqli_fetch_array($result)) {

        $no = $no + 1;
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(20, 10, $row['supplier_id'], 1);
        $pdf->Cell(30, 10, $row['Name'], 1);
        $pdf->Cell(30, 10, $row['Supplier_Number'], 1);
    



        
    }





$pdf->Output();
?>