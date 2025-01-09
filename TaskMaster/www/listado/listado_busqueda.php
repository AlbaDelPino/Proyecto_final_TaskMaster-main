<?php
include "../header.php";



$id_usuario = $_SESSION['id_usuario'];
include('../login/config.php');

$evento = $_POST['evento'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$fecha_inicio = $_POST['fecha_inicio'] ?? '';
$fecha_fin = $_POST['fecha_fin'] ?? '';
$id_etiqueta = $_POST['id_etiqueta'] ?? '';
$id_estado = $_POST['id_estado'] ?? '';
$color = $_POST['color'] ?? '';

?>

<section class="principal-listado">

<?php
include('modalNuevoEvento.php');
?>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
listar
</button>

<div class="form-group">
 <?php
 $sql2 = "SELECT * FROM usuario where id_usuario='$id_usuario' ";
 $res2 = mysqli_query($conn, $sql2);
 $fila = mysqli_fetch_assoc($res2);
 $usuario = $fila['nombre'];
 if ($usuario == "admin"){
    $sql = "SELECT ev.*, es.nombre_estado, et.nombre_etiqueta 
        FROM eventoscalendar ev 
      
        INNER JOIN estado es ON es.id_estado = ev.id_estado
        INNER JOIN etiquetas et ON et.id_etiqueta = ev.id_etiquetas
       where";
       if (!empty($evento)) {
        $evento = mysqli_real_escape_string($con, $evento);
        $sql .= "  ev.evento LIKE '%$evento%'";
    }
 }
 else{
    $sql = "SELECT ev.*, es.nombre_estado, et.nombre_etiqueta
    FROM eventoscalendar ev 
    INNER JOIN usuario_evento ue ON ue.id_evento = ev.id
    INNER JOIN usuario us ON ue.id_usuario = us.id_usuario
    INNER JOIN estado es ON es.id_estado = ev.id_estado
    INNER JOIN etiquetas et ON et.id_etiqueta = ev.id_etiquetas
    WHERE us.id_usuario = $id_usuario";
    if (!empty($evento)) {
        $evento = mysqli_real_escape_string($con, $evento);
        $sql .= " AND ev.evento LIKE '%$evento%'";
    }
    if (!empty($evento)) {
        $evento = mysqli_real_escape_string($con, $evento);
        $sql .= " AND ev.evento LIKE '%$evento%'";
    }
 }
 
// Construir la consulta SQL


// Verificar si se proporcionó algún criterio de búsqueda


if (!empty($descripcion)) {
    $descripcion = mysqli_real_escape_string($con, $descripcion);
    $sql .= " AND ev.descripcion LIKE '%$descripcion%'";
}

if (!empty($fecha_inicio)) {
    $fecha_inicio = mysqli_real_escape_string($con, $fecha_inicio);
    $sql .= " AND ev.fecha_inicio >= '$fecha_inicio'";
}

if (!empty($fecha_fin)) {
    $fecha_fin = mysqli_real_escape_string($con, $fecha_fin);
    $sql .= " AND ev.fecha_fin <= '$fecha_fin'";
}

if (!empty($id_estado)) {
    $id_estado = mysqli_real_escape_string($con, $id_estado);
    $sql .= " AND ev.id_estado = '$id_estado'";
}

if (!empty($id_etiqueta)) {
    $id_etiqueta = mysqli_real_escape_string($con, $id_etiqueta);
    $sql .= " AND ev.id_etiquetas = '$id_etiqueta'";
}

// Ejecutar la consulta SQL
$result = mysqli_query($con, $sql);

// Verificar si la consulta fue exitosa
if (!$result) {
    die("Error en la consulta: " . mysqli_error($con));
}

?>

<div class="form-group">
    <div class="col-sm-10">
        <a  href="excel.php?id=<?php echo $id_usuario; ?>&evento=<?php echo $evento; ?>&descripcion=<?php echo $descripcion; ?>&fecha_inicio=<?php echo $fecha_inicio; ?>&fecha_fin=<?php echo $fecha_fin; ?>&id_estado=<?php echo $id_estado; ?>&id_etiqueta=<?php echo $id_etiqueta; ?>">
            <i class="bi bi-filetype-xls" style="font-size: 2rem; color:black;"></i>
        </a>
        <a target="_blank" href="pdf.php?&evento=<?php echo $evento; ?>&descripcion=<?php echo $descripcion; ?>&fecha_inicio=<?php echo $fecha_inicio; ?>&fecha_fin=<?php echo $fecha_fin; ?>&id_estado=<?php echo $id_estado; ?>&id_etiqueta=<?php echo $id_etiqueta; ?>">
            <i class="bi bi-file-earmark-pdf" style="font-size: 2rem; color:black;"></i>
        </a>
    </div>

    <table class="tabla">
        <thead>
            <tr>
                <th scope="col">Tarea</th>
                <th scope="col">Descripción</th>
                <th scope="col">Fecha Inicio</th>
                <th scope="col">Fecha Final</th>
                <th scope="col">Estado</th>
                <th scope="col">Etiqueta</th>
                <th scope="col">Archivos</th>
                <th scope="col">Descargar</th>
                <th scope="col">Compartido por</th>
                
            </tr>
        </thead>
        <tbody>
            <?php while ($registro = mysqli_fetch_assoc($result)) { ?>
                <tr class="align-middle">
                    <td scope="row" data-label="evento"><?php echo $registro['evento']; ?></td>
                    <td data-label="Descripción"><?php echo $registro['descripcion']; ?></td>
                    <td data-label="Fecha de inicio"><?php echo $registro['fecha_inicio']; ?></td>
                    <td data-label="Fecha final"><?php echo $registro['fecha_fin']; ?></td>
                    <td data-label="Estado"><?php echo $registro['nombre_estado']; ?></td>
                    <td data-label="Etiquetas"><?php echo $registro['nombre_etiqueta']; ?></td>
                    <td data-label="Archivos">
                        <a type="button" data-bs-toggle="modal" data-bs-target="#archivo_<?php echo $registro['id']; ?>" data-id="<?php echo $registro['id']; ?>">
                            <i class="bi bi-file-earmark" style="font-size: 2rem; color:black;"></i>
                        </a>
                    </td>
                    <td data-label="Compartido por:">
                    <?php
                        
                        $compartir = $registro['id'];
                        $SqlEventos6   = "SELECT * FROM eventoscalendar ev inner join usuario_evento ue on ue.id_evento = ev.id
                        inner join usuario us on ue.id_usuario=us.id_usuario WHERE ev.id = $compartir ";
                        $id_usuario = $_SESSION['id_usuario'];
                     
                        $resulEventos6 = mysqli_query($conn, $SqlEventos6);
                        if($usuario == "admin"){
                            while( $registro6 = mysqli_fetch_assoc($resulEventos6)) {?>

                            <p><?php echo $registro6['nombre'];?></p><?php
                            }}else{
                                    $SqlEventos7   = "SELECT * FROM eventoscalendar ev inner join usuario_evento ue on ue.id_evento = ev.id
                                    inner join usuario us on ue.id_usuario=us.id_usuario WHERE ev.id = $compartir and us.id_usuario = $id_usuario";
                            
                                    $resulEventos7 = mysqli_query($conn, $SqlEventos7);
                                    $registro7 = mysqli_fetch_assoc($resulEventos7);
                                    $usuario = $registro7['nombre'];
                                    
                            while($registro5 = mysqli_fetch_assoc($resulEventos6)) {
                                $nombre_compartir =$registro5['nombre'];
                            
                                if($nombre_compartir == $usuario) {
                                    ?>   
                            <P>Yo</P>
                            
                                <?php
                                } else{
                                    
                            ?>
               <div>
                
               <p><?php echo $registro5['nombre'];?></p>
                </div>
                
                <?php
                }
                }}
                ?>
                   
                    </td>
                    <td data-label="descarga">
                        <a type="button" data-bs-toggle="modal" data-bs-target="#pdf__individual<?php echo $registro['id']; ?>" data-id="pdf__individual<?php echo $registro['id']; ?>">
                        <i class="bi bi-download" style="font-size: 2rem; color:blue;"></i>
                        </a>
                    </td>
                </tr>
                <?php
                include('modalcompartir.php');
                include('modalpdf.php');
                include('modalpdf _individual.php');
                include('modalarchivo.php');
                ?>
            <?php } ?>
        </tbody>
    </table>
</div>

</section> 

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
