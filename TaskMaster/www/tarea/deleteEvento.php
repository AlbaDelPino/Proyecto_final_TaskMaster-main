<?php
require_once('../conexion/config.php');
$id    		= $_REQUEST['id']; 

$sqlDeleteEvento = ("DELETE FROM eventoscalendar WHERE  id='" .$id. "'");
$resultProd = mysqli_query($con, $sqlDeleteEvento);
$sqlDeleteEvento2 = ("DELETE FROM usuario_evento WHERE id_evento = '" . $id . "'");
$sqlDeleteEvento3 = ("DELETE FROM archivos WHERE  id_evento='" .$id. "'");
$resultProd3 = mysqli_query($con, $sqlDeleteEvento3);

$resultProd2 = mysqli_query($con, $sqlDeleteEvento2);
header("Location: tareas.php");
?>
  