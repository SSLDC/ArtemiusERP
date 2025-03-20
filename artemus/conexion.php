<?php
// Datos de conexión a la base de datos
$host = "localhost";  // Cambia este valor si usas un host distinto
$dbname = "artemus";  // Nombre de la base de datos que creamos antes
$username = "root";  // Usuario de la base de datos
$password = "";  // Contraseña de la base de datos

// Crear la conexión
$conn = new mysqli($host, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}
?>
