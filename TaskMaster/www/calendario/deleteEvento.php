<?php
require_once('config.php');
$id    		= $_REQUEST['id']; 

$sqlDeleteEvento = ("DELETE FROM eventoscalendar WHERE  id='" .$id. "'");
$resultProd = mysqli_query($con, $sqlDeleteEvento);
$sqlDeleteEvento2 = ("DELETE FROM usuario_evento WHERE id_evento = '" . $id . "'");

$resultProd2 = mysqli_query($con, $sqlDeleteEvento2);

?>
  