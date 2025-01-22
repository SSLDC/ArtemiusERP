<?php
include '../conexion.php'; 

session_start();

// Verificar que sea administrador
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../forms/loog.php");
    exit();
}

// Consulta para obtener todos los usuarios que NO son admin
$query = "SELECT id_usuario, nombre, email, Apellidos, Telefono FROM usuario WHERE is_admin = 0";
$result = $conexion->query($query);

if (!$result) {
    die("Error en la consulta: " . $conexion->error);
}

// Manejo de POST (modificar/eliminar) con redirección para evitar reenviar formularios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Modificar
    if (isset($_POST['modificar'])) {
        $id_usuario = $_POST['id_usuario'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];

        $update_query = "UPDATE usuario 
                         SET nombre='$nombre', Apellidos='$apellidos', email='$email', Telefono='$telefono'
                         WHERE id_usuario='$id_usuario'";
        if ($conexion->query($update_query) === TRUE) {
            $mensaje = "Usuario modificado correctamente. PARA VISUALIZAR LOS CAMBIOS RECARGA LA PÁGINA PULSANDO F5";
        } else {
            $mensaje = "Error al modificar el usuario: " . $conexion->error;
        }
        header("Location: " . $_SERVER['PHP_SELF'] . "?mensaje=" . urlencode($mensaje));
        exit();
    }

    // Eliminar
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

// Mostrar alerta si llega mensaje
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
    <style>
        /* Ajustes para minimizar distancia entre label e input, e incrementar fuente ~3 puntos */

        .edit-form form {
            max-width: 600px;       /* Ancho máximo para no ocupar todo */
            margin: 0 auto;         /* Centrar horizontalmente */
            padding: 0.3em;         /* Reducir padding vertical */
        }

        .edit-form label {
            display: block;
            margin: 0.1em 0 0;      /* Mínimo espacio entre label y input */
            font-weight: bold;
            font-size: 1em;       /* ~3 puntos más grande que el 1.0em estándar */
        }

        .edit-form input[type="text"],
        .edit-form input[type="email"] {
            width: 100%;
            padding: 0.4em;         /* Reducimos el relleno vertical */
            margin-bottom: 0.3em;   /* Espacio mínimo debajo de cada input */
            box-sizing: border-box;
            font-size: 1em;       /* Aumentamos también la fuente de los inputs */
        }

        .edit-form button[type="submit"] {
            padding: 0.5em 0.6em;   /* Botón compacto */
            cursor: pointer;
            font-size: 1em;       /* Más grande para coincidir con los inputs */
        }

        /* Botones de la tabla */
        .table-actions button {
            font-size: 1.3em; /* Ajusta si quieres también más grande aquí */
            cursor: pointer;
            margin: 0 0.2em;
        }
    </style>
</head>
<body>
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
            $id = htmlspecialchars($row['id_usuario']);
            $nombre = htmlspecialchars($row['nombre']);
            $apellidos = htmlspecialchars($row['Apellidos']);
            $email = htmlspecialchars($row['email']);
            $tel = htmlspecialchars($row['Telefono']);

            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$nombre</td>";
            echo "<td>$apellidos</td>";
            echo "<td>$email</td>";
            echo "<td>$tel</td>";
            echo "<td class='table-actions'>";

            // Botón para desplegar/ocultar form
            echo "<button class='edit-btn' onclick='showForm($id)'>✏️</button>";

            // Botón para eliminar
            echo "<form method='POST' style='display:inline;' onsubmit='return confirmDelete();'>";
            echo "<input type='hidden' name='id_usuario' value='$id'>";
            echo "<button class='delete-btn' type='submit' name='eliminar'>🗑️</button>";
            echo "</form>";

   

            // Fila oculta con formulario de edición
            echo "<tr class='edit-form' id='form-$id' style='display: none;'>";
            echo "<td colspan='6'>";
            echo "  <form method='POST'>";
            echo "    <input type='hidden' name='id_usuario' value='$id'>";
            echo "    <label>Nombre:</label>";
            echo "    <input type='text' name='nombre' value='$nombre' required>";
            echo "    <label>Apellidos:</label>";
            echo "    <input type='text' name='apellidos' value='$apellidos' required>";
            echo "    <label>Email:</label>";
            echo "    <input type='email' name='email' value='$email' required>";
            echo "    <label>Teléfono:</label>";
            echo "    <input type='text' name='telefono' value='$tel' required>";
            echo "    <button type='submit' name='modificar'>Guardar Cambios</button>";
            echo "  </form>";
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
    let currentOpenFormId = null; // Controla qué formulario está abierto

    function showForm(id) {
        // Cerrar el que esté abierto, si no es el mismo
        if (currentOpenFormId && currentOpenFormId !== id) {
            document.getElementById('form-' + currentOpenFormId).style.display = 'none';
        }

        const formRow = document.getElementById('form-' + id);
        // Toggle
        if (formRow.style.display === 'none') {
            formRow.style.display = 'table-row';
            currentOpenFormId = id;
        } else {
            formRow.style.display = 'none';
            currentOpenFormId = null;
        }
    }

    function confirmDelete() {
        return confirm('¿Estás seguro de eliminar este usuario?');
    }
</script>
</body>
</html>
