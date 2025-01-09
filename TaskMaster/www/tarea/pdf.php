<?php
require_once('../conexion/config.php');
require('../fpdf/fpdf.php');

$id = $_REQUEST['id'];
mysqli_select_db($con, "practicas");
session_start();
$id_usuario = $_SESSION['id_usuario'];
if (!isset($id_usuario)) {
    header("Location: index.php");
    exit;
}

$consultar = "SELECT ev.evento, ev.descripcion, ev.fecha_fin, ev.fecha_inicio, es.nombre_estado FROM eventoscalendar ev 
        INNER JOIN usuario_evento ue ON ue.id_evento = ev.id
        INNER JOIN usuario us ON ue.id_usuario=us.id_usuario 
        INNER JOIN estado es ON es.id_estado = ev.id_estado
        WHERE ue.id_usuario = $id_usuario AND ev.id = $id";

$resultset = mysqli_query($con, $consultar);

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

// Generar el PDF y enviarlo por WhatsApp
$pdf_path = '../pdf/'.$id.'.pdf';
$pdf->Output('F', $pdf_path); // Guardar el PDF
$pdf->Output('I'); // Mostrar el PDF en el navegador
?>
