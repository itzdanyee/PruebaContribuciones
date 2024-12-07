<?php
$servername = "fdb1028.awardspace.net"; // Reemplaza con el nombre del servidor proporcionado por InfinityFree
$username = "4560798_proyectocamila"; // Reemplaza con tu nombre de usuario de la base de datos
$password = "darckar23"; // Reemplaza con tu contraseña de la base de datos
$dbname = "4560798_proyectocamila"; // Reemplaza con el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
