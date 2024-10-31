<?php
include 'db.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role = $_POST['role']; // Asignamos el rol elegido en el formulario

    // Comprobamos si el nombre de usuario ya existe
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "El nombre de usuario ya está en uso. Elige otro.";
    } else {
        // Insertamos el nuevo usuario en la base de datos
        $stmt = $conn->prepare("INSERT INTO usuarios (username, password, role) VALUES (:username, :password, :role)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);
        $stmt->execute();

        echo "Usuario registrado con éxito. <a href='login.php'>Inicia sesión aquí</a>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrar Usuario - Papelería</title>
    <link rel="stylesheet" href="css/cetis.css">
</head>
<body>
    <div class="container">
        <h1>Registrar Usuario</h1>
        <form method="POST" action="register.php">
            <label>Nombre de Usuario:</label><br>
            <input type="text" name="username" required><br><br>
            <label>Contraseña:</label><br>
            <input type="password" name="password" required><br><br>
            <label>Rol:</label><br>
            <select name="role" required>
                <option value="user">Usuario</option>
                <option value="admin">Administrador</option>
            </select><br><br>
            <button type="submit" name="register">Registrar</button>
        </form>
        <br>
        <button onclick="window.location.href='login.php'">Volver al Inicio</button>
    </div>
</body>
</html>
