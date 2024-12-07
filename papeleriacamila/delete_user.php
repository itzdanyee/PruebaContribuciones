<?php
// delete_user.php
session_start();
include('db.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != '1') {
    header("Location: dashboard.php");
    exit();
}

// Manejar la solicitud de eliminación
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $conn->query("DELETE FROM users WHERE id='$delete_id'");
}

// Obtener la lista de usuarios
$users = $conn->query("SELECT id, email, role FROM users");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuarios</title>
    <link rel="stylesheet" href=""> <!-- Incluye tu hoja de estilos -->
    <style>
        /* Estilos generales */
        body {
            font-family: 'Comic Sans MS', cursive, sans-serif; /* Fuente amigable */
            margin: 20px;
            color: #ff66b2; /* Color rosa pastel */
            background: linear-gradient(to bottom right, #ffb3e6, #e6f7ff); /* Fondo degradado en tonos pastel */
        }

        h2 {
            text-align: center; /* Centra el título */
            font-size: 2rem;
            color: #ff66b2;
        }

        h3 {
            font-size: 1.5rem;
            color: #4d4dff;
            text-align: center;
        }

        .user-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); /* Ajusta la cantidad de columnas según el tamaño */
            gap: 20px; /* Espaciado entre las tarjetas */
            justify-items: center; /* Centra las tarjetas */
        }

        /* Estilos de las tarjetas */
        .card {
            background-color: #ff66b2; /* Color rosa pastel uniforme para las tarjetas */
            border-radius: 16px; /* Bordes más redondeados */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3); /* Sombra más suave */
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            max-width: 280px; /* Limitar el ancho de las tarjetas */
            color: white; /* Texto blanco */
        }

        .card:hover {
            transform: translateY(-10px); /* Efecto de elevación al pasar el mouse */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4); /* Sombra más fuerte al pasar el mouse */
        }

        .delete-button {
            display: inline-block;
            padding: 8px 16px;
            background-color: #ff4d6d; /* Color del botón de eliminar */
            color: white;
            text-decoration: none;
            border-radius: 20px;
            margin-top: 10px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .delete-button:hover {
            background-color: #d800d8; /* Color al pasar el mouse */
        }

        .register-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4caf50; /* Color del botón en verde */
            color: white;
            text-decoration: none;
            border-radius: 20px;
            margin-bottom: 20px; /* Espacio inferior */
            font-size: 1.2rem;
            transition: background-color 0.3s ease;
        }

        .register-button:hover {
            background-color: #45a049; /* Color al pasar el mouse */
        }
    </style>
</head>
<body>
    <h2>Eliminar Usuarios</h2>
    
    <!-- Botón para registrar un nuevo usuario -->
    <a href="register.php" class="register-button">Registrar Nuevo Usuario</a>

    <h3>Lista de Usuarios</h3>
    <div class="user-list">
        <?php while ($user = $users->fetch_assoc()): ?>
            <div class="card">
                <h3><?php echo $user['email']; ?></h3>
                <p>Rol: <?php echo ($user['role'] == '1') ? 'Administrador' : 'Usuario'; ?></p>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="delete_id" value="<?php echo $user['id']; ?>">
                    <button type="submit" class="delete-button">Eliminar</button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
