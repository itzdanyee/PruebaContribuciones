<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db.php'; // Asegúrate de que este archivo tiene la conexión a la base de datos

// Verificar si se recibió el ID del producto
if (isset($_POST['producto_id'])) {
    $producto_id = $_POST['producto_id'];
    $user_id = $_SESSION['user_id'];

    // Verificar que el usuario existe
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Usuario existe, registrar la compra
        try {
            // Iniciar una transacción
            $conn->beginTransaction();

            // Insertar en la tabla compras
            $stmt = $conn->prepare("INSERT INTO compras (user_id, producto_id, fecha) VALUES (:user_id, :producto_id, NOW())");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':producto_id', $producto_id);
            $stmt->execute();

            // Actualizar el stock del producto
            $stmt = $conn->prepare("UPDATE productos SET stock = stock - 1 WHERE id = :producto_id AND stock > 0");
            $stmt->bindParam(':producto_id', $producto_id);
            $stmt->execute();

            // Verificar si se actualizó el stock
            if ($stmt->rowCount() > 0) {
                // Confirmar la transacción
                $conn->commit();
                echo "¡Compra realizada con éxito!";
            } else {
                // Revertir la transacción si no hay stock suficiente
                $conn->rollBack();
                echo "Error: No hay suficiente stock para completar la compra.";
            }
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            $conn->rollBack();
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Error: El usuario no existe.";
    }
} else {
    echo "No se ha recibido el ID del producto.";
}
?>

<!-- Botón de Volver -->
<br><br>
<button type="button" onclick="window.location.href='comprar_productos.php'">Volver a Comprar Productos</button>

<link rel="stylesheet" href="css/cetis.css">
