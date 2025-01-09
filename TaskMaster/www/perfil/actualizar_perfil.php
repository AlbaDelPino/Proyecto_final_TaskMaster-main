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
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$ciudad = $_POST["ciudad"];
$contraseña = $_POST["contraseña"];

$correo = $_POST["correo"];


$id_usuario = $_SESSION['id_usuario'];


$sql3 = "SELECT * FROM usuario where id_usuario='$id_usuario' ";
              
                $res3 = mysqli_query($conn, $sql3);
                $fila3 = mysqli_fetch_assoc($res3);
                $usuario = $fila3['nombre'];
// echo $nombreArchivo;
// echo $directorioSubida;
// Consulta SQL para actualizar el evento
if($usuario == "admin"){
    $actualizar_evento = "UPDATE usuario SET nombre = '$nombre', apellido = '$apellido',contraseña = '$contraseña', correo_electronico = '$correo' WHERE id_usuario='".$idEvento."'";

}else{
    $actualizar_evento = "UPDATE usuario SET nombre = '$nombre', apellido = '$apellido', ciudad = '$ciudad',contraseña = '$contraseña', correo_electronico = '$correo' WHERE id_usuario='".$idEvento."'";

}
    // Si se selecciona una nueva imagen

// Si el estado es "Pendiente", establece la fecha de finalización como NULL

//echo $actualizar_evento;
// Insertar evento en la base de datos
mysqli_query($con, $actualizar_evento);
// echo $actualizar_evento;
header("Location: perfil.php");
?>
