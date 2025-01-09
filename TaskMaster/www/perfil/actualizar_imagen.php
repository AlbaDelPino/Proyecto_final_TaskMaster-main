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
$idEvento = $_POST['idEvento'];
// Obtener el ID del usuario




// Validación y manejo de archivos
$directorioSubida = "../ficheros/";
$max_file_size = "5120000";
$extensionesValidas = array("jpg", "png");

if (isset($_FILES['fotografia']) && isset($_FILES['fotografia']['name'])) {
    $errores = 0;
    $nombreArchivo = $_FILES['fotografia']['name'];
    $filesize = $_FILES['fotografia']['size'];
    $directorioTemp = $_FILES['fotografia']['tmp_name'];
    $tipoArchivo = $_FILES['fotografia']['type'];
    $arrayArchivo = pathinfo($nombreArchivo);
    $extension = strtolower($arrayArchivo['extension']);

    if (!in_array($extension, $extensionesValidas)) {
        echo "Extensión no válida";
        $errores = 1;
    }
    if ($filesize > $max_file_size) {
        echo "El archivo debe tener un tamaño inferior";
        $errores = 1;
    }

    if ($errores == 0) {
        $nombreCompleto = $directorioSubida . $nombreArchivo;
        move_uploaded_file($directorioTemp, $nombreCompleto);
    }
}
// echo $nombreArchivo;
// echo $directorioSubida;
// Consulta SQL para actualizar el evento
if ($_FILES['fotografia']['name'] != "") {
    // Si se selecciona una nueva imagen
    $actualizar_evento = "UPDATE usuario SET imagen='$nombreCompleto' WHERE id_usuario='".$idEvento."'";
    //echo $actualizar_evento;
} else {
    // Si no se selecciona una nueva imagen
    $actualizar_evento = "UPDATE usuario SET  imagen='$nombreCompleto' WHERE id_usuario='".$idEvento."'";
}
// Si el estado es "Pendiente", establece la fecha de finalización como NULL

// echo hola;
// Insertar evento en la base de datos
mysqli_query($con, $actualizar_evento);
// echo $actualizar_evento;
header("Location: perfil.php");
?>
