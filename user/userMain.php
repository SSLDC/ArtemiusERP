<?php
session_start();

// Verificar que el usuario NO sea administrador
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] == 1) {
    header("Location: ../forms/loog.php");
    exit();
}

// Función para renderizar el header con la info del usuario
function userHeader($nombre, $id_usuario)
{
    return "
    <header>
        <div class='container'>
            <h1 class='logo'>ARTEMUS</h1>
            <nav>
                <ul class='nav-list'>
                    <!-- Botón que despliega el área de Sectores -->
                    <li><button id='sectoresBtn' style='border: 1px solid white; border-radius: 5px; padding: 0.5em 1em;  color: white;
                    background-color: black; text-decoration: none; transition: background-color 0.3s, color 0.3s; cursor: pointer; '>
    Sectores
  </button>
</li>
                </ul>
            </nav>
        </div>
    </header>";
}

$nombre_usuario = $_SESSION['nombre'];
$id_usuario = $_SESSION['id_usuario'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área de Usuario - ARTEMUS</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/userstyle.css">
    <style>
        /* Área de Sectores: fondo negro, transiciones suaves */
        #sectoresDiv {
            max-height: 0;
            overflow: hidden;
            background: #000;
            color: #fff;
            transition: max-height 0.5s ease;
        }

        #sectoresDiv.show {
            max-height: 1000px;
            /* Ajusta según el contenido */
        }

        /* Estilos para iconos */
        .chart-btn,
        .stock-btn,
        .project-btn,
        .chat-btn,
        .docs-btn {
            font-size: 3em;
            background: none;
            border: none;
            cursor: pointer;
            display: block;
            margin: 0 auto;
        }

        /* Organizar iconos con Flexbox sin ancho fijo para permitir envoltura dinámica */
        .table-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            /* Centrar elementos */
        }

        /* Contenedor para cada icono sin ancho fijo */
        .icon-container {
            flex: 1 1 auto;
            text-align: center;
            text-decoration: none;
            color: inherit;
            margin-bottom: 1em;
        }

        .icon-text {
            font-size: 1em;
            margin-top: 0.5em;
        }

        /* Opcional: estilos para la tabla dentro de sectoresDiv */
        #sectoresDiv table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        #sectoresDiv th,
        #sectoresDiv td {
            padding: 10px;
            text-align: center;
        }

        #sectoresDiv th {
            background: #222;
        }
    </style>
</head>

<body>
    <?= userHeader($nombre_usuario, $id_usuario); ?>

    <!-- Área desplegable de Sectores, inicialmente oculta -->
    <div id="sectoresDiv">
        <?php
        include '../conexion.php';
        $usuario_id = $_SESSION['id_usuario'];
        $query = "SELECT id_usuario FROM usuario WHERE id_usuario = '$usuario_id'";
        $result = $conexion->query($query);
        ?>
        <table>
            <thead>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
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


                    // Chat en vivo
                    echo "<a href='../user/chatEnVivo.php?id_usuario=" . htmlspecialchars($row['id_usuario']) . "' class='icon-container'>";
                    echo "<button class='chat-btn'>💬</button>";
                    echo "<div class='icon-text'>Chat en vivo</div>";
                    echo "</a>";

                    // Mi Perfil
                    echo "<a href='../user/opciones.php' class='icon-container'>";
                    echo "<button class='docs-btn'>👤</button>";
                    echo "<div class='icon-text'>Mi Perfil</div>";
                    echo "</a>";

                    // Cerrar Sesión (reemplazando Documentos)
                    echo "<a href='../admin/cerrar_sesion.php' class='icon-container'>";
                    echo "<button class='docs-btn'>🔒</button>";
                    echo "<div class='icon-text'>Cerrar Sesión</div>";
                    echo "</a>";

                    echo "</td>";
                    echo "</tr>";
                } else {
                    echo "<tr><td>No se encontró información para este usuario.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <section class="hero">
        <div class="hero-content">
            <h2>Hola, <?= htmlspecialchars($nombre_usuario) ?>!</h2>
        </div>
    </section>

    <!-- Bloque de slogan para el usuario -->
    <section class="user-slogan">
        <h2>Explora y aprovecha al máximo nuestros servicios</h2>
        <p>En ARTEMUS, tu potencial es nuestro compromiso. ¡Gracias por confiar en nosotros!</p>
    </section>

    <!-- Sección de Servicios o Acciones disponibles para el usuario -->
    <section class="services">
        <div class="container3">
            <div class="service-item">
                <h4>Gestión de tu Perfil</h4>
                <p>Edita tu información personal, cambia tu contraseña o revisa tus datos.</p>
            </div>
            <div class="service-item">
                <h4>Mis Compras / Suscripciones</h4>
                <p>Revisa tus servicios contratados y tus historiales de compra.</p>
            </div>
            <div class="service-item">
                <h4>Explora Servicios Nuevos</h4>
                <p>Accede a los servicios más destacados y descubre oportunidades para tu crecimiento.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <p>© 2024 ARTEMUS. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script>
        // Alternar la visibilidad del área de Sectores con efecto smooth
        document.getElementById('sectoresBtn').addEventListener('click', function () {
            var sectoresDiv = document.getElementById('sectoresDiv');
            sectoresDiv.classList.toggle('show');
        });
    </script>
</body>

</html>