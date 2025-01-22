<?php
session_start();

// Verificar que el usuario NO sea administrador
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] == 1) {
    header("Location: ../forms/loog.php");
    exit();
}

// Conexión a la DB
include '../conexion.php';

// Obtenemos el ID del usuario actual y su nombre
$usuario_id = $_SESSION['id_usuario'];
$nombre_usuario = $_SESSION['nombre'];

// 1) Consulta para validar que existe el usuario
$query = "SELECT id_usuario FROM usuario WHERE id_usuario = '$usuario_id'";
$result = $conexion->query($query);
if (!$result) {
    die("Error en la consulta: " . $conexion->error);
}

// 2) Definir la consulta adicional según el id para Stock
switch ($usuario_id) {
    case 3:  // frutería
        $query_adicional = "SELECT tipo_etnia, concurrencia FROM fruteria";
        break;
    case 4:  // zapatería
        $query_adicional = "SELECT marcas, ventas FROM zapateria";
        break;
    case 5:  // hotel
        $query_adicional = "SELECT servicios, solicitudes FROM hotel";
        break;
    default:
        $query_adicional = "";
        break;
}

// Ejecutar la consulta adicional si corresponde (para el formulario de Stock)
if ($query_adicional) {
    $result_adicional = $conexion->query($query_adicional);
    if (!$result_adicional) {
        die("Error en la consulta adicional: " . $conexion->error);
    }
}

// 3) Lógica de inserción/actualización (Módulo de Stock) e **lógica de borrado** (Eliminar Stock)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // ----------------------------------------------------------------
    // A) Eliminar Stock
    // ----------------------------------------------------------------
    if (isset($_POST['campo_eliminar']) && $_POST['campo_eliminar'] !== '') {
        $campoEliminar = $_POST['campo_eliminar'];

        switch ($usuario_id) {
            case 3: // frutería
                // Borrar la fila donde tipo_etnia = $campoEliminar
                $delete_query = "DELETE FROM fruteria WHERE tipo_etnia = '$campoEliminar'";
                $conexion->query($delete_query);
                $filasBorradas = $conexion->affected_rows; 
                if ($filasBorradas > 0) {
                    echo "<script>alert('Se ha eliminado la etnia \"$campoEliminar\" en frutería.');</script>";
                } else {
                    echo "<script>alert('No se ha eliminado nada. La etnia \"$campoEliminar\" no existe en frutería.');</script>";
                }
                break;

            case 4: // zapatería
                // Borrar la fila donde marcas = $campoEliminar
                $delete_query = "DELETE FROM zapateria WHERE marcas = '$campoEliminar'";
                $conexion->query($delete_query);
                $filasBorradas = $conexion->affected_rows;
                if ($filasBorradas > 0) {
                    echo "<script>alert('Se ha eliminado la marca \"$campoEliminar\" en zapatería.');</script>";
                } else {
                    echo "<script>alert('No se ha eliminado nada. La marca \"$campoEliminar\" no existe en zapatería.');</script>";
                }
                break;

            case 5: // hotel
                // Borrar la fila donde servicios = $campoEliminar
                $delete_query = "DELETE FROM hotel WHERE servicios = '$campoEliminar'";
                $conexion->query($delete_query);
                $filasBorradas = $conexion->affected_rows;
                if ($filasBorradas > 0) {
                    echo "<script>alert('Se ha eliminado el servicio \"$campoEliminar\" en hotel.');</script>";
                } else {
                    echo "<script>alert('No se ha eliminado nada. El servicio \"$campoEliminar\" no existe en hotel.');</script>";
                }
                break;

            default:
                echo "<script>alert('No hay datos disponibles para este usuario.');</script>";
                break;
        }
    }

    // ----------------------------------------------------------------
    // B) Insertar/Actualizar Stock (si NO hay 'campo_eliminar')
    // ----------------------------------------------------------------
    else {
        switch ($usuario_id) {
            case 3: // frutería
                if (isset($_POST['tipo_etnia']) && isset($_POST['concurrencia'])) {
                    $tipo_etnia = $_POST['tipo_etnia'];
                    $concurrencia = $_POST['concurrencia'];

                    // Verificar si existe
                    $check_query = "SELECT * FROM fruteria WHERE tipo_etnia = '$tipo_etnia'";
                    $check_result = $conexion->query($check_query);

                    if ($check_result->num_rows > 0) {
                        // Ya existe => UPDATE
                        $update_query = "UPDATE fruteria SET concurrencia = '$concurrencia' 
                                         WHERE tipo_etnia = '$tipo_etnia'";
                        if ($conexion->query($update_query) === TRUE) {
                            echo "<script>alert('Datos actualizados correctamente en frutería.');</script>";
                        } else {
                            echo "<script>alert('Error al actualizar frutería: " . $conexion->error . "');</script>";
                        }
                    } else {
                        // No existe => INSERT
                        $insert_query = "INSERT INTO fruteria (tipo_etnia, concurrencia, usuario_id)
                                         VALUES ('$tipo_etnia', '$concurrencia', 3)";
                        if ($conexion->query($insert_query) === TRUE) {
                            echo "<script>alert('Datos insertados correctamente en frutería.');</script>";
                        } else {
                            echo "<script>alert('Error al insertar en frutería: " . $conexion->error . "');</script>";
                        }
                    }
                }
                break;

            case 4: // zapatería
                if (isset($_POST['marcas']) && isset($_POST['ventas'])) {
                    $marcas = $_POST['marcas'];
                    $ventas = $_POST['ventas'];

                    // Verificar si existe
                    $check_query = "SELECT * FROM zapateria WHERE marcas = '$marcas'";
                    $check_result = $conexion->query($check_query);

                    if ($check_result->num_rows > 0) {
                        // Update
                        $update_query = "UPDATE zapateria SET ventas = '$ventas' WHERE marcas = '$marcas'";
                        if ($conexion->query($update_query) === TRUE) {
                            echo "<script>alert('Datos actualizados correctamente en zapatería.');</script>";
                        } else {
                            echo "<script>alert('Error al actualizar zapatería: " . $conexion->error . "');</script>";
                        }
                    } else {
                        // Insert
                        $insert_query = "INSERT INTO zapateria (marcas, ventas, usuario_id)
                                         VALUES ('$marcas', '$ventas', 4)";
                        if ($conexion->query($insert_query) === TRUE) {
                            echo "<script>alert('Datos insertados correctamente en zapatería.');</script>";
                        } else {
                            echo "<script>alert('Error al insertar en zapatería: " . $conexion->error . "');</script>";
                        }
                    }
                }
                break;

            case 5: // hotel
                if (isset($_POST['servicios']) && isset($_POST['solicitudes'])) {
                    $servicios = $_POST['servicios'];
                    $solicitudes = $_POST['solicitudes'];

                    // Verificar si existe
                    $check_query = "SELECT * FROM hotel WHERE servicios = '$servicios'";
                    $check_result = $conexion->query($check_query);

                    if ($check_result->num_rows > 0) {
                        // Update
                        $update_query = "UPDATE hotel SET solicitudes = '$solicitudes' WHERE servicios = '$servicios'";
                        if ($conexion->query($update_query) === TRUE) {
                            echo "<script>alert('Datos actualizados correctamente en hotel.');</script>";
                        } else {
                            echo "<script>alert('Error al actualizar hotel: " . $conexion->error . "');</script>";
                        }
                    } else {
                        // Insert
                        $insert_query = "INSERT INTO hotel (servicios, solicitudes, usuario_id)
                                         VALUES ('$servicios', '$solicitudes', 5)";
                        if ($conexion->query($insert_query) === TRUE) {
                            echo "<script>alert('Datos insertados correctamente en hotel.');</script>";
                        } else {
                            echo "<script>alert('Error al insertar en hotel: " . $conexion->error . "');</script>";
                        }
                    }
                }
                break;

                
            default:
                echo "<script>alert('No hay datos disponibles para este usuario.');</script>";
                break;
        }
    }
}

// ========== FUNCIÓN PARA RENDERIZAR EL HEADER ==========
function userHeader($nombre, $id_usuario)
{
    return "
    <header>
        <div class='container'>
            <h1 class='logo'>ARTEMUS</h1>
            <nav>
                <ul class='nav-list'>
                    <!-- Botón que despliega el área de Sectores -->
                    <li>
                        <button id='sectoresBtn' style='border: 1px solid white; border-radius: 5px; padding: 0.5em 1em; color: white;
                            background-color: black; text-decoration: none; transition: background-color 0.3s, color 0.3s; cursor: pointer;'>
                            Sectores
                        </button>
                    </li>
                </ul>
            </nav>
        </div>
    </header>";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Área de Usuario - ARTEMUS</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
  <!-- Tu CSS principal -->
  <link rel="stylesheet" href="../styles/userstyle.css">

  <style>
    /* ===== Desplegable principal (Sectores) ===== */
    #sectoresDiv {
      max-height: 0;
      overflow: hidden;
      background: #000;
      color: #fff;
      transition: max-height 0.5s ease;
    }
    #sectoresDiv.show {
      max-height: 1000px; /* Ajusta según tu contenido */
    }

    /* ===== Tabla e íconos ===== */
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

    .table-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      justify-content: center; /* Centra los íconos en la fila */
    }
    .icon-container {
      flex: 1 1 auto;
      text-align: center;
      text-decoration: none;
      color: inherit;
      margin-bottom: 1em;
    }
    .chart-btn,
    .stock-btn,
    .chat-btn,
    .docs-btn {
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

    /* ===== Sub-desplegables (acordeón) ===== */
    #ventasDiv,
    #stockDiv,
    #perfilDiv,
    #eliminarStockDiv {
      max-height: 0;
      overflow: hidden;
      background-color: #000;
      color: #fff;
      transition: max-height 0.5s ease;
    }
    #ventasDiv.show,
    #stockDiv.show,
    #perfilDiv.show,
    #eliminarStockDiv.show {
      max-height: 1000px; /* Ajustar según el alto del contenido */
    }

    /* ===== Estilos para los formularios ===== */
    .form-container {
      margin: 1em;
      background: #111;
      padding: 1em;
      border-radius: 4px;
    }
    .form-container label {
      display: block;
      margin: 0.5em 0 0.2em;
      font-weight: bold;
      color: #fff;
    }
    .form-container input {
      width: 100%;
      padding: 8px;
      margin-bottom: 1em;
      box-sizing: border-box;
    }
    .form-container button {
      background-color: #4CAF50;
      color: #fff;
      padding: 10px 20px;
      border: none;
      cursor: pointer;
      font-weight: bold;
    }
    .form-container button:hover {
      background-color: #45a049;
    }
    .form-container p {
      margin: 0.5em 0;
      color: #ccc;
    }
  </style>
</head>

<body>
  <!-- HEADER -->
  <?= userHeader($nombre_usuario, $usuario_id); ?>

  <!-- Bloque desplegable de Sectores -->
  <div id="sectoresDiv">
    <?php
    if ($result && $result->num_rows > 0) {
        $rowUser = $result->fetch_assoc();
        ?>
        <table>
          <tbody>
            <!-- FILA CON ÍCONOS (Ventas, Stock, Eliminar Stock, Perfil, Cerrar Sesión) -->
            <tr>
              <td class="table-actions">
                <!-- Sector de Ventas (acordeón) -->
                <div class='icon-container'>
                  <button id='ventasBtn' class='chart-btn'>📊</button>
                  <div class='icon-text'>Sector de Ventas</div>
                </div>

                <!-- Módulo de Stock (acordeón) -->
                <div class='icon-container'>
                  <button id='stockBtn' class='stock-btn'>📦</button>
                  <div class='icon-text'>Módulo de Stock</div>
                </div>

                <!-- Eliminar Stock (acordeón, en vez de Chat en Vivo) -->
                <div class='icon-container'>
                  <button id='eliminarStockBtn' class='chat-btn' style="font-size: 3em;">❌</button>
                  <div class='icon-text'>Eliminar Stock</div>
                </div>

                <!-- Mi Perfil (acordeón) -->
                <div class='icon-container'>
                  <button id='perfilBtn' class='docs-btn'>👤</button>
                  <div class='icon-text'>Mi Perfil</div>
                </div>

                <!-- Cerrar Sesión (link normal) -->
                <a href='../admin/cerrar_sesion.php' class='icon-container'>
                  <button class='docs-btn'>🔒</button>
                  <div class='icon-text'>Cerrar Sesión</div>
                </a>
              </td>
            </tr>

            <!-- Sub-Desplegable: Sector de Ventas -->
            <tr>
              <td colspan="100%">
                <div id="ventasDiv">
                  <iframe
                    src="../user/estadisticasUser.php?id_usuario=<?= htmlspecialchars($rowUser['id_usuario']); ?>"
                    style="width: 100%; height: 600px; border: none;">
                  </iframe>
                </div>
              </td>
            </tr>

            <!-- Sub-Desplegable: Módulo de Stock (INSERT/UPDATE) -->
            <tr>
              <td colspan="100%">
                <div id="stockDiv">
                  <?php
                  // Mostrar un formulario basado en la fila de la tabla
                  if ($query_adicional && isset($result_adicional) && $result_adicional->num_rows > 0) {
                      $row_adicional = $result_adicional->fetch_assoc();

                      echo "<div class='form-container'>";
                      echo "<form method='POST' action=''>";

                      foreach ($row_adicional as $campo => $valor) {
                          echo "<label for='{$campo}'>{$campo}</label>";
                          echo "<input type='text' name='{$campo}' placeholder='Ingresa {$campo}' required>";
                      }

                      echo "<button type='submit'>Guardar</button>";
                      echo "<p>Si ya existe, se actualizará; si no, se insertará.</p>";
                      echo "</form>";
                      echo "</div>";
                  } else {
                      echo "<div class='form-container'>";
                      echo "<p>No hay datos disponibles para este usuario o no aplica a este sector.</p>";
                      echo "</div>";
                  }
                  ?>
                </div>
              </td>
            </tr>

            <!-- Sub-Desplegable: Eliminar Stock (DELETE con control de errores) -->
            <tr>
              <td colspan="100%">
                <div id="eliminarStockDiv">
                  <div class='form-container'>
                    <form method="POST" action="">
                      <label>Nombre del campo a eliminar</label>
                      <!-- Campo único. Ej: "tipo_etnia", "marcas", o "servicios" -->
                      <input type="text" name="campo_eliminar" required>
                      <button type="submit">Eliminar</button>
                      <p>Se borrará el registro en la tabla correspondiente.</p>
                    </form>
                  </div>
                </div>
              </td>
            </tr>

            <!-- Sub-Desplegable: Mi Perfil -->
            <tr>
              <td colspan="100%">
                <div id="perfilDiv">
                  <iframe
                    src="../user/userinfo.php"
                    style="width: 100%; height: 500px; border: none;">
                  </iframe>
                </div>
              </td>
            </tr>

          </tbody>
        </table>
        <?php
    } else {
        echo "<p style='padding:1em;'>No se encontró información para este usuario.</p>";
    }
    ?>
  </div>

  <!-- Resto de la página -->
  <section class="hero">
    <div class="hero-content">
      <h2>Hola, <?= htmlspecialchars($nombre_usuario); ?>!</h2>
    </div>
  </section>

  <section class="user-slogan">
    <h2>Explora y aprovecha al máximo nuestros servicios</h2>
    <p>En ARTEMUS, tu potencial es nuestro compromiso. ¡Gracias por confiar en nosotros!</p>
  </section>

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

  <footer>
    <div class="footer-content">
      <p>© 2025 ARTEMUS. Todos los derechos reservados.</p>
    </div>
  </footer>

  <script>
    // Botón principal para mostrar/ocultar #sectoresDiv
    document.getElementById('sectoresBtn').addEventListener('click', function () {
      var sectoresDiv = document.getElementById('sectoresDiv');
      sectoresDiv.classList.toggle('show');
    });




    // Acordeón sub-desplegables: Ventas, Stock, Eliminar Stock, Perfil
    const ventasBtn        = document.getElementById('ventasBtn');
    const stockBtn         = document.getElementById('stockBtn');
    const eliminarStockBtn = document.getElementById('eliminarStockBtn');
    const perfilBtn        = document.getElementById('perfilBtn');

    const ventasDiv        = document.getElementById('ventasDiv');
    const stockDiv         = document.getElementById('stockDiv');
    const eliminarStockDiv = document.getElementById('eliminarStockDiv');
    const perfilDiv        = document.getElementById('perfilDiv');







    // Al hacer clic en Ventas, cierra los demás
    ventasBtn.addEventListener('click', function () {
      stockDiv.classList.remove('show');
      eliminarStockDiv.classList.remove('show');
      perfilDiv.classList.remove('show');
      ventasDiv.classList.toggle('show');
    });

    // Al hacer clic en Stock, cierra los demás
    stockBtn.addEventListener('click', function () {
      ventasDiv.classList.remove('show');
      eliminarStockDiv.classList.remove('show');
      perfilDiv.classList.remove('show');
      stockDiv.classList.toggle('show');
    });

    // Al hacer clic en Eliminar Stock, cierra los demás
    eliminarStockBtn.addEventListener('click', function () {
      ventasDiv.classList.remove('show');
      stockDiv.classList.remove('show');
      perfilDiv.classList.remove('show');
      eliminarStockDiv.classList.toggle('show');
    });

    // Al hacer clic en Perfil, cierra los demás
    perfilBtn.addEventListener('click', function () {
      ventasDiv.classList.remove('show');
      stockDiv.classList.remove('show');
      eliminarStockDiv.classList.remove('show');
      perfilDiv.classList.toggle('show');
    });
  </script>
</body>
</html>
