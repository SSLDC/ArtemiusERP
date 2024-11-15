<?php
// Incluir la conexión a la base de datos
include '../conexion.php';

// Inicializar variables
$input_username_class = ""; // Clase para el nombre de usuario
$input_password_class = ""; // Clase para la contraseña
$error_message = ""; // Mensaje de error

// Verificar si se han enviado los datos desde el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta en la base de datos para verificar el nombre o el correo
    $sql = "SELECT id_usuario, nombre, is_admin FROM usuario WHERE (nombre = ? OR email = ?) AND contraseña = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sss", $username, $username, $password);
    $stmt->execute();
    $stmt->store_result();

    // Verificar si el usuario existe
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_usuario, $nombre, $is_admin);
        $stmt->fetch();

        // Iniciar sesión y establecer variables de sesión
        session_start();
        $_SESSION['id_usuario'] = $id_usuario;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['is_admin'] = $is_admin;

        // Redirigir según el rol del usuario
        if ($is_admin) {
            header("Location: ../admin/adminMain.php");
        } else {
            header("Location: ../user/userMain.php");
        }
        exit();
    } else {
        // Usuario o contraseña incorrectos, establece las clases para mostrar error
        $input_username_class = "input-error"; // Agregar clase de error
        $input_password_class = "input-error"; // Agregar clase de error
        $error_message = "Usuario o contraseña incorrectos"; // Mensaje de error
    }

    $stmt->close();
}

$conn->close();
?>
