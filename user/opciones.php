<?php
include '../conexion.php'; 

session_start();

// Validar que el usuario esté logueado y no sea administrador
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] == 1) {
    header("Location: ../forms/loog.php");
    exit();
}

// Obtener el ID del usuario desde la sesión
$usuario_id = $_SESSION['id_usuario'];

// Modificar la consulta para obtener solo la información del usuario actual
$query = "SELECT id_usuario, nombre, email, Apellidos, Telefono FROM usuario WHERE id_usuario = '$usuario_id'";
$result = $conexion->query($query);

if (!$result) {
    die("Error en la consulta: " . $conexion->error);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar y Eliminar Usuario</title>
    <link rel="stylesheet" href="../styles/veruserstyle.css">
</head>
<body>
<header>
    <div class="container">
        <h1 class="logo">ARTEMUS</h1>
        <nav>
            <ul class="nav-list">
                <li><a href="../user/userMain.php" class="login-btn">Volver</a></li>
            </ul>
        </nav>
    </div>
</header>

<h2>Mi información</h2>
<table>
    <thead>
        <tr>
            <th>ID Usuario</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>Teléfono</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Dado que la consulta filtra por un solo usuario, solo habrá una fila si la información existe
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id_usuario']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Apellidos']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Telefono']) . "</td>";
            echo "<form method='POST' style='display:inline;' onsubmit='return confirmDelete();'>";
            echo "<input type='hidden' name='id_usuario' value='" . $row['id_usuario'] . "'>";
            echo "</form>";
            echo "</tr>";
            echo "<tr class='edit-form' id='form-" . $row['id_usuario'] . "' style='display: none;'>";
            echo "<td colspan='5'>";
            echo "<form method='POST'>";
            echo "<input type='hidden' name='id_usuario' value='" . $row['id_usuario'] . "'>";
            echo "<label>Nombre:</label><input type='text' name='nombre' value='" . $row['nombre'] . "' required>";
            echo "<label>Apellidos:</label><input type='text' name='apellidos' value='" . $row['Apellidos'] . "' required>";
            echo "<label>Email:</label><input type='email' name='email' value='" . $row['email'] . "' required>";
            echo "<label>Teléfono:</label><input type='text' name='telefono' value='" . $row['Telefono'] . "' required>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        } else {
            echo "<tr><td colspan='6'>No se encontró información para este usuario.</td></tr>";
        }
        ?>
    </tbody>
</table>

<footer>
    <div class="footer-content">
        <p>© 2025 ARTEMUS. Todos los derechos reservados.</p>
    </div>
</footer>
</body>
</html>
