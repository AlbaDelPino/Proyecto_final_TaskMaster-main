<?php
include "../login/conexion.php"; // Incluye el archivo de conexión a la base de datos

session_start(); // Inicia la sesión

if (!isset($_SESSION['id_usuario'])) { // Verifica si el usuario está autenticado
    header("Location: ../index.php"); // Redirige a la página de inicio de sesión si no está autenticado
    exit;
}
date_default_timezone_set("America/Bogota");
setlocale(LC_ALL,"es_ES");
include "config.php"; // Incluye el archivo de configuración (aunque no se usa explícitamente en este script)
date_default_timezone_set("America/Bogota");
setlocale(LC_ALL,"es_ES");
$id_usuario = $_SESSION['id_usuario']; // Obtiene el nombre de usuario de la sesión

// Obtener el ID del usuario de la base de datos


// Recibe los datos del formulario
$evento = $_POST["evento"];
$descripcion = $_POST["descripcion"];
$color = $_POST["color"];
$id_etiqueta = $_POST["id_etiqueta"];
$id_estado = $_POST["id_estado"];



// Si el estado es "Pendiente", establece la fecha de finalización como NULL
if ($id_estado == 'pendiente') {
    $fecha_fin = NULL;
} else {
    // Recibe las fechas del formulario y las formatea adecuadamente
    $f_inicio = $_REQUEST['fecha_inicio'];
    $fecha_inicio = date('Y-m-d\TH:i:s', strtotime($f_inicio));

    $f_fin = $_REQUEST['fecha_fin']; 
    $fecha_fin = date('Y-m-d\TH:i:s', strtotime($f_fin));
    
}

// Insertar evento en la base de datos
$insertardos = "INSERT INTO eventoscalendar ( color_evento, descripcion, evento, fecha_fin, fecha_inicio, id_etiquetas, id_estado) VALUES ( '$color', '$descripcion', '$evento', '$fecha_fin', '$fecha_inicio', '$id_etiqueta', '$id_estado')";
$resultadoNuevoEvento = mysqli_query($con, $insertardos); // Ejecuta la consulta SQL para insertar el evento en la base de datos

$id_evento = mysqli_insert_id($con);
// echo $id_evento;
$insert2 = "INSERT INTO usuario_evento (id_evento, id_usuario) VALUES ('$id_evento', '$id_usuario')";
$resultadoInsert2 = mysqli_query($con, $insert2);

if ($resultadoNuevoEvento) {
    header("Location: calendario.php?e=1");
} else {
    echo "Error al insertar el evento: " . mysqli_error($con);
}
?>
