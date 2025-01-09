<?php
require_once('../conexion/config.php');
$id    		= $_GET['id']; 


$sqlDeleteEvento3 = ("DELETE FROM usuario WHERE  id_usuario='" .$id. "'");
$resultProd3 = mysqli_query($con, $sqlDeleteEvento3);


header("Location: user.php");
?>
  