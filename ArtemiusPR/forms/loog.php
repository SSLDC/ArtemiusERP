<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión - ARTEMUS</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../styles/loginstyle.css"> 
</head>
<body>
  <!-- Header -->
  <header>
    <div class="container">
      <h1 class="logo">ARTEMUS</h1>
      <nav>
        <ul class="nav-list">
          <li><a href="../main.html" class="login-btn">Volver</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <section class="hero">
    <section class="login">
      <div class="hero-content">
        <h3>Iniciar Sesión</h3>
      </div>
      <div class="container-login">
        <!-- Mensaje de error si hay fallo en el login -->
        <?php if (isset($_GET['error'])) : ?>
          <p style="color: red; text-align: center;">Usuario o contraseña incorrectos</p>
        <?php endif; ?>

        <form action="login.php" method="POST">
          <div class="form-group">
            <label for="usuario">Nombre de Usuario o E-mail</label>
            <input type="text" id="usuario" name="username" required>
          </div>
          <div class="form-group">
            <label for="contra">Contraseña</label>
            <input type="password" id="contra" name="password" required>
          </div>
          <button type="submit" class="login-btn">Entrar</button>
        </form>
      </div>
    </section>
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
