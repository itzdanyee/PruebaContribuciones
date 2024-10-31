<?php
session_start();

// Verificar si el usuario está autenticado y es un administrador
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'db.php'; // Asegúrate de que este archivo tiene la conexión a la base de datos

// Obtener el ID del usuario a eliminar
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar el usuario
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    // Redirigir a la gestión de usuarios
    header("Location: gestionar_usuarios.php");
    exit();
} else {
    header("Location: gestionar_usuarios.php");
    exit();
}
?>
