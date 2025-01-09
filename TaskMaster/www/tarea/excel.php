<?php  

header('Content-Type: application/xls*');
header('Content-Disposition: attachment; filename=TaskMaster.xls');
include('../login/config.php');
mysqli_select_db($con, "practicas");
session_start();

// Verificar si el usuario ha iniciado sesión correctamente
if (!isset($_SESSION['id_usuario']) || empty($_SESSION['id_usuario'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header("Location: ../login/index.php");
    exit; // Detener la ejecución del script después de la redirección
}

$id_usuario = $_SESSION['id_usuario'];
$id = $_GET['id'];


?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Tarea</th>
            <th scope="col">Descripción</th>
            <th scope="col">Fecha Inicio</th>
            <th scope="col">Fecha Final</th>
            <th scope="col">Estado</th>
            <th scope="col">Etiqueta</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include('../login/config.php');
        $SqlEventos3 = "SELECT * FROM eventoscalendar ev 
                INNER JOIN usuario_evento ue ON ue.id_evento = ev.id
                INNER JOIN usuario us ON ue.id_usuario = us.id_usuario 
                INNER JOIN estado es ON es.id_estado = ev.id_estado 
                INNER JOIN etiquetas et ON et.id_etiqueta = ev.id_etiquetas 
                WHERE us.id_usuario = $id_usuario and ev.id = $id"; // Seleccionar solo eventos del usuario actual
        $resulEventos3 = mysqli_query($con, $SqlEventos3);
        ?>

        <?php
        while ($registro = mysqli_fetch_assoc($resulEventos3)) {
        ?>
            <tr class="align-middle">
                <td scope="row" data-label="evento"><?php echo $registro['evento']; ?></td>
                <td data-label="Descripción"><?php echo $registro['descripcion']; ?></td>
                <td data-label="Fecha de inicio"><?php echo $registro['fecha_inicio']; ?></td>
                <td data-label="Fecha final"><?php echo $registro['fecha_fin']; ?></td>
                <td data-label="Estado"><?php echo $registro['nombre_estado']; ?></td>
                <td data-label="Etiquetas"><?php echo $registro['nombre_etiqueta']; ?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
