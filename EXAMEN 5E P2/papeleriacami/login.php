<?php
session_start();
if (isset($_POST['login'])) {
    include 'db.php';
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE username = :username AND password = :password");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header("Location: dashboard.php");
    } else {
        echo "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inicio de Sesión - Papelería</title>
    <link rel="stylesheet" href="css/cetis.css">
</head>
<body>
    <form method="POST" action="login.php">
        <label>Usuario:</label><br>
        <input type="text" name="username" required><br><br>
        <label>Contraseña:</label><br>
        <input type="password" name="password" required><br><br>
        <button type="submit" name="login">Iniciar Sesión</button>
    </form>

    <br>
<button type="button" onclick="window.location.href='register.php'">Registrar Usuario</button>

</body>
</html>
