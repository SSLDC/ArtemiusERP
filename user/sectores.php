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
$query = "SELECT id_usuario FROM usuario WHERE id_usuario = '$usuario_id'";
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
    <style>
        /* Estilos para agrandar iconos y formatear contenedores */
        .chart-btn, .stock-btn, .project-btn, .chat-btn, .docs-btn, .maint-btn, .employees-btn, .subs-btn {
            font-size: 3em;
            background: none;
            border: none;
            cursor: pointer;
            display: block;
            margin: 0 auto;
        }

        .icon-container {
            text-align: center;
            text-decoration: none;
            color: inherit;
            margin-bottom: 1em;
            flex: 1 1 calc(20% - 10px); /* Aproximadamente 5 elementos por fila */
        }

        .icon-text {
            font-size: 1em;
            margin-top: 0.5em;
        }

        /* Estilos para la celda de acciones para organizar los iconos en filas */
        .table-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: flex-start;
        }
    </style>
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

<h2>SECTORES</h2>
<table>
    <thead>
        <tr>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<tr>";
            echo "<td class='table-actions'>";

            // Sector de Ventas
            echo "<a href='../user/estadisticasUser.php?id_usuario=" . htmlspecialchars($row['id_usuario']) . "' class='icon-container'>";
            echo "<button class='chart-btn'>📊</button>";
            echo "<div class='icon-text'>Sector de ventas</div>";
            echo "</a>";

            // Módulo de Stock
            echo "<a href='../user/stockModule.php?id_usuario=" . htmlspecialchars($row['id_usuario']) . "' class='icon-container'>";
            echo "<button class='stock-btn'>📦</button>";
            echo "<div class='icon-text'>Módulo de Stock</div>";
            echo "</a>";

            // Proyecto
            echo "<a href='../user/proyecto.php?id_usuario=" . htmlspecialchars($row['id_usuario']) . "' class='icon-container'>";
            echo "<button class='project-btn'>📁</button>";
            echo "<div class='icon-text'>Proyecto</div>";
            echo "</a>";

            // Chat en vivo
            echo "<a href='../user/chatEnVivo.php?id_usuario=" . htmlspecialchars($row['id_usuario']) . "' class='icon-container'>";
            echo "<button class='chat-btn'>💬</button>";
            echo "<div class='icon-text'>Chat en vivo</div>";
            echo "</a>";

            // Documentos
            echo "<a href='../user/documentos.php?id_usuario=" . htmlspecialchars($row['id_usuario']) . "' class='icon-container'>";
            echo "<button class='docs-btn'>📄</button>";
            echo "<div class='icon-text'>Documentos</div>";
            echo "</a>";

            // Mantenimiento
            echo "<a href='../user/mantenimiento.php?id_usuario=" . htmlspecialchars($row['id_usuario']) . "' class='icon-container'>";
            echo "<button class='maint-btn'>🛠️</button>";
            echo "<div class='icon-text'>Mantenimiento</div>";
            echo "</a>";

            // Empleados
            echo "<a href='../user/empleados.php?id_usuario=" . htmlspecialchars($row['id_usuario']) . "' class='icon-container'>";
            echo "<button class='employees-btn'>👥</button>";
            echo "<div class='icon-text'>Empleados</div>";
            echo "</a>";

            // Subscripciones+
            echo "<a href='../user/subscripciones.php?id_usuario=" . htmlspecialchars($row['id_usuario']) . "' class='icon-container'>";
            echo "<button class='subs-btn'>➕</button>";
            echo "<div class='icon-text'>Subscripciones+</div>";
            echo "</a>";

            echo "</td>";
            echo "</tr>";
        } else {
            echo "<tr><td>No se encontró información para este usuario.</td></tr>";
        }
        ?>
    </tbody>
</table>

<script>
    function confirmDelete() {
        return confirm('¿Estás seguro de eliminar este usuario?');
    }
</script>

<footer>
    <div class="footer-content">
        <p>© 2024 ARTEMUS. Todos los derechos reservados.</p>
    </div>
</footer>
</body>
</html>
