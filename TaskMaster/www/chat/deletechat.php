<?php
require_once('../conexion/config.php');
$id_evento2 = $_REQUEST['id']; 

// Seleccionar solo eventos del usuario actual
$SqlEventos = "SELECT id_evento FROM chat WHERE id_chat = $id_evento2"; 
$resulEventos = mysqli_query($con, $SqlEventos);

if ($resulEventos) {
    $resulEventos2 = mysqli_fetch_assoc($resulEventos); 
    $id_evento = $resulEventos2['id_evento'];
    
    // Eliminar el chat
    $sqlDeleteEvento = "DELETE FROM chat WHERE id_chat = '$id_evento2'";
    $resultProd = mysqli_query($con, $sqlDeleteEvento);
        
    if ($resultProd) {
        // Redirigir a la página de chat con el id_evento
        header("Location: per_chat.php?id=" . $id_evento);
        exit(); // Asegura que el script se detenga después de redirigir
    } else {
        echo "Error al eliminar el chat: " . mysqli_error($con);
    }
} else {
    echo "Error al seleccionar el evento: " . mysqli_error($con);
}
?>
