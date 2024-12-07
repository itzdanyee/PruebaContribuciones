<?php
require('pdtf/fpdf/fpdf.php');

// Conexión a la base de datos
$conexion = new mysqli('fdb1028.awardspace.net', '4560798_proyectocamila', 'darckar23', '4560798_proyectocamila');

// Verificar si la conexión fue exitosa
if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

// Consulta para obtener los productos
$query = "SELECT name, price, quantity FROM products";
$result = $conexion->query($query);

// Crear el PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Lista de Productos', 0, 1, 'C');
$pdf->Ln(10);

// Encabezados de tabla
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(70, 10, 'Nombre', 1, 0, 'C');
$pdf->Cell(40, 10, 'Precio', 1, 0, 'C');
$pdf->Cell(30, 10, 'Cantidad', 1, 0, 'C');
$pdf->Ln();

// Verifica si hay productos en el resultado de la consulta
$pdf->SetFont('Arial', '', 12);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(70, 10, $row['name'], 1, 0, 'L');
        $pdf->Cell(40, 10, '$' . number_format($row['price'], 2), 1, 0, 'R');
        $pdf->Cell(30, 10, $row['quantity'], 1, 0, 'R');
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'No hay productos disponibles.', 1, 1, 'C');
}

// Cerrar la conexión a la base de datos
$conexion->close();

// Mostrar el PDF en el navegador
$pdf->Output('I', 'productos.pdf'); // Muestra el PDF en el navegador
exit;
?>
