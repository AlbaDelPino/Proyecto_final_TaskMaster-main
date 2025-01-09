<?php
require_once('../conexion/config.php');
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit;
}
$evento = $_POST['evento'] ?? '';

$id_usuario = $_SESSION['id_usuario'];
$sql2 = "SELECT * FROM usuario where id_usuario='$id_usuario' ";
$res2 = mysqli_query($con, $sql2);
$fila = mysqli_fetch_assoc($res2);
$usuario = $fila['nombre'];
mysqli_select_db($con, "practicas");
if ($usuario == "admin"){
    $sql = "SELECT ev.evento, ev.descripcion,ev.fecha_inicio, ev.fecha_fin, es.nombre_estado, et.nombre_etiqueta
    FROM eventoscalendar ev 

   
    INNER JOIN estado es ON es.id_estado = ev.id_estado
    INNER JOIN etiquetas et ON et.id_etiqueta = ev.id_etiquetas
    WHERE ";
    if (!empty($_GET['evento'])) {
        $evento = mysqli_real_escape_string($con, $_GET['evento']);
        $sql .= " ev.evento LIKE '%$evento%' ";
    }
    // Verificar si se proporcionó algún criterio de búsqueda
if (!empty($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $sql .= " ev.id = $id";
}
}
else{
   
    $sql = "SELECT ev.evento, ev.descripcion,ev.fecha_inicio, ev.fecha_fin, es.nombre_estado, et.nombre_etiqueta
    FROM eventoscalendar ev 
    INNER JOIN usuario_evento ue ON ue.id_evento = ev.id
    INNER JOIN usuario us ON ue.id_usuario=us.id_usuario 
    INNER JOIN estado es ON es.id_estado = ev.id_estado
    INNER JOIN etiquetas et ON et.id_etiqueta = ev.id_etiquetas
    WHERE us.id_usuario = $id_usuario ";
    if (!empty($_GET['evento'])) {
        $evento = mysqli_real_escape_string($con, $_GET['evento']);
        $sql .= " AND ev.evento LIKE '%$evento%' ";
    }
    if (!empty($_GET['id'])) {
        $id= $_GET['id'];
        $id = mysqli_real_escape_string($con, $_GET['id']);
        $sql .= "AND ev.id = $id";
    }
}



if (!empty($_GET['descripcion'])) {
    $descripcion = mysqli_real_escape_string($con, $_GET['descripcion']);
    $sql .= " AND ev.descripcion LIKE '%$descripcion%'";
}

if (!empty($_GET['fecha_inicio'])) {
    $fecha_inicio = mysqli_real_escape_string($con, $_GET['fecha_inicio']);
    $sql .= " AND ev.fecha_inicio >= '$fecha_inicio'";
}

if (!empty($_GET['fecha_fin'])) {
    $fecha_fin = mysqli_real_escape_string($con, $_GET['fecha_fin']);
    $sql .= " AND ev.fecha_fin <= '$fecha_fin'";
}

if (!empty($_GET['id_estado'])) {
    $id_estado = mysqli_real_escape_string($con, $_GET['id_estado']);
    $sql .= " AND ev.id_estado = '$id_estado'";
}

if (!empty($_GET['id_etiqueta'])) {
    $id_etiqueta = mysqli_real_escape_string($con, $_GET['id_etiqueta']);
    $sql .= " AND ev.id_etiquetas = '$id_etiqueta'";
}

$resultset = mysqli_query($con, $sql);

if (!$resultset) {
    die("Error en la consulta: " . mysqli_error($con));
}
require('../fpdf/FPDF.php');

// Crear instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 7);

// Obtener información sobre los campos
$field_names = array();

// Imprimir encabezados de manera vertical
$pdf->SetFont('Arial', 'B', 7);
foreach ($field_names as $field_name) {
    $pdf->Cell(30, 10, utf8_decode($field_name), 1);
    $pdf->Ln();
}

// Imprimir datos
$pdf->SetFont('Arial', '', 7);
while ($row = mysqli_fetch_assoc($resultset)) {
    foreach ($row as $column_name => $column) {
        // Imprimir el nombre del campo y su valor
        $pdf->Cell(30, 10, utf8_decode($column_name), 1);
        $pdf->Cell(150, 10, utf8_decode($column), 1);
        $pdf->Ln();
    }
    $pdf->Ln();
}


$pdf->Output('I'); // Mostrar el PDF en el navegador
?>
