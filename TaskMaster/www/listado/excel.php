<?php  
header('Content-Type: application/vnd.ms-excel');
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
$id = $_REQUEST['id'];
$evento = $_GET['evento'] ?? '';
$descripcion = $_GET['descripcion'] ?? '';
$fecha_inicio = $_GET['fecha_inicio'] ?? '';
$fecha_fin = $_GET['fecha_fin'] ?? '';
$id_etiqueta = $_GET['id_etiqueta'] ?? '';
$id_estado = $_GET['id_estado'] ?? '';
$color = $_GET['color'] ?? '';
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
        mysqli_select_db($con, "practicas");
        $sql = "SELECT ev.evento, ev.descripcion, ev.fecha_inicio, ev.fecha_fin, es.nombre_estado, et.nombre_etiqueta
        FROM eventoscalendar ev 
        INNER JOIN usuario_evento ue ON ue.id_evento = ev.id
        INNER JOIN usuario us ON ue.id_usuario = us.id_usuario
        INNER JOIN estado es ON es.id_estado = ev.id_estado
        INNER JOIN etiquetas et ON et.id_etiqueta = ev.id_etiquetas
        WHERE us.id_usuario = $id_usuario";
        
        // Verificar si se proporcionó algún criterio de búsqueda
        if (!empty($_GET['evento'])) {
            $evento = mysqli_real_escape_string($con, $_GET['evento']);
            $sql .= " AND ev.evento LIKE '%$evento%'";
        }
        
        if (!empty($_GET['descripcion'])) {
            $descripcion = mysqli_real_escape_string($con, $_GET['descripcion']);
            $sql .= " AND ev.descripcion LIKE '%$descripcion%'";
        }
        
        if (!empty($_GET['fecha_inicio'])) {
            $fecha_inicio = mysqli_real_escape_string($con, $_GET['fecha_inicio']);
            $sql .= " AND ev.fecha_inicio >= '$fecha_inicio'";
        }
        
        if (!empty($_GET['fecha_fin'])) {
            $fecha_fin = mysqli_real_escape_string($con, $_GET['fecha_fin']);
            $sql .= " AND ev.fecha_fin <= '$fecha_fin'";
        }
        
        if (!empty($_GET['id_estado'])) {
            $id_estado = mysqli_real_escape_string($con, $_GET['id_estado']);
            $sql .= " AND ev.id_estado = '$id_estado'";
        }
        
        if (!empty($_GET['id_etiqueta'])) {
            $id_etiqueta = mysqli_real_escape_string($con, $_GET['id_etiqueta']);
            $sql .= " AND ev.id_etiquetas = '$id_etiqueta'";
        }
        
   
         

        $result = mysqli_query($con, $sql);

        if (!$result) {
            die("Error en la consulta: " . mysqli_error($con));
        }
            ECHO $sql;
        while ($registro = mysqli_fetch_assoc($result)) {
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
