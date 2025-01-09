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

$id_usuario = $_SESSION['id_usuario']; // Obtiene el nombre de usuario de la sesión



// Recibe los datos del formulario

// Validación y manejo de archivos
$id = $_REQUEST['id']; 
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

        // Insertar la ruta del archivo en la base de datos
        $insertardos3 = "INSERT INTO archivos (nombre_archivo, id_evento) VALUES ('$nombreCompleto', '$id')";
        $resultadoNuevoArchivo = mysqli_query($con, $insertardos3);
        
        if ($resultadoNuevoArchivo) {
            header("Location: tareas.php");
            exit;
        } else {
            echo "Error al insertar el archivo: " . mysqli_error($con);
        }
    }
} else {
    echo "No se ha enviado ningún archivo.";
}
?>
