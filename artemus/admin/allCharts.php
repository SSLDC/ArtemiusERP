<?php
session_start();

// Verificar que sea admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../forms/loog.php");
    exit();
}

include '../conexion.php'; // Ajusta la ruta si es necesario

// Opcional: Cargar los usuarios no admin para generar todas las    áficas
$usuariosQuery = "SELECT id_usuario FROM usuario WHERE is_admin = 0";
$usuariosRes = $conexion->query($usuariosQuery);
if (!$usuariosRes) {
    die("Error en la consulta de usuarios: " . $conexion->error);
}

// Función para renderizar un header simple con un "botón" Atrás
function adminHeaderSimple($nombre, $id_usuario) {
    // Usamos un <a> con estilos para simular un botón
    return "
    <header>
        <div class='container' style='display: flex; justify-content: space-between; align-items: center;'>
            <h1 class='logo'>ARTEMUS</h1>
            <nav>
                <ul class='nav-list' style='list-style: none; margin: 0; padding: 0; display: flex;'>
                    <li style='margin-right: 10px;'>
                        <a href='../admin/adminMain.php' 
                           style='display: inline-block; text-decoration: none; background: black; color: white; padding: 0.5em 1em; border: 1px solid white; border-radius: 5px;'>
                            Atrás
                        </a>
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
  <title>Todas las Gráficas</title>
  <link rel="stylesheet" href="../styles/adminstyle.css">
  <!-- Cargar Google Charts -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script>
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawAllCharts);

  function drawAllCharts() {
    <?php
    // 1) Recorremos cada usuario no admin
    while ($u = $usuariosRes->fetch_assoc()) {
      $uid = (int)$u['id_usuario'];

      // 2) Determinamos la tabla a consultar según su ID
      switch($uid) {
          case 3:
              $sql = "SELECT tipo_etnia AS label, concurrencia AS val FROM fruteria";
              $title = "Gráfica Frutería (User 3)";
              break;
          case 4:
              $sql = "SELECT marcas AS label, ventas AS val FROM zapateria";
              $title = "Gráfica Zapatería (User 4)";
              break;
          case 5:
              $sql = "SELECT servicios AS label, solicitudes AS val FROM hotel";
              $title = "Gráfica Hotel (User 5)";
              break;
          default:
              // Si no manejas otros IDs, continuamos con el siguiente
              continue 2; 
      }

      // 3) Ejecutar la consulta
      $resultData = $conexion->query($sql);
      $pairs = [];
      if ($resultData && $resultData->num_rows > 0) {
        while($fila = $resultData->fetch_assoc()) {
          $label = $fila['label'];
          $val   = (int)$fila['val'];
          $pairs[] = "['{$label}', {$val}]";
        }
      }

      // 4) Generar DataTable en JS
      echo "var data$uid = new google.visualization.DataTable();\n";
      echo "data$uid.addColumn('string','Item');\n";
      echo "data$uid.addColumn('number','Cantidad');\n";
      if (!empty($pairs)) {
        echo "data$uid.addRows([" . implode(",", $pairs) . "]);\n";
      }

      // 5) Opciones y draw
      echo "var options$uid = { title: '$title' };\n";
      echo "var chart$uid = new google.visualization.PieChart(document.getElementById('chart_$uid'));\n";
      echo "chart$uid.draw(data$uid, options$uid);\n";
    }
    ?>
  }
  </script>
</head>
<body style="background:#000; color:#fff;">
  <!-- Header con "Atrás" -->
  <?= adminHeaderSimple($nombre_usuario, $id_usuario); ?>

  <h2 style="text-align:center; margin-top:20px;">Todas las Gráficas</h2>

  <?php
  // Volvemos el puntero al inicio para crear los divs
  mysqli_data_seek($usuariosRes, 0);

  // Contenedor principal
  echo "<div style='width: 90%; max-width: 1000px; margin: 20px auto;'>";

  while($u = $usuariosRes->fetch_assoc()) {
    $uid = (int)$u['id_usuario'];
    // Mismo switch para decidir si ID = 3,4,5
    if (!in_array($uid, [3,4,5])) {
      continue;
    }

    // Título de la gráfica (mismo que en el drawAllCharts)
    switch($uid) {
      case 3:     break;
      case 4:     break;
      case 5:      break;
    }

    // DIV de cada gráfica
    echo "<div style='margin: 20px auto; background:#111; padding:20px; border-radius:5px;'>";
    echo "  <div id='chart_$uid' style='width:900px; height:500px; margin: 0 auto;'></div>";

    // BOTONES de exportación (Excel / CSV)
    echo "  <div style='text-align:center; margin-top:10px;'>";
    echo "    <a href='../admin/export_files.php?format=csv&id_usuario=$uid' style='text-decoration:none; margin-right:10px;'>";
    echo "      <button style='cursor:pointer; padding:0.5em 1em; border:none; background:#4CAF50; color:#fff; border-radius:5px;'>📤 CSV</button>";
    echo "    </a>";

    echo "    <a href='../admin/export_files.php?format=excel&id_usuario=$uid' style='text-decoration:none;'>";
    echo "      <button style='cursor:pointer; padding:0.5em 1em; border:none; background:#2196F3; color:#fff; border-radius:5px;'>📤 Excel</button>";
    echo "    </a>";
    echo "  </div>";

    echo "</div>"; // fin del contenedor de la gráfica
  }

  echo "</div>"; // fin del contenedor principal
  ?>
</body>
<footer>
        <div class="footer-content">
            <p>© 2025 ARTEMUS. Todos los derechos reservados.</p>
        </div>
    </footer>
</html>
