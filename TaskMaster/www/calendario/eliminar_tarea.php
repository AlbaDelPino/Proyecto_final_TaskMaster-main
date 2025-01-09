<?php
require_once('config.php');
$id    		= $_REQUEST['id']; 
include "../login/conexion.php";
mysqli_select_db($conn, "practicas");
session_start();
$usuario = $_SESSION['id_usuario'];
if (!isset($usuario)) {
    header("Location: index.php");
    exit;
}

$sqlDeleteEvento = ("DELETE FROM eventoscalendar WHERE  id='" .$id. "'");
$resultProd = mysqli_query($con, $sqlDeleteEvento);
$sqlDeleteEvento2 = "DELETE FROM usuario_evento WHERE id_evento = '" . $id . "' AND id_usuario = '" . $id_usuario . "'";
echo $id;
echo $id_usuario;
$resultProd2 = mysqli_query($con, $sqlDeleteEvento2);
$sqlDeleteEvento3 = ("DELETE FROM archivos WHERE  id_evento='" .$id. "'");
$resultProd3 = mysqli_query($con, $sqlDeleteEvento3);
header("Location: mistareas.php");
?>