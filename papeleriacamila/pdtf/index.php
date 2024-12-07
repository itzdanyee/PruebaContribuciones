<?php
// Evitar salidas antes de generar el PDF
ob_start();

require('fpdf/fpdf.php');

// Datos de conexión
$servername = "fdb1028.awardspace.net";
$username = "4560798_proyectocamila";
$password = "darckar23"; // Asegúrate de que esta variable contenga la contraseña correcta.
$database = "4560798_proyectocamila";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Verifica conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Consulta de productos de la papelería
$query = "SELECT * FROM products";
$result = $conn->query($query);

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}

// Inicia FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);

// Título del PDF
$pdf->Cell(190, 10, 'Inventario de Productos - Papeleria', 0, 1, 'C');
$pdf->Ln(5);

// Encabezados de la tabla
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(10, 10, 'ID', 1);
$pdf->Cell(60, 10, 'Producto', 1);
$pdf->Cell(50, 10, 'Categoría', 1);
$pdf->Cell(30, 10, 'Precio', 1);
$pdf->Cell(30, 10, 'Cantidad', 1);
$pdf->Ln();

// Agregar datos de la base de datos a la tabla
$pdf->SetFont('Arial', '', 12);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(10, 10, $row['id'], 1);
        $pdf->Cell(60, 10, utf8_decode($row['producto']), 1); // Codificación para caracteres especiales
        $pdf->Cell(50, 10, utf8_decode($row['categoria']), 1);
        $pdf->Cell(30, 10, '$' . number_format($row['precio'], 2), 1);
        $pdf->Cell(30, 10, $row['cantidad'], 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(180, 10, 'No hay datos disponibles', 1, 0, 'C');
}

// Cierra la conexión
$conn->close();

// Generar el PDF
ob_end_clean(); // Limpia el búfer antes de generar el PDF
$pdf->Output();
?>
