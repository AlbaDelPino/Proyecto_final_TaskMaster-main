<?php
include "../login/conexion.php"; // Incluye el archivo de conexión a la base de datos
session_start(); // Inicia la sesión

if (!isset($_SESSION['id_usuario'])) { // Verifica si el usuario está autenticado
    header("Location: ../index.php"); // Redirige a la página de inicio de sesión si no está autenticado
    exit;
}

// Obtener datos del formulario
$evento = $_POST["idEvento"];
$usuario = $_POST["idusuario"];
$mensaje = $_POST["mensaje"];

if (!empty(trim($mensaje))) { // Verificar si el mensaje no está vacío
    $insertardos = "INSERT INTO chat (id_evento, id_usuario, mensaje) VALUES ('$evento', '$usuario', '$mensaje')"; // Consulta SQL para insertar el mensaje
    $resultadoNuevoEvento = mysqli_query($conn, $insertardos); // Ejecutar la consulta
    if ($resultadoNuevoEvento) { // Verificar si la consulta se ejecutó correctamente
        header("Location: per_chat.php?id=$evento"); // Redirigir a la página de chat
        exit;
    } else {
        echo "Error al insertar el evento: " . mysqli_error($conn); // Mostrar mensaje de error si la inserción falla
    }
} else {
    header("Location: per_chat.php?id=$evento"); // Redirigir si el mensaje está vacío
}
?>
