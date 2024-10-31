<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Mensaje de bienvenida
echo "Bienvenido, " . $_SESSION['role'] . "<br><br>";

// Opciones para el administrador
if ($_SESSION['role'] == 'admin') {
    echo "<h2>Opciones de Administrador:</h2>";
    echo "<a href='registrar_productos.php'>Gestión de Productos</a><br>";
    echo "<a href='gestionar_usuarios.php'>Gestión de Usuarios</a><br>";
} else {
    // Opciones para usuarios regulares
    echo "<h2>Opciones de Usuario:</h2>";
    echo "<a href='comprar_productos.php'>Comprar Productos</a><br>";
}

// Opción para cerrar sesión
echo "<a href='logout.php'>Cerrar Sesión</a>";
?>


<link rel="stylesheet" href="css/cetis.css">

<style>
/* General Styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f0f8ff; /* Color de fondo suave */
    color: #333;
    margin: 0;
    padding: 20px;
}

/* Encabezados */
h2 {
    color: #ff6f61; /* Color suave para encabezados */
    font-size: 24px;
    border-bottom: 2px solid #ff6f61; /* Línea inferior para separar */
    padding-bottom: 10px;
}

/* Enlaces */
a {
    text-decoration: none;
    color: #4a90e2; /* Color de enlace */
    font-size: 18px;
    margin: 5px 0;
    display: inline-block; /* Permite que los enlaces tengan márgenes */
    padding: 8px 15px;
    border-radius: 5px; /* Bordes redondeados */
    transition: background-color 0.3s, color 0.3s; /* Transición suave */
}

a:hover {
    background-color: #ff6f61; /* Color de fondo al pasar el mouse */
    color: white; /* Color del texto al pasar el mouse */
}

/* Botón */
button {
    background-color: #4a90e2; /* Color de fondo del botón */
    color: white; /* Color del texto */
    border: none;
    padding: 10px 20px;
    border-radius: 5px; /* Bordes redondeados */
    font-size: 16px;
    cursor: pointer; /* Cambia el cursor al pasar por encima */
    transition: background-color 0.3s; /* Transición suave */
}

button:hover {
    background-color: #0056b3; /* Color más oscuro al pasar el mouse */
}

/* Espaciado */
br {
    margin: 10px 0; /* Espacio entre líneas */
}

/* Contenedor principal */
.container {
    max-width: 600px; /* Ancho máximo para la sección principal */
    margin: 0 auto; /* Centrar la sección */
    padding: 20px;
    background-color: white; /* Fondo blanco para la sección */
    border-radius: 10px; /* Bordes redondeados */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
}

</style>