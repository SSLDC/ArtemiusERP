<?php
include '../conexion.php'; 

session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../forms/loog.php");
    exit();
}

$query = "SELECT id_usuario, nombre, email, Apellidos, Telefono FROM usuario WHERE is_admin = 0";
$result = $conexion->query($query);

if (!$result) {
    die("Error en la consulta: " . $conexion->error);
}

// Manejo de POST con redirección para evitar reenviar formularios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['modificar'])) {
        $id_usuario = $_POST['id_usuario'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];

        $update_query = "UPDATE usuario SET nombre='$nombre', Apellidos='$apellidos', email='$email', Telefono='$telefono' WHERE id_usuario='$id_usuario'";
        if ($conexion->query($update_query) === TRUE) {
            $mensaje = "Usuario modificado correctamente. PARA VISUALIZAR LOS CAMBIOS RECARGA LA PÁGINA PULSANDO F5";
        } else {
            $mensaje = "Error al modificar el usuario: " . $conexion->error;
        }
        header("Location: " . $_SERVER['PHP_SELF'] . "?mensaje=" . urlencode($mensaje));
        exit();
    }

    if (isset($_POST['eliminar'])) {
        $id_usuario = $_POST['id_usuario'];
        $delete_query = "DELETE FROM usuario WHERE id_usuario='$id_usuario'";
        if ($conexion->query($delete_query) === TRUE) {
            $mensaje = "Usuario eliminado correctamente. PARA VISUALIZAR LOS CAMBIOS RECARGA LA PÁGINA PULSANDO F5";
        } else {
            $mensaje = "Error al eliminar el usuario: " . $conexion->error;
        }
        header("Location: " . $_SERVER['PHP_SELF'] . "?mensaje=" . urlencode($mensaje));
        exit();
    }
}

// Mensaje de alerta si está presente en la URL
if (isset($_GET['mensaje'])) {
    echo "<script>alert('" . htmlspecialchars($_GET['mensaje']) . "');</script>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar y Eliminar Usuarios</title>
    <link rel="stylesheet" href="../styles/veruserstyle.css">
</head>
<body>
<header>
    <div class="container">
        <h1 class="logo">ARTEMUS</h1>
        <nav>
            <ul class="nav-list">
                <li><a href="../admin/adminMain.php" class="login-btn">Volver</a></li>
            </ul>
        </nav>
    </div>
</header>

<h2>Lista de Usuarios</h2>
<table>
    <thead>
        <tr>
            <th>ID Usuario</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id_usuario']) . "</td>";
                echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Apellidos']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Telefono']) . "</td>";
                echo "<td class='table-actions'>";
                echo "<button class='edit-btn' onclick='showForm(" . $row['id_usuario'] . ")'>✏️</button>";
                echo "<form method='POST' style='display:inline;' onsubmit='return confirmDelete();'>";
                echo "<input type='hidden' name='id_usuario' value='" . $row['id_usuario'] . "'>";
                echo "<button class='delete-btn' type='submit' name='eliminar'>🗑️</button>";
                echo "</form>";
                echo "<a href='estadisticas.php?id_usuario=" . $row['id_usuario'] . "'><button class='chart-btn'>📊</button></a>";
                echo "</td>";
                echo "</tr>";
                echo "<tr class='edit-form' id='form-" . $row['id_usuario'] . "' style='display: none;'>";
                echo "<td colspan='6'>";
                echo "<form method='POST'>";
                echo "<input type='hidden' name='id_usuario' value='" . $row['id_usuario'] . "'>";
                echo "<label>Nombre:</label><input type='text' name='nombre' value='" . $row['nombre'] . "' required>";
                echo "<label>Apellidos:</label><input type='text' name='apellidos' value='" . $row['Apellidos'] . "' required>";
                echo "<label>Email:</label><input type='email' name='email' value='" . $row['email'] . "' required>";
                echo "<label>Teléfono:</label><input type='text' name='telefono' value='" . $row['Telefono'] . "' required>";
                echo "<button type='submit' name='modificar'>Guardar Cambios</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            
        } else {
            echo "<tr><td colspan='6'>No hay usuarios registrados que no sean administradores.</td></tr>";
        }
        ?>
    </tbody>
</table>

<script>
    function showForm(id) {
        const formRow = document.getElementById('form-' + id);
        formRow.style.display = formRow.style.display === 'none' ? 'table-row' : 'none';
    }

    function confirmDelete() {
        return confirm('¿Estás seguro de eliminar este usuario?');
    }
    //hola
</script>

<footer>
    <div class="footer-content">
        <p>© 2024 ARTEMUS. Todos los derechos reservados.</p>
    </div>
</footer>
</body>
</html>
