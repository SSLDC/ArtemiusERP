<?php
session_start();

// Verificar si el usuario es administrador
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../forms/loog.php");
    exit();
}

// Incluir la conexión a la base de datos
include '../conexion.php';

// Verificar si se ha especificado el formato
if (!isset($_GET['format'])) {
    die("Formato no especificado.");
}

$format = $_GET['format'];
$id_usuario = isset($_GET['id_usuario']) ? (int)$_GET['id_usuario'] : null;

switch ($format) {
    case 'csv':
        exportCSV($conexion, $id_usuario);
        break;
    case 'excel':
        exportAsExcel($conexion, $id_usuario);
        break;
    default:
        die("Formato no válido.");
}

// Función para exportar datos en formato CSV
function exportCSV($conexion, $id_usuario = null) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=ventas.csv');

    $output = fopen('php://output', 'w');
    fputcsv($output, array('ID Venta', 'Producto', 'Cantidad', 'Precio', 'Fecha'));

    $sql = "SELECT id_venta, producto, cantidad, precio, fecha FROM ventas";
    if ($id_usuario) {
        $sql .= " WHERE id_usuario = $id_usuario";
    }
    $sql .= " ORDER BY fecha DESC";

    $result = mysqli_query($conexion, $sql);
    if (!$result) {
        die("Error en la consulta: " . mysqli_error($conexion));
    }

    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }
    fclose($output);
    exit();
}

// Función para exportar datos “como Excel” usando CSV formateado
function exportAsExcel($conexion, $id_usuario = null) {
    // Cabeceras para forzar la descarga y tratar el contenido como un archivo Excel
    header('Content-Type: application/vnd.ms-excel; charset=utf-8');
    header('Content-Disposition: attachment; filename="ventas.xls"');

    // Abrir la salida estándar
    $output = fopen('php://output', 'w');

    // Separador de columnas: \t (tab) para simular celdas de Excel
    $separator = "\t";

    // Escribir la fila de encabezados
    $headers = array('ID Venta', 'Producto', 'Cantidad', 'Precio', 'Fecha');
    echo implode($separator, $headers) . "\r\n";

    $sql = "SELECT id_venta, producto, cantidad, precio, fecha FROM ventas";
    if ($id_usuario) {
        $sql .= " WHERE id_usuario = $id_usuario";
    }
    $sql .= " ORDER BY fecha DESC";

    $result = mysqli_query($conexion, $sql);
    if (!$result) {
        die("Error en la consulta: " . mysqli_error($conexion));
    }

    // Escribir cada fila en el archivo Excel simulado
    while ($row = mysqli_fetch_assoc($result)) {
        $line = [];
        foreach ($row as $value) {
            // Limpiar y preparar cada valor
            $value = str_replace('"', '""', $value);
            $line[] = $value;
        }
        echo implode($separator, $line) . "\r\n";
    }
    fclose($output);
    exit();
}
?>
