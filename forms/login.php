<?php
// Habilitar la visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Iniciar la sesión lo antes posible

// Incluir la conexión a la base de datos
include '../conexion.php';

// Inicializar variables
$input_username_class = ""; // Clase para el nombre de usuario
$input_password_class = ""; // Clase para la contraseña
$error_message = ""; // Mensaje de error

// Verificar si se han enviado los datos desde el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Consulta en la base de datos para verificar el nombre o el correo
    $sql = "SELECT id_usuario, nombre, is_admin FROM usuario WHERE (nombre = ? OR email = ?) AND contraseña = ?";
    $stmt = $conexion->prepare($sql);
    
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }

    $stmt->bind_param("sss", $username, $username, $password);
    
    if (!$stmt->execute()) {
        die("Error en la ejecución de la consulta: " . $stmt->error);
    }
    
    $stmt->store_result();

    // Verificar si el usuario existe
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_usuario, $nombre, $is_admin);
        $stmt->fetch();

        // Iniciar sesión y establecer variables de sesión
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

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - ARTEMUS</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
    <form method="POST" action="">
        <div>
            <label for="username">Usuario o Email:</label>
            <input type="text" id="username" name="username" class="<?= $input_username_class ?>" required>
        </div>
        <div>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" class="<?= $input_password_class ?>" required>
        </div>
        <div>
            <button type="submit">Log In</button>
        </div>
        <?php if (!empty($error_message)) : ?>
            <p class="error"><?= $error_message ?></p>
        <?php endif; ?>
    </form>
</body>
</html>
