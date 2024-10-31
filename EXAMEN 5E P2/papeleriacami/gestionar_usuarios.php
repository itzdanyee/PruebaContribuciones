<?php
session_start();

// Verificar si el usuario está autenticado y es un administrador
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'db.php'; // Asegúrate de que este archivo tiene la conexión a la base de datos

// Obtener la lista de usuarios de la base de datos
$stmt = $conn->prepare("SELECT * FROM usuarios");
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="css/cetis.css">
</head>
<body>
    <h1>Gestión de Usuarios</h1>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre de Usuario</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?php echo htmlspecialchars($usuario['id']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['username']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['role']); ?></td>
                    <td>
                        <a href="editar_usuario.php?id=<?php echo $usuario['id']; ?>">Editar</a>
                        <a href="eliminar_usuario.php?id=<?php echo $usuario['id']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Botón de Volver -->
    <br><br>
    <button type="button" onclick="window.location.href='register.php'">Volver a registrar un usuario</button>
     <br><br>
    <button type="button" onclick="window.location.href='dashboard.php'">Volver</button> 
</body>
</html>
