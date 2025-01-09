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



// Recibe los datos del formulario
$evento = $_POST["evento"];
$descripcion = $_POST["descripcion"];
$color = $_POST["color"];
$id_etiqueta = $_POST["id_etiqueta"];
$id_estado = $_POST["id_estado"];

// Validación y manejo de archivos
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

// Si el estado es "Pendiente", establece la fecha de finalización como NULL
if ($id_estado == 'pendiente') {
    $fecha_fin = NULL;
} else {
    // Recibe las fechas del formulario y las formatea adecuadamente
    $f_inicio = $_REQUEST['fecha_inicio'];
    $fecha_inicio = date('Y-m-d\TH:i', strtotime($f_inicio));

    $f_fin = $_REQUEST['fecha_fin']; 
    $seteando_f_final = date('Y-m-d\TH:i', strtotime($f_fin));  
    $fecha_fin1 = strtotime($seteando_f_final."+ 1 days");
    $fecha_fin = date('Y-m-d\TH:i', $fecha_fin1); 
}

// Insertar evento en la base de datos
$insertardos = "INSERT INTO eventoscalendar ( color_evento, descripcion, evento, fecha_fin, fecha_inicio, id_etiquetas, id_estado) VALUES ( '$color', '$descripcion', '$evento', '$fecha_fin', '$fecha_inicio', '$id_etiqueta', '$id_estado')";
$resultadoNuevoEvento = mysqli_query($con, $insertardos); // Ejecuta la consulta SQL para insertar el evento en la base de datos

$id_evento = mysqli_insert_id($con);
// echo $id_evento;
$insert2 = "INSERT INTO usuario_evento (id_evento, id_usuario) VALUES ('$id_evento', '$id_usuario')";
$resultadoInsert2 = mysqli_query($con, $insert2);
$insertardos3 = "INSERT INTO archivos (nombre_archivo, id_evento) VALUES ('$nombreCompleto', '$id_evento')";
// echo $insertardos3;
$resultadoNuevoEvento3 = mysqli_query($con, $insertardos3);
if ($resultadoNuevoEvento) {
    header("Location: tareas.php");
} else {
    echo "Error al insertar el evento: " . mysqli_error($con);
}
?>
