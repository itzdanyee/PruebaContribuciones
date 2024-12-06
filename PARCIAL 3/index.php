<?php
require('fpdf186\fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12); 
$pdf->Cell(40,10,'Hola, Mundo!', 0, 1);
$pdf->SetFont('Times','I',20); 
$pdf->SetTextColor(50,10,100);
$pdf->SetFillColor('255','203','219');
$pdf->SetLineWidth(1);
$pdf->SetDrawColor(232,136,138);
$pdf->Cell(190,40,'Centro de Estudios Tecnologicos industriales y de servicios NO.84!',1,3,'C',true);
$pdf->SetFont('Courier','',18); 
$pdf->SetTextColor(50,1,100);
$pdf->Cell(40,10,'Desarrolla Aplicaciones con Conexion a Base de Datos',0,4);
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(21,1,32);
$pdf->Cell(40,10,'Arzola Mendoza Camila Daniela',0,4);
$pdf->SetFont('Arial','B',10); 
$pdf->SetTextColor(21,1,32);
$pdf->Cell(40,10,'Gabriel Ignacio China',0,1);
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(30, 10, 'ID', 1, 0, 'C');
$pdf->Cell(100, 10, 'Producto', 1, 0, 'C');
$pdf->Cell(30, 10, 'Precio', 1, 1, 'C');

$pdf->SetFont('Arial', '', 12);

$productos = [
    [1, 'Laptop', 799.99],
    [2, 'Smartphone', 499.50],
    [3, 'Teclado', 29.99],
    [4, 'Ratón', 15.75],
    [5, 'Monitor', 149.99],
];
$a = 0;
while ($a < 5) {
    $pdf->cell(30, 10, utf8_decode($productos[$a][1]), 1, 0, 'C');
    $pdf->cell(100, 10, $productos[$a][0], 1, 0, 'L'); 
    $pdf->Cell(30, 10, $productos[$a][2], 1, 1, 'R');  
    $a++;
}
$pdf->Output();
?>