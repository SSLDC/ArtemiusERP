<?php
// Datos de conexión a la base de datos
$servidor = "localhost"; // o la dirección de tu servidor
$usuario = "root"; // tu usuario de base de datos
$contrasena = ""; // tu contraseña de base de datos
$base_datos = "artemus"; // nombre de la base de datos

// Crear la conexión
$conexion = new mysqli($servidor, $usuario, $contrasena, $base_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
