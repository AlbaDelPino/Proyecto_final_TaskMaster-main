<?php
// Conexión a la base de datos
include "../conexion/config.php";

// Verificar la conexión a la base de datos
if (!$con) {
    die(json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos: ' . mysqli_connect_error()]));
}

// Recibimos los datos enviados mediante POST
$data = json_decode(file_get_contents('php://input'), true);

// Verificamos si se recibieron los datos correctamente
if(isset($data['idEvento']) && isset($data['estado'])) {
    // Obtenemos el ID del evento y el estado enviado
    $idEvento = $data['idEvento'];
    $estado = $data['estado'];

    // Consulta SQL para actualizar el estado del evento
    $sql = "UPDATE eventoscalendar SET id_estado = (SELECT id_estado FROM estado WHERE nombre_estado = ?) WHERE id = ?";
    
    // Preparamos la consulta
    $stmt = mysqli_prepare($con, $sql);

    if (!$stmt) {
        die(json_encode(['success' => false, 'message' => 'Error al preparar la consulta: ' . mysqli_error($con)]));
    }

    // Vinculamos los parámetros
    mysqli_stmt_bind_param($stmt, "si", $estado, $idEvento);

    // Ejecutamos la consulta
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true, 'message' => 'Actualización exitosa']);
        
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al ejecutar la consulta: ' . mysqli_error($con)]);
    }

    // Cerramos la consulta
    mysqli_stmt_close($stmt);
} else {
    // Si no se recibieron los datos correctamente, devolvemos un mensaje de error
    echo json_encode(['error' => 'Error al recibir los datos']);
}

// Cerramos la conexión
mysqli_close($con);

?>
