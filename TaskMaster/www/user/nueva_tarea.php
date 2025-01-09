<?php
include "../login/conexion.php"; // Incluye el archivo de conexión a la base de datos

session_start(); // Inicia la sesión

if (!isset($_SESSION['id_usuario'])) { // Verifica si el usuario está autenticado
    header("Location: ../index.php"); // Redirige a la página de inicio de sesión si no está autenticado
    exit;
}
date_default_timezone_set("America/Bogota");
setlocale(LC_ALL,"es_ES");
include "../conexion/config.php"; // Incluye el archivo de configuración (aunque no se usa explícitamente en este script)
date_default_timezone_set("America/Bogota");
setlocale(LC_ALL,"es_ES");
$id_usuario = $_SESSION['id_usuario']; // Obtiene el nombre de usuario de la sesión




$nombre = $_POST['nombre'];
$correo_electronico = $_POST["correo_electronico"];
$apellido = $_POST["apellido"];
$contraseña = $_POST["contraseña"];
$ciudad = $_POST['id_ciudad'];


$directorioSubida = "../ficheros/";
$max_file_size = "5120000";
$extensionesValidas = array("jpg", "png", "gif", "pdf");

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



//
// echo $id_evento;
$insert2 = "INSERT INTO usuario (nombre, apellido,correo_electronico,contraseña,ciudad,imagen) VALUES ('$nombre', '$apellido','$correo_electronico','$contraseña','$ciudad','$nombreCompleto')";
$resultadoInsert2 = mysqli_query($con, $insert2);


if ($resultadoInsert2) {
    header("Location: user.php");
} else {
    echo "Error al insertar el evento: " . mysqli_error($con);
}
?>
