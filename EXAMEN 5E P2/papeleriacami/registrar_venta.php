<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['sale'])) {
    include 'db.php';
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];

    // Reducir el stock del producto
    $stmt = $conn->prepare("UPDATE productos SET stock = stock - :cantidad WHERE id = :producto_id");
    $stmt->bindParam(':producto_id', $producto_id);
    $stmt->bindParam(':cantidad', $cantidad);
    $stmt->execute();

    echo "Venta registrada con éxito.";
}

// Mostrar productos
include 'db.php';
$stmt = $conn->prepare("SELECT * FROM productos");
$stmt->execute();
$productos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrar Venta</title>
    <link rel="stylesheet" href="css/cetis.css">
</head>
<body>
    <form method="POST" action="registrar_venta.php">
        <label>Producto:</label><br>
        <select name="producto_id">
            <?php foreach ($productos as $producto): ?>
                <option value="<?php echo $producto['id']; ?>"><?php echo $producto['nombre']; ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <label>Cantidad:</label><br>
        <input type="number" name="cantidad" required><br><br>
        <button type="submit" name="sale">Registrar Venta</button>
    </form>
</body>
</html>
