<?php
// Archivo: actualizar_chat.php
// Este archivo se encarga de obtener los mensajes más recientes de la base de datos
// y enviarlos de vuelta al cliente para actualizar el chat en la página per_chat.php

// Incluir el archivo de configuración de la base de datos
include('../conexion/config.php');

// Obtener el ID del evento de la solicitud
$idEvento = $_GET['idEvento'];

// Consulta SQL para obtener los mensajes más recientes del evento
$sql6 = "SELECT * FROM chat WHERE id_evento = $idEvento ORDER BY fecha_envio DESC LIMIT 10"; // Por ejemplo, obtenemos los 10 mensajes más recientes
$resultado6 = mysqli_query($con, $sql6);

// Crear un array para almacenar los mensajes
$mensajes = array();

// Recorrer los resultados y añadirlos al array
while ($row = mysqli_fetch_assoc($resultado6)) {
    $mensajes[] = $row;
}

// Convertir el array a JSON y enviarlo de vuelta al cliente
echo json_encode($mensajes);
?>
