<?php
require_once('../conexion/config.php');
$id    		= $_REQUEST['id']; 

$sqlDeleteEvento = ("DELETE FROM archivos WHERE  id_archivo='" .$id. "'");
$resultProd = mysqli_query($con, $sqlDeleteEvento);

header("Location: tareas.php");
?>
  