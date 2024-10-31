<?php
$host = 'localhost'; // o la dirección del servidor de la base de datos
$dbname = 'papeleriacamila'; // nombre de la base de datos
$username = 'root'; // usuario de la base de datos
$password = ''; // contraseña de la base de datos

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
