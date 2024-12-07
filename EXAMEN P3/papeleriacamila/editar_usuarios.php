<?php
session_start();

// Verificar si el usuario ha iniciado sesión y tiene el rol adecuado
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "1") {
    header("Location: login.php"); // Redirigir a la página de inicio de sesión
    exit();
}

// Conectar a la base de datos
include 'db.php'; // Asegúrate de tener un archivo para la conexión a la base de datos

// Verificar si se ha enviado un ID de usuario
if (isset($_GET['id'])) {
    $userId = intval($_GET['id']); // Obtener el ID del usuario de la URL

    // Obtener la información del usuario
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró el usuario
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        $error = "Usuario no encontrado.";
    }

    // Manejar el envío del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        // Actualizar la información del usuario
        $updateStmt = $conn->prepare("UPDATE users SET name = ?, email = ?, role = ? WHERE id = ?");
        $updateStmt->bind_param("ssii", $username, $email, $role, $userId);

        if ($updateStmt->execute()) {
            header("Location: admin.php"); // Redirigir después de la actualización
            exit();
        } else {
            $error = "Error al actualizar el usuario.";
        }
    }
} else {
    $error = "ID de usuario no proporcionado.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="styles.css"> <!-- Incluye tu hoja de estilos -->
</head>
<style>
/* Estilos generales */
body {
    font-family: 'Comic Sans MS', sans-serif; /* Fuente amigable y juguetona */
    background-color: #fef5f9; /* Fondo suave y claro */
    margin: 0;
    color: #333;
    display: flex;
    justify-content: center; /* Centrar todo en la pantalla */
    align-items: center;
    height: 100vh; /* Asegura que el cuerpo ocupe toda la altura */
}

/* Contenedor principal */
.admin-container {
    background-color: #fff; /* Blanco para que resalten los detalles */
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1); /* Sombra suave */
    width: 100%;
    max-width: 500px;
    text-align: center;
    border: 2px solid #f6b8d1; /* Bordes suaves de color rosa */
}

/* Título */
h1 {
    color: #ff90a6; /* Rosa pastel brillante */
    font-size: 2.5rem;
    margin-bottom: 20px;
    font-family: 'Comic Sans MS', sans-serif;
}

/* Estilo de las etiquetas */
label {
    color: #ff90a6;
    font-weight: bold;
    display: block;
    margin-bottom: 10px;
    font-size: 1.1rem;
    text-align: left;
}

/* Estilo de los inputs */
input[type="text"],
input[type="email"],
select {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: 2px solid #ff90a6;
    border-radius: 12px;
    font-size: 1rem;
    color: #333;
    background-color: #fff;
    transition: border-color 0.3s;
}

/* Efecto de enfoque en los inputs */
input[type="text"]:focus,
input[type="email"]:focus,
select:focus {
    border-color: #ff74c3; /* Cambio de color cuando se hace foco en el input */
}

/* Estilo del botón */
button {
    width: 100%;
    padding: 12px;
    background-color: #ff90a6; /* Rosa pastel brillante */
    color: white;
    font-size: 1.1rem;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
}

/* Efecto hover en el botón */
button:hover {
    background-color: #ff74c3; /* Cambio a rosa más intenso */
}

/* Estilo para los mensajes de error */
p {
    color: #ff4d5a; /* Rojo suave para los mensajes de error */
    font-size: 1.1rem;
    margin-top: 10px;
}

/* Enlace para cerrar sesión */
nav ul {
    list-style: none;
    padding: 0;
    text-align: center;
}

nav ul li {
    display: inline-block;
    margin: 0 10px;
}

nav a {
    color: #ff90a6;
    text-decoration: none;
    font-size: 1.1rem;
    font-weight: bold;
}

nav a:hover {
    color: #ff74c3; /* Cambio de color al pasar el mouse */
}

/* Animaciones y transiciones */
@keyframes float {
    0% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0); }
}

button, input[type="text"], input[type="email"], select {
    animation: float 2s infinite; /* Animación para hacer los elementos "flotar" */
}

/* Ajustes para dispositivos pequeños */
@media (max-width: 600px) {
    .admin-container {
        width: 90%; /* Hacer el formulario más pequeño en pantallas pequeñas */
    }
}
</style>
<body>
    <header>
        <h1>Panel de Administración</h1>
        <nav>
            <ul>
                <li><a href="admin.php">Inicio</a></li>
                <li><a href="logout.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="admin-container">
            <form method="POST" action="">
                <div class="card">
                    <h3>Editar Información del Usuario</h3>

                    <?php if (isset($error)): ?>
                        <p style="color: red;"><?= $error ?></p>
                    <?php endif; ?>

                    <label for="username">Nombre de Usuario:</label>
                    <input type="text" name="username" id="username" value="<?= isset($user) ? htmlspecialchars($user['name']) : '' ?>" required>

                    <label for="email">Correo Electrónico:</label>
                    <input type="email" name="email" id="email" value="<?= isset($user) ? htmlspecialchars($user['email']) : '' ?>" required>

                    <label for="role">Rol:</label>
                    <select name="role" id="role">
                        <option value="1" <?= isset($user) && $user['role'] == 1 ? 'selected' : '' ?>>Administrador</option>
                        <option value="2" <?= isset($user) && $user['role'] == 2 ? 'selected' : '' ?>>Usuario</option>
                    </select>

                    <button type="submit">Actualizar Usuario</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>