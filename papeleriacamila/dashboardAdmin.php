<?php
session_start();

// Verificar si el usuario ha iniciado sesión y tiene el rol adecuado
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "1") {
    header("Location: login.php"); // Redirigir a la página de inicio de sesión
    exit();
}

// Conectar a la base de datos
include 'db.php'; // Asegúrate de tener un archivo para la conexión a la base de datos

// Obtener la lista de usuarios
$query = $conn->prepare("SELECT id, name, email, role FROM users"); // Cambia según tu estructura de tabla
$query->execute();
$result = $query->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Panel de Control</title>
    <link rel="stylesheet" href="css/cetis.css">
    <style>
        /* Estilo general */
        body {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            background-color: #ffe6f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #444;
        }

        /* Contenedor del dashboard */
        .dashboard-container {
            width: 90%;
            display: flex;
            flex-direction: row; /* Alineación horizontal */
            justify-content: space-evenly;
            align-items: center;
            padding: 20px;
            background: #fff0f5;
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Estilo de las tarjetas */
        .card {
            width: 30%;
            background: #ff6f91;
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        }

        .card h3 {
            color: #ffff;
            margin: 20px 0;
        }

        .card p {
            color: #333;
        }

        .card a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #ffb6c1;
            color: white;
            text-decoration: none;
            border-radius: 20px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .card a:hover {
            background-color: #ff69b4;
        }

        /* Botón de cerrar sesión */
        .logout {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #ff6f91;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            border-radius: 20px;
            transition: background-color 0.3s ease;
        }

        .logout:hover {
            background-color: #ff4d6d;
        }

        /* Ajustes para dispositivos pequeños */
        @media (max-width: 768px) {
            .dashboard-container {
                flex-direction: column;
                align-items: stretch;
            }

            .card {
                width: 90%;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Tarjetas del panel -->
        <div class="card">
            <h3>Gestión de Productos</h3>
            <p>Administra los productos de la tienda.</p>
            <a href="productosAdmin.php">Ir a Gestión de productos</a>
        </div>
        <div class="card">
            <h3>Gestión de Usuarios</h3>
            <p>Administra los usuarios registrados.</p>
            <a href="admin.php">Ir a Gestión de usuarios</a>
        </div>
    </div>
    <!-- Enlace para cerrar sesión -->
    <a class="logout" href="logout.php">Cerrar sesión</a>
</body>
</html>
