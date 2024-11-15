<?php
// Incluir archivo de conexión
include '../conexion.php'; 

session_start();

// Verificar si el usuario es un administrador
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../forms/loog.php");
    exit();
}

// Consulta para obtener los usuarios que no son administradores
$query = "SELECT id_usuario, nombre, email, Apellidos, Telefono FROM usuario WHERE is_admin = 0";
$result = $conexion->query($query);

// Verificar si hubo un error en la consulta
if (!$result) {
    die("Error en la consulta: " . $conexion->error);
}

// Procesar la modificación de un usuario
if (isset($_POST['modificar'])) {
    $id_usuario = $_POST['id_usuario'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];

    // Actualizar el usuario en la base de datos
    $update_query = "UPDATE usuarios SET nombre='$nombre', Apellidos='$apellidos', email='$email', Telefono='$telefono' WHERE id_usuario='$id_usuario'";

    if ($conexion->query($update_query) === TRUE) {
        echo "Usuario modificado correctamente";
    } else {
        echo "Error al modificar el usuario: " . $conexion->error;
    }
}

// Procesar la eliminación de un usuario
if (isset($_POST['eliminar'])) {
    $id_usuario = $_POST['id_usuario'];

    // Eliminar el usuario de la base de datos
    $delete_query = "DELETE FROM usuario WHERE id_usuario='$id_usuario'";

    if ($conexion->query($delete_query) === TRUE) {
        echo "Usuario eliminado correctamente";
    } else {
        echo "Error al eliminar el usuario: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar y Eliminar Usuarios</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }

        /* Estilos para los formularios */
        form {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="email"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        /* Flexbox para organizar los campos */
        .form-row {
            display: flex;
            gap: 10px;
        }

        .form-row > div {
            flex: 1;
        }

        .form-row input {
            width: 100%;
        }

        /* Estilo para los formularios de eliminar */
        .form-group input[type="submit"] {
            width: auto;
            padding: 8px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Modificar o Eliminar Usuario</h1>

    <!-- Formulario para Modificar Datos -->
    <h2>Modificar Datos del Usuario</h2>
    <form method="POST" action="">
        <!-- ID Usuario -->
        <div class="form-group">
            <label for="id_usuario">ID Usuario:</label>
            <input type="number" name="id_usuario" required><br><br>
        </div>

        <!-- Nombre y Apellidos en la misma fila -->
        <div class="form-row">
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" required>
            </div>
            <div>
                <label for="apellidos">Apellidos:</label>
                <input type="text" name="apellidos" required>
            </div>
        </div>

        <!-- Email y Teléfono en la misma fila -->
        <div class="form-row">
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" required>
            </div>
            <div>
                <label for="telefono">Teléfono:</label>
                <input type="text" name="telefono" required>
            </div>
        </div>

        <!-- Botón para modificar -->
        <div class="form-group">
            <input type="submit" name="modificar" value="Modificar Usuario">
        </div>
    </form>

    <hr>

    <!-- Formulario para Eliminar Usuario -->
    <h2>Eliminar Usuario</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="id_usuario">ID Usuario:</label>
            <input type="number" name="id_usuario" required><br><br>
        </div>

        <div class="form-group">
            <input type="submit" name="eliminar" value="Eliminar Usuario">
        </div>
    </form>

    <hr>

    <!-- Tabla con Usuarios -->
    <h2>Lista de Usuarios</h2>
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
            // Mostrar los usuarios
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id_usuario']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Apellidos']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Telefono']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No hay usuarios registrados que no sean administradores.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
