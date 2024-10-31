<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_POST['register'])) {
    include 'db.php';
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $stmt = $conn->prepare("INSERT INTO productos (nombre, precio, stock) VALUES (:nombre, :precio, :stock)");
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':precio', $precio);
    $stmt->bindParam(':stock', $stock);
    $stmt->execute();

    echo "Producto registrado con éxito.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrar Producto</title>
    <link rel="stylesheet" href="css/cetis.css">
</head>
<body>
    <form method="POST" action="registrar_productos.php">
        <label>Nombre del Producto:</label><br>
        <input type="text" name="nombre" required><br><br>
        <label>Precio:</label><br>
        <input type="number" step="0.01" name="precio" required><br><br>
        <label>Stock:</label><br>
        <input type="number" name="stock" required><br><br>
        <button type="submit" name="register">Registrar Producto</button>
    </form>

    <br><br>
<button type="button" onclick="window.location.href='dashboard.php'">Volver</button> 
</body>
</html>
