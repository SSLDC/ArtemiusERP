<?php
session_start();

// Verificar que el usuario es administrador
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../forms/loog.php");
    exit();
}

include '../conexion.php';

// Función para renderizar el header básico sin saludo ni botones adicionales
function adminHeader($nombre, $id_usuario) {
    return "
    <header>
        <div class='container'>
            <h1 class='logo'>ARTEMUS</h1>
            <nav>
                <ul class='nav-list'>
                    <li><a href='adminMain.php' class='login-btn'>Volver</a></li>
                </ul>
            </nav>
        </div>
    </header>";
}

$nombre_usuario = $_SESSION['nombre'];
$id_usuario = $_SESSION['id_usuario'];

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recopilar datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $password = $_POST['password'] ?? '';
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    // Asignar role_id basado en is_admin
    $role_id = $is_admin ? 1 : 2;

    // Insertar nuevo usuario en la base de datos sin cifrar la contraseña
    $stmt = $conexion->prepare("INSERT INTO usuario (nombre, Apellidos, email, Telefono, contraseña, is_admin, role_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("ssssiii", $nombre, $apellidos, $email, $telefono, $password, $is_admin, $role_id);
        if ($stmt->execute()) {
            $mensaje = "Usuario añadido correctamente.";
        } else {
            $mensaje = "Error al añadir el usuario: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $mensaje = "Error en la preparación de la consulta: " . $conexion->error;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Usuario - ARTEMUS</title>
    <!-- Carga de la hoja de estilos proporcionada -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/adminstyle.css">
    <style>
        /* Estilos específicos para el formulario dentro de la página */
        .form-container {
            max-width: 500px;
            margin: 20px auto;
            background: #333;
            padding: 20px;
            border-radius: 8px;
            color: #fff;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container label {
            display: block;
            margin-top: 10px;
        }
        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #555;
            border-radius: 5px;
            background: #222;
            color: #fff;
        }
        .form-container input[type="checkbox"] {
            margin-right: 5px;
        }
        .form-container button {
            margin-top: 20px;
            width: 100%;
            padding: 10px;
            background: #4CAF50;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 1em;
            cursor: pointer;
        }
        .form-container button:hover {
            background: #45a049;
        }
        .mensaje {
            text-align: center;
            margin-top: 15px;
            color: #0f0;
        }
    </style>
</head>
<body>
    <?= adminHeader($nombre_usuario, $id_usuario); ?>

    <div class="form-container">
        <h2>Añadir Nuevo Usuario</h2>
        <?php if ($mensaje): ?>
            <p class="mensaje"><?= htmlspecialchars($mensaje) ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <label for="is_admin">
                <input type="checkbox" id="is_admin" name="is_admin">
                Administrador
            </label>

            <button type="submit">Añadir Usuario</button>
        </form>
    </div>

    <footer>
        <div class="footer-content">
            <p>© 2024 ARTEMUS. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>
