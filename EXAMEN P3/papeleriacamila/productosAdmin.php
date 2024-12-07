<?php
session_start();
include('db.php'); // Aquí debe estar la conexión a la base de datos

// Validar que el usuario tiene acceso
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != '1') {
    header("Location: index.php");
    exit();
}

// Manejar la solicitud de agregar/eliminar productos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_id'])) {
        $delete_id = intval($_POST['delete_id']); // Asegurarnos de que es un número entero
        $conn->query("DELETE FROM products WHERE id=$delete_id"); // Eliminamos solo el producto con ese id
    } elseif (isset($_POST['name'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $conn->query("INSERT INTO products (name, price, quantity) VALUES ('$name', '$price', '$quantity')");
    }
}

// Consulta para obtener los productos
$query = "SELECT * FROM products";
$products = $conn->query($query);

if (!$products) {
    die("Error en la consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Productos</title>
    <style>
        /* Estilo general */
        body {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom right, #f7f7f7, #eaeaea);
            color: #333;
        }

        h2 {
            text-align: center;
            color: #ff69b4;
            margin: 20px 0;
        }

        h3 {
            color: #555;
            margin: 20px;
            text-align: center;
        }

        /* Formulario reducido */
        form {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #555;
        }

        form input[type="text"],
        form input[type="number"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        form button {
            background-color: #ff69b4;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #ff4d6d;
        }

        /* Lista de productos en horizontal */
        .product-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            margin: 20px auto;
            max-width: 100%;
            gap: 20px; /* Espaciado entre los productos */
            padding: 0 10px;
        }

        .product-item {
            background: #fff;
            padding: 25px; /* Aumentamos el padding para hacer la tarjeta más grande */
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            width: 250px; /* Hacemos las tarjetas más anchas */
            text-align: center;
            flex-shrink: 0; /* Evita que los productos se reduzcan en ancho */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-item:hover {
            transform: scale(1.05); /* Efecto al pasar el ratón sobre el producto */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .product-item p {
            margin: 15px 0;
            color: #444;
            font-size: 16px; /* Aumentamos el tamaño de la fuente */
        }

        /* Botones dentro de las tarjetas de productos */
        .delete-button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 12px 20px; /* Aumentamos el tamaño del botón */
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .delete-button:hover {
            background-color: #c82333;
        }

        .preview-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .preview-button:hover {
            background-color: #0056b3;
        }

        /* Enlace de inicio */
        a {
            display: inline-block;
            text-decoration: none;
            color: #007bff;
            font-size: 16px;
            margin: 20px;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Gestión de Productos</h2>
    <form method="POST">
        <label>Nombre:</label>
        <input type="text" name="name" required>
        <label>Precio:</label>
        <input type="number" step="0.01" name="price" required>
        <label>Cantidad:</label>
        <input type="number" name="quantity" required>
        <button type="submit">Agregar Producto</button>
    </form>

    <h3>Lista de Productos</h3>
    <div class="product-list">
        <?php if ($products->num_rows > 0): ?>
            <?php while ($product = $products->fetch_assoc()): ?>
                <div class="product-item">
                    <p><?php echo $product['name']; ?> - $<?php echo $product['price']; ?> (Cantidad: <?php echo $product['quantity']; ?>)</p>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="delete_id" value="<?php echo $product['id']; ?>">
                        <button type="submit" class="delete-button">Eliminar</button>
                    </form>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No hay productos disponibles.</p>
        <?php endif; ?>
    </div>

    <!-- Botón para generar PDF -->
    <form action="generar_pdf.php" method="POST">
        <button type="submit">Generar PDF</button>
    </form>

    <button onclick="window.history.back()" style="
    background-color: #552583; /* Morado Lakers */
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    ">
    ← Volver
</button>

<script>
    const button = document.querySelector("button");
    button.addEventListener("mouseover", () => button.style.backgroundColor = "#fdb927"); /* Dorado Lakers */
    button.addEventListener("mouseout", () => button.style.backgroundColor = "#552583");
    button.addEventListener("mousedown", () => button.style.transform = "scale(0.95)");
    button.addEventListener("mouseup", () => button.style.transform = "scale(1)");
</script>

</body>
</html>
