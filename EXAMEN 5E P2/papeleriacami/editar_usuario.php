<?php
session_start();

// Verificar si el usuario está autenticado y es un administrador
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'db.php'; // Asegúrate de que este archivo tiene la conexión a la base de datos

// Obtener el ID del usuario a editar
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los datos del usuario
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location: gestionar_usuarios.php");
    exit();
}

// Actualizar usuario si se envían los datos del formulario
if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $role = $_POST['role'];

    // Actualizar la información del usuario
    $stmt = $conn->prepare("UPDATE usuarios SET username = :username, role = :role WHERE id = :id");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header("Location: gestionar_usuarios.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="css/cetis.css">
</head>
<body>
    <h1>Editar Usuario</h1>
    
    <form method="POST" action="editar_usuario.php?id=<?php echo $usuario['id']; ?>">
        <label>Nombre de Usuario:</label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($usuario['username']); ?>" required><br><br>
        
        <label>Rol:</label>
        <select name="role" required>
            <option value="user" <?php if ($usuario['role'] == 'user') echo 'selected'; ?>>Usuario</option>
            <option value="admin" <?php if ($usuario['role'] == 'admin') echo 'selected'; ?>>Administrador</option>
        </select><br><br>
        
        <button type="submit" name="update">Actualizar</button>
    </form>

    <!-- Botón de Volver -->
    <br><br>
    <button type="button" onclick="window.location.href='gestionar_usuarios.php'">Volver a la Gestión de Usuarios</button>
</body>
</html>
