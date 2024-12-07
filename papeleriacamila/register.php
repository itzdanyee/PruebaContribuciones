<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Encriptar la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Preparar la consulta para evitar inyección SQL
    $query = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $query->bind_param("ssss", $nombre, $email, $hashed_password, $role);

    if ($query->execute()) {
        $_SESSION['user_id'] = $conn->insert_id;
        $_SESSION['role'] = $role;

        // Redireccionar según el rol
        if ($_SESSION['role'] == "1") {
            header("Location: admin.php"); // Página de administración
        } else {
            header("Location: index.php"); // Página del dashboard
        }
        exit(); // Siempre es bueno usar exit después de un header
    } else {
        $error = "Error en el registro: " . $query->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Registro - Papelería</title>
</head>
<style>
/* Estilos generales */
body {
    font-family: 'Comic Sans MS', sans-serif; /* Fuente amigable y juguetona */
    background-color: #fdf6e3; /* Fondo suave y cálido */
    margin: 0;
    color: #333;
    display: flex;
    justify-content: center; /* Centrar todo en la pantalla */
    align-items: center;
    height: 100vh; /* Asegura que el cuerpo ocupe toda la altura */
}

/* Contenedor del formulario */
.login-container {
    background-color: #fff0f5; /* Rosa claro para el fondo */
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    text-align: center;
}

/* Título */
h2 {
    color: #ff69b4; /* Color rosa brillante */
    font-size: 2.5rem;
    margin-bottom: 20px;
}

/* Mensajes de error */
.error {
    color: #ff4d6d;
    font-size: 1.1em;
    margin-bottom: 20px;
}

/* Estilo de las etiquetas */
label {
    color: #ff69b4;
    font-weight: bold;
    display: block;
    margin-bottom: 10px;
    font-size: 1.1rem;
}

/* Estilo de los inputs */
input[type="text"],
input[type="email"],
input[type="password"],
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 2px solid #ff69b4;
    border-radius: 8px;
    font-size: 1rem;
    color: #333;
    background-color: #fff;
    transition: border-color 0.3s;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="password"]:focus,
select:focus {
    border-color: #ff1493; /* Cambiar el color del borde cuando el input está en foco */
}

/* Estilo del botón */
button {
    width: 100%;
    padding: 12px;
    background-color: #ff69b4; /* Rosa brillante */
    color: white;
    font-size: 1.1rem;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #ff1493; /* Rosa más oscuro al pasar el mouse */
}

/* Enlace para iniciar sesión */
p {
    margin-top: 20px;
    font-size: 1.1rem;
}

a {
    color: #ff69b4;
    text-decoration: none;
}

a:hover {
    color: #ff1493; /* Cambio de color al pasar el mouse */
}

/* Ajustes para dispositivos pequeños */
@media (max-width: 600px) {
    .login-container {
        width: 90%; /* Hacer el formulario más pequeño en pantallas pequeñas */
    }
}
</style>

<body>
    <div class="login-container">
        <h2>Registro</h2>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <label for="role">Rol:</label>
            <select id="role" name="role" required>
                <option value="1">Administrador</option>
                <option value="2">Usuario</option>
            </select>

            <button type="submit" name="register">Registrarse</button>
        </form>
        <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
    </div>
</body>
</html>
