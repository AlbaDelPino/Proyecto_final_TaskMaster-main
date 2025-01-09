<?php
require_once('../conexion/config.php');
$id    		= $_REQUEST['id']; 
$usuario		= $_REQUEST['usuario']; 
$sqlDeleteEvento2 = ("DELETE FROM usuario_evento WHERE id_evento = '" . $id . "' and  id_usuario = '" . $usuario . "'");


$resultProd2 = mysqli_query($con, $sqlDeleteEvento2);
header("Location: tareas.php");
?>
  