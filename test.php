<?php
require('ImageRatio.php');

$pdf = new FPDF_ratio();
$pdf->AddPage();

$pdf->SetFont('Arial','B',16);

$pdf->Cell(10,10,'(1) Classic Image method (2) ImageRatio method');
$pdf->Image("maldives.jpg", 10, 20, 150, 50, "jpg");

$pdf->ImageRatio("maldives.jpg", 10, 80, 150, 50, "jpg");

$pdf->Output("F", "output.pdf");
