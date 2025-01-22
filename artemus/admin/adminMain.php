<?php
session_start();

// Verificar que el usuario sea administrador
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../forms/loog.php");
    exit();
}

// Función para renderizar el header con la info del administrador
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
            max-height: 1000px; /* Ajusta según tu contenido */
        }

        /* Tabla para mostrar íconos (Ver Usuarios, Añadir Usuario, etc.) */
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
        .chart-btn, .stock-btn, .project-btn, .chat-btn, .docs-btn {
            font-size: 3em;
            background: none;
            border: none;
            cursor: pointer;
            display: block;
            margin: 0 auto;
        }
        .icon-text {
            font-size: 1em;
            margin-top: 0.5em;
        }

        /* Sub-desplegables internos (acordeón) para cada sección */
        #verUsuariosDiv, 
        #anadirUsuarioDiv {
            max-height: 0;
            overflow: hidden;
            background-color: #000;
            color: #fff;
            transition: max-height 0.5s ease;
        }
        #verUsuariosDiv.show,
        #anadirUsuarioDiv.show {
            max-height: 800px; /* Ajusta según tu contenido */
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
            <tbody>
                <!-- FILA con los iconos -->
                <tr>
                    <td class="table-actions">
                        <!-- Botón para VER USUARIOS (sub-desplegable) -->
                        <div class="icon-container">
                            <button id="verUsuariosBtn" class="chart-btn">👥</button>
                            <div class="icon-text">Ver Usuarios</div>
                        </div>

                        <!-- Botón para AÑADIR USUARIO (sub-desplegable) -->
                        <div class="icon-container">
                            <button id="anadirUsuarioBtn" class="chart-btn">➕</button>
                            <div class="icon-text">Añadir Usuario</div>
                        </div>

                        <a href="../admin/allCharts.php" class="icon-container">
                            <button class="chart-btn">📈</button>
                            <div class="icon-text">Estadisticas</div>
                        </a>

                        <!-- CERRAR SESIÓN (enlace normal) -->
                        <a href="../admin/cerrar_sesion.php" class="icon-container">
                            <button class="chart-btn">🔒</button>
                            <div class="icon-text">Cerrar Sesión</div>
                        </a>
                    </td>
                </tr>

                <!-- FILA sub-desplegable para VER USUARIOS -->
                <tr>
                    <td colspan="100%">
                        <div id="verUsuariosDiv">
                            <iframe 
                                src="../admin/verUsuarios.php" 
                                style="width: 100%; height: 600px; border: none;">
                            </iframe>
                        </div>
                    </td>
                </tr>

                <!-- FILA sub-desplegable para AÑADIR USUARIO -->
                <tr>
                    <td colspan="100%">
                        <div id="anadirUsuarioDiv">
                            <iframe 
                                src="../admin/añadirUsuario.php"
                                style="width: 100%; height: 600px; border: none;">
                            </iframe>
                        </div>
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
            <p>© 2025 ARTEMUS. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script>
        // 1) Mostrar/ocultar área principal de Opciones
        document.getElementById('opcionesBtn').addEventListener('click', function() {
            var opcionesDiv = document.getElementById('opcionesDiv');
            opcionesDiv.classList.toggle('show');
        });

        // 2) Sub-desplegables (acordeón) para "Ver Usuarios" y "Añadir Usuario"
        const verUsuariosBtn   = document.getElementById('verUsuariosBtn');
        const anadirUsuarioBtn = document.getElementById('anadirUsuarioBtn');

        const verUsuariosDiv   = document.getElementById('verUsuariosDiv');
        const anadirUsuarioDiv = document.getElementById('anadirUsuarioDiv');

        // Al hacer clic en "Ver Usuarios", se cierra "Añadir Usuario"
        verUsuariosBtn.addEventListener('click', function() {
            anadirUsuarioDiv.classList.remove('show');
            verUsuariosDiv.classList.toggle('show');
        });

        // Al hacer clic en "Añadir Usuario", se cierra "Ver Usuarios"
        anadirUsuarioBtn.addEventListener('click', function() {
            verUsuariosDiv.classList.remove('show');
            anadirUsuarioDiv.classList.toggle('show');
        });
    </script>
</body>
</html>
