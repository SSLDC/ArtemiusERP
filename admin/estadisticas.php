<?php
// Incluir el archivo de conexión
include '../conexion.php'; // Este archivo contiene la conexión a la base de datos

// Obtener el id_usuario desde la URL
$id_usuario = isset($_GET['id_usuario']) ? (int)$_GET['id_usuario'] : 0; // Verificamos si el id_usuario está en la URL
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página con Gráfico</title>
  <link rel="stylesheet" href="../styles/estilosGraficas.css"> <!-- Asegúrate de reemplazar con la ruta correcta -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Task', 'Quantity'],
        <?php
          // Consulta dependiendo del id_usuario
          if ($id_usuario == 3) {
              // Consulta para el id_usuario 3 (Frutería)
              $sql = "SELECT tipo_etnia, concurrencia FROM fruteria";
          } elseif ($id_usuario == 4) {
              // Consulta para el id_usuario 4 (Zapatería)
              $sql = "SELECT marcas, ventas FROM zapateria";
          } elseif ($id_usuario == 5) {
              // Consulta para el id_usuario 5 (Hotel)
              $sql = "SELECT servicios, solicitudes FROM hotel";
          } else {
              // Consulta por defecto o error si el id_usuario no es válido
              $sql = "SELECT tipo_etnia, concurrencia FROM fruteria";
          }

          $consulta = mysqli_query($conexion, $sql);
          $first = true; // Para controlar la coma final
          while ($resultado = mysqli_fetch_assoc($consulta)) {
              if (!$first) {
                  echo ","; // Añadir coma entre elementos, pero no al final
              }
              $first = false;

              // Condición para manejar las diferentes columnas de cada consulta
              if ($id_usuario == 3) {
                  // Para la frutería: tipo_etnia y concurrencia
                  echo "['" . $resultado['tipo_etnia'] . "', " . $resultado['concurrencia'] . "]";
              } elseif ($id_usuario == 4) {
                  // Para la zapatería: marcas y ventas
                  echo "['" . $resultado['marcas'] . "', " . $resultado['ventas'] . "]";
              } elseif ($id_usuario == 5) {
                  // Para el hotel: servicios y solicitudes
                  echo "['" . $resultado['servicios'] . "', " . $resultado['solicitudes'] . "]";
              }
          }
        ?>
      ]);

      var options = {
        title: 'Data Analysis for User <?php echo $id_usuario; ?>'
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));
      chart.draw(data, options);
    }
  </script>
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

  <h2>Gráfico basado en el ID del usuario: <?php echo $id_usuario; ?></h2>
  <div class="graph-container">
    <div id="piechart" style="width: 900px; height: 500px;"></div>
    <!-- Botones de exportación -->
    <div class="export-buttons" style="margin-top: 20px; text-align: center;">
      <a href="../admin/export_files.php?format=csv&id_usuario=<?php echo $id_usuario; ?>">
        <button class="export-btn">📤 CSV</button>
      </a>
      <a href="../admin/export_files.php?format=excel&id_usuario=<?php echo $id_usuario; ?>">
        <button class="export-btn">📤 Excel</button>
      </a>
    </div>
  </div>
</body>
</html>

<?php
session_start();

// Función para renderizar el header con la info del usuario
function userHeader($nombre, $id_usuario) {
    return "
    <header>
        <div class='container'>
            <h1 class='logo'>ARTEMUS</h1>
            <nav>
                <ul class='nav-list'>
                    <!-- Mostramos el nombre y la ID del usuario -->
                    <li class='user-info'>
                      <strong>Hola, $nombre</strong>
                    </li>
                    <!-- El usuario puede cerrar sesión, 
                         pero NO verá el botón para 'Ver Usuarios' -->
                      <li><a href='../user/opciones.php' class='login-btn'>Opciones</a></li>
                    <li><a href='../admin/cerrar_sesion.php' class='login-btn'>Cerrar Sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>";
}
?>
