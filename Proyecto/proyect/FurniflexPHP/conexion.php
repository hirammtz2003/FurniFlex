<?php
session_start();
// Configuración de la base de datos
$servername = "database-furniflex.ct4csksmup3s.us-east-2.rds.amazonaws.com";
$username = "admin";
$password = "peter2468";
$dbname = "furniflex";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificación de la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
