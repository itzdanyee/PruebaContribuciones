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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Administración</title>
    <link rel="stylesheet" href=""> <!-- Incluye tu hoja de estilos -->
</head>
<style>
/* Estilos generales */
body {
    font-family: 'Comic Sans MS', sans-serif; /* Fuente más amigable y divertida */
    background-color: #fdf6e3; /* Fondo suave y cálido */
    margin: 0;
    color: #333;
    display: flex;
    height: 100vh;
    justify-content: flex-start; /* Alinear al inicio */
    padding: 0;
}

/* Estilo del encabezado */
header {
    width: 100%;
    background-color: #ffb6c1; /* Rosa suave para un estilo kawaii */
    padding: 20px;
    text-align: center;
    border-bottom: 3px solid #ff69b4; /* Borde rosa más intenso */
}

h1 {
    margin: 0;
    color: white;
    font-size: 2.5em;
    text-transform: uppercase;
}

/* Estilo del menú de navegación */
nav {
    width: 200px; /* Establecer un ancho fijo para el menú */
    background-color: #ffc0cb; /* Rosa claro */
    padding: 20px;
    border-right: 3px solid #ff69b4; /* Borde a la derecha */
    height: 100vh; /* Asegura que el menú ocupe toda la altura */
}

nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

nav ul li {
    margin-bottom: 20px;
}

nav a {
    color: #ff69b4; /* Color rosa más intenso */
    text-decoration: none;
    font-size: 1.3em;
    transition: color 0.3s;
    font-weight: bold;
}

nav a:hover {
    color: #ff1493; /* Color rosa brillante al pasar el mouse */
}

/* Contenedor principal */
.main-content {
    margin-left: 220px; /* Espacio para el menú a la izquierda */
    padding: 20px;
    background-color: #fff0f5; /* Rosa muy suave para el fondo */
    border-radius: 10px;
    width: 80%;
}

/* Estilo de las secciones dentro del panel de administración */
main h2 {
    font-size: 2rem;
    color: #ff69b4; /* Color rosa para el título */
}

main section {
    margin: 20px 0;
}

/* Estilo para las listas de usuarios */
ul {
    padding-left: 20px;
    list-style-type: none;
}

ul li {
    margin-bottom: 15px;
    font-size: 1.2em;
}

ul li a {
    color: #ff69b4;
    font-weight: bold;
}

ul li a:hover {
    color: #ff1493;
}

/* Estilo de los botones */
.card {
    background-color: #ffb6c1; /* Fondo rosa suave */
    color: #fff;
    padding: 6px 15px; /* Reducir el tamaño del padding */
    border-radius: 8px;
    text-align: center;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    font-size: 0.9em; /* Reducir el tamaño de la fuente */
}

.card:hover {
    transform: scale(1.05); /* Efecto de aumentar el tamaño */
    box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.3);
}

/* Ajustes para dispositivos pequeños */
@media (max-width: 768px) {
    nav {
        width: 100%;
        padding: 10px;
    }

    .main-content {
        margin-left: 0;
        width: 100%;
    }
}
</style>

<body>
    <header>
        <h1>Panel de Administración</h1>
    </header>

    <nav>
        <ul>
            <li><a href="admin.php">Inicio</a></li>
            <li><a href="dashboardAdmin.php">Gestionar Panel</a></li>
            <li><a href="logout.php">Cerrar Sesión</a></li>
        </ul>
    </nav>

    <div class="main-content">
        <main>
            <h2>Bienvenido, Administrador</h2>
            <p>Aquí puedes gestionar la configuración del sistema y los usuarios.</p>

            <section>
                <h3>Estadísticas</h3>
                <p>Aquí puedes mostrar estadísticas sobre los usuarios, actividades, etc.</p>
            </section>

            <section>
                <h3>Acciones Rápidas</h3>
                <ul>
                    <li><a href="register.php" class="card">Añadir Usuario</a></li>
                </ul>
            </section>

            <section>
                <h3>Lista de Usuarios</h3>
                <ul>
                    <?php while ($user = $result->fetch_assoc()): ?>
                        <li>
                            <?= htmlspecialchars($user['name']) ?> - 
                            <a href="editar_usuarios.php?id=<?= $user['id'] ?>" class="card">Editar Usuario</a> - 
                            <a href="delete_user.php?id=<?= $user['id'] ?>" class="card">Eliminar Usuario</a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </section>
        </main>
    </div>
</body>
</html>
