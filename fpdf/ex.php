<?php
require('WriteHTML.php');

$pdf=new PDF_HTML();
$pdf->AddPage();
$pdf->SetFont('Arial');
$pdf->WriteHTML('<strong>You</strong> can<br><p align="center">center <strong>a</strong> line</p>and add a horizontal rule:<br><hr>');
$pdf->Output();
?>
