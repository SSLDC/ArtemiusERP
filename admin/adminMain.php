<?php
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../forms/loog.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Administración - ARTEMUS</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../styles/adminstyle.css"> <!-- Archivo CSS específico para administrador -->
</head>
<body>
  <!-- Header con logotipo y enlaces de administración -->
  <header>
    <div class="container">
      <h1 class="logo">ARTEMUS</h1>
      <nav>
        <ul class="nav-list">
          <li><a href="../admin/verUsuarios.php" class="login-btn">Ver Usuarios</a></li>
          <li><a href="../logout.php" class="login-btn">Cerrar Sesión</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Hero Section del Administrador -->
  <section class="hero">
    <div class="hero-content">
      <h2>Panel de Administración</h2>
    </div>
  </section>

<!-- Bloque de slogan para el administrador -->
<section class="admin-slogan">
  <h2>Impulsando cada detalle para un futuro brillante</h2>
  <p>Tu dedicación construye las bases para el éxito de ARTEMUS y marca la diferencia día a día.</p>
</section>


  <!-- Sección de Administración de Usuarios -->
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

  <!-- Footer -->
  <footer>
    <div class="footer-content">
      <p>© 2024 ARTEMUS. Todos los derechos reservados.</p>
    </div>
  </footer>

  <script src="../script.js"></script>
</body>
</html>
