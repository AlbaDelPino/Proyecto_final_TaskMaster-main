<?php
include "../login/conexion.php";

session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../index.php");
    exit;
}
date_default_timezone_set("America/Bogota");
setlocale(LC_ALL,"es_ES");

include "config.php";

$id_usuario = $_SESSION['id_usuario'];

// Obtener el ID del usuario


$idEvento = $_POST['idEvento'];
$color = $_POST["color"];
$evento = $_POST["evento"];
$descripcion = $_POST["descripcion"];
$f_inicio = $_REQUEST['fecha_inicio'];
$fecha_inicio = date('Y-m-d\TH:i:s', strtotime($f_inicio));

$f_fin = $_REQUEST['fecha_fin']; 
$fecha_fin = date('Y-m-d\TH:i:s', strtotime($f_fin));  


$id_etiqueta = $_POST["id_etiqueta"];
$id_estado = $_POST["id_estado"];

$actualizar_evento = "UPDATE eventoscalendar SET evento = '$evento', descripcion = '$descripcion', color_evento = '$color', fecha_fin = '$fecha_fin', fecha_inicio = '$fecha_inicio', id_etiquetas = '$id_etiqueta', id_estado = '$id_estado' WHERE id='".$idEvento."'";

// echo hola;
// Insertar evento en la base de datos
mysqli_query($con, $actualizar_evento);
// echo $actualizar_evento;
header("Location: calendario.php?ea=1");
?>
