<?php
include "../login/conexion.php";

session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../index.php");
    exit;
}
date_default_timezone_set("America/Bogota");
setlocale(LC_ALL,"es_ES");

include "../conexion/config.php";

$id_usuario = $_SESSION['id_usuario'];

// Obtener el ID del usuario



$idEvento = $_POST['idEvento'];
$color = $_POST["color"];
$evento = $_POST["evento"];
$descripcion = $_POST["descripcion"];
$f_inicio = $_REQUEST['fecha_inicio'];
$fecha_inicio = date('Y-m-d\TH:i:s', strtotime($f_inicio));

$f_fin = $_REQUEST['fecha_fin']; 
$seteando_f_final = date('Y-m-d\TH:i:s', strtotime($f_fin));  
$fecha_fin1 = strtotime($seteando_f_final."+ 1 days");
$fecha_fin = date('Y-m-d\TH:i:s', $fecha_fin1);

$id_etiqueta = $_POST["id_etiqueta"];
$id_estado = $_POST["id_estado"];


// echo $nombreArchivo;
// echo $directorioSubida;
// Consulta SQL para actualizar el evento

    // Si se selecciona una nueva imagen
    $actualizar_evento = "UPDATE eventoscalendar SET evento = '$evento', descripcion = '$descripcion', color_evento = '$color', fecha_fin = '$fecha_fin', fecha_inicio = '$fecha_inicio', id_etiquetas = '$id_etiqueta', id_estado = '$id_estado' WHERE id='".$idEvento."'";

// Si el estado es "Pendiente", establece la fecha de finalización como NULL
if ($id_estado == 'pendiente') {
    $fecha_fin = NULL;
}
// echo hola;
// Insertar evento en la base de datos
mysqli_query($con, $actualizar_evento);
// echo $actualizar_evento;
header("Location: tareas.php");
?>
