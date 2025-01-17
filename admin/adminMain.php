<?php
session_start();

// Verificamos si el usuario es administrador
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../forms/loog.php");
    exit();
}

// Función para renderizar el header con la info del administrador y el botón Opciones
function adminHeader($nombre, $id_usuario) {
    return "
    <header>
        <div class='container'>
            <h1 class='logo'>ARTEMUS</h1>
            <nav>
                <ul class='nav-list'>
                    <li>
                        <button id='opcionesBtn' style='border: 1px solid white; border-radius: 5px; padding: 0.5em 1em; color: white;
                        background-color: black; text-decoration: none; transition: background-color 0.3s, color 0.3s; cursor: pointer;'>
                            Opciones
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
    <title>Panel de Administración - ARTEMUS</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/adminstyle.css">
    <style>
        /* Área de Opciones: fondo negro, transiciones suaves */
        #opcionesDiv {
            max-height: 0;
            overflow: hidden;
            background: #000;
            color: #fff;
            transition: max-height 0.5s ease;
        }
        #opcionesDiv.show {
            max-height: 500px; /* Ajusta según el contenido */
        }
        /* Estilos para iconos (reutilizando estilos similares si es necesario) */
        .chart-btn, .stock-btn, .project-btn, .chat-btn, .docs-btn {
            font-size: 3em;
            background: none;
            border: none;
            cursor: pointer;
            display: block;
            margin: 0 auto;
        }
        /* Organizar iconos dentro de Opciones con Flexbox */
        .table-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }
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
        /* Estilos opcionales para la tabla dentro de opcionesDiv */
        #opcionesDiv table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        #opcionesDiv th, #opcionesDiv td {
            padding: 10px;
            text-align: center;
        }
        #opcionesDiv th {
            background: #222;
        }
    </style>
</head>
<body>
    <?= adminHeader($nombre_usuario, $id_usuario); ?>

    <section class="hero">
         <div class="hero-content">
            <h2>Hola, <?= htmlspecialchars($nombre_usuario) ?>!</h2>
        </div>
    </section>

    <!-- Área desplegable de Opciones, inicialmente oculta -->
    <div id="opcionesDiv">
        <table>
            <thead>
            </thead>
            <tbody>
                <tr>
                    <td class="table-actions">
                        <!-- Ver Usuarios -->
                        <a href="../admin/verUsuarios.php" class="icon-container">
                            <button class="chart-btn">👥</button>
                            <div class="icon-text">Ver Usuarios</div>
                        </a>
                        <!-- Añadir Usuario -->
                        <a href="../admin/añadirUsuario.php" class="icon-container">
                            <button class="chart-btn">➕</button>
                            <div class="icon-text">Añadir Usuario</div>
                        </a>

                         <!-- Añadir Usuario -->
                         <a href="../admin/cerrar_sesion.php" class="icon-container">
                            <button class="chart-btn">🔒</button>
                            <div class="icon-text">cerrar_sesion</div>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <section class="admin-slogan">
      <h2>Impulsando cada detalle para un futuro brillante</h2>
      <p>Tu dedicación construye las bases para el éxito de ARTEMUS y marca la diferencia día a día.</p>
    </section>

    <section class="services">
        <div class="container3">
            <div class="service-item">
                <h4>Gestión de Usuarios</h4>
                <p>Ver, editar o eliminar cuentas de usuarios registrados en la plataforma.</p>
            </div>
            <div class="service-item">
                <h4>Revisar Estadísticas</h4>
                <p>Accede a estadísticas detalladas sobre el uso de la plataforma y los servicios contratados.</p>
            </div>
            <div class="service-item">
                <h4>Configuraciones de Plataforma</h4>
                <p>Ajusta configuraciones clave para mantener el funcionamiento óptimo de la plataforma.</p>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <p>© 2024 ARTEMUS. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script>
        // Alternar la visibilidad del área de Opciones con efecto smooth
        document.getElementById('opcionesBtn').addEventListener('click', function() {
            var opcionesDiv = document.getElementById('opcionesDiv');
            opcionesDiv.classList.toggle('show');
        });
    </script>
</body>
</html>
