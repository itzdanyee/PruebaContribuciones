<?php
session_start();
include('db.php'); // Incluye el archivo de conexión a la base de datos

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: catalogo.php");
    exit();
}

$productId = intval($_GET['id']); // Asegúrate de sanitizar la entrada
$query = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $productId);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

if (!$product) {
    header("Location: catalogo.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cetis.css">
    <title><?php echo htmlspecialchars($product['name']); ?></title>
</head>

<style>
/* Estilos generales */
body {
    font-family: 'Comic Sans MS', cursive, sans-serif; /* Fuente amigable */
    margin: 20px;
    background-color: #ffe6f1; /* Fondo rosa suave */
    color: #ff66b2; /* Color rosa pastel */
}

/* Contenedor principal */
.dashboard-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff; /* Fondo blanco para el contenedor */
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Sombra suave */
    text-align: center;
}

/* Estilo del título */
h2 {
    font-size: 2.5rem;
    color: #ff66b2;
    text-transform: uppercase;
    font-weight: bold;
    margin-bottom: 20px;
}

/* Estilo de los párrafos */
p {
    font-size: 1.2rem;
    color: #ff66b2;
    margin-top: 10px;
}

/* Estilo del enlace */
a {
    text-decoration: none;
    color: #ff66b2;
    font-weight: bold;
    margin-top: 20px;
    display: inline-block;
}

a:hover {
    color: #ff3399; /* Color al pasar el mouse */
}

/* Botón Volver */
.back-button {
    display: inline-block;
    padding: 10px 20px;
    margin-top: 20px;
    background-color: #ff3399; /* Rosa brillante */
    color: white;
    text-decoration: none;
    border-radius: 20px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.back-button:hover {
    background-color: #ff66b2; /* Cambio de color al pasar el mouse */
}

</style>

<body>
    <div class="dashboard-container">
        <h2><?php echo htmlspecialchars($product['name']); ?></h2>
        <p>Precio: $<?php echo htmlspecialchars($product['price']); ?></p>
        <p><?php echo htmlspecialchars($product['descripcion']); ?></p>
        <a href="catalogo.php" class="back-button">Volver al Catálogo</a>
    </div>
</body>
</html>
