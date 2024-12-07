<?php
session_start();
include('db.php'); // Incluye el archivo de conexión a la base de datos

// Verifica si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Obtener productos de la base de datos
$query = "SELECT * FROM products"; // Asegúrate de que la tabla se llame 'products'
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cetis.css"> <!-- Archivo CSS externo -->
    <title>Catálogo de Productos</title>
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
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff; /* Fondo blanco para las tarjetas */
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Sombra suave */
}

/* Estilo del título */
h2 {
    text-align: center;
    font-size: 2.5rem;
    color: #ff66b2;
    text-transform: uppercase;
    font-weight: bold;
    margin-bottom: 30px;
}

/* Estilos para los enlaces */
a {
    text-decoration: none;
    color: #ff66b2;
    font-weight: bold;
}

a:hover {
    color: #ff3399; /* Color al pasar el mouse */
}

/* Estilos para la lista de productos */
.product-list {
    display: flex; /* Flexbox para el diseño horizontal */
    flex-wrap: wrap; /* Permite que las tarjetas se acomoden en varias filas */
    justify-content: space-evenly; /* Distribuye el espacio entre las tarjetas */
    gap: 20px; /* Espaciado entre las tarjetas */
}

/* Estilos de las tarjetas de productos */
.card {
    background-color: #ff66b2; /* Rosa pastel uniforme */
    border-radius: 16px; /* Bordes redondeados */
    padding: 15px;
    text-align: center;
    color: white;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); /* Sombra suave */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    width: 250px; /* Tamaño más pequeño para las tarjetas */
    height: auto; /* Ajuste automático de la altura */
}

/* Efecto hover para las tarjetas */
.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); /* Sombra más fuerte al pasar el mouse */
}

/* Estilo para los títulos dentro de las tarjetas */
.card h3 {
    font-size: 1.5rem;
    color: white;
    font-weight: bold;
    margin-bottom: 10px;
}

/* Estilo para el precio */
.card p {
    font-size: 1rem;
    margin-top: 10px;
    color: white;
}

/* Botón de compra */
.buy-button {
    display: inline-block;
    padding: 10px 20px;
    margin-top: 15px;
    background-color: #ff3399; /* Rosa brillante */
    color: white;
    text-decoration: none;
    border-radius: 20px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.buy-button:hover {
    background-color: #ff66b2; /* Cambio de color al pasar el mouse */
}

/* Estilos adicionales para los iconos o imágenes */
.card::before {
    content: url('https://www.example.com/kawaii-icon.png'); /* Icono de estilo kawaii sobre cada tarjeta */
    display: block;
    margin: 0 auto;
    width: 50px;
    height: 50px;
    margin-bottom: 10px;
}

</style>

<body>
    <div class="dashboard-container">
        <h2>Catálogo de Productos</h2>
        <a href="index.php">Volver al Panel de Control</a>
        <div class="product-list">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($product = $result->fetch_assoc()): ?>
                    <div class="card">
                        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p>Precio: $<?php echo htmlspecialchars($product['price']); ?></p>
                        <p><?php echo htmlspecialchars($product['descripcion']); ?></p>
                        <a href="detalles_productos.php?id=<?php echo $product['id']; ?>">Ver Detalles</a>
                        <br>
                        <a href="comprar.php?id=<?php echo $product['id']; ?>" class="buy-button">Comprar</a> <!-- Botón de comprar -->
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No hay productos disponibles.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
