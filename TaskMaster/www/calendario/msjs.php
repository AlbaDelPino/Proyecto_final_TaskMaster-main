
<?php
if(isset($_REQUEST['e'])){ ?>
<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
  <strong>Felicitaciones!</strong> El evento fue registrado correctamente.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php } ?>

<?php
if(isset($_REQUEST['ea'])){ ?>
<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
  <strong>Felicitaciones!</strong> El evento fue actualizado correctamente.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php } ?>
<?php
$SqlEventos3 = "SELECT ec.*, us.nombre AS nombre_usuario
                FROM eventoscalendar ec
                INNER JOIN usuario_evento ue ON ec.id = ue.id_evento
                INNER JOIN usuario us ON ue.id_usuario = us.id_usuario
                WHERE ec.fecha_fin BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 5 DAY)          
                AND us.id_usuario = $id_usuario";
$resulEventos3 = mysqli_query($conn, $SqlEventos3); 

// Verificar si hay eventos y si se proporciona el parámetro 'no' en la solicitud
if ((mysqli_num_rows($resulEventos3) > 0) && isset($_REQUEST['no'])) {
    ?>
    <div class="alert alert-success alert-dismissible fade show text-center bg-info text-white" role="alert">
        <strong>Falta menos de 5 días para que finalicen los siguientes eventos:</strong>
        <ul class="list-unstyled">
            <?php
            while ($registro = mysqli_fetch_assoc($resulEventos3)) {
                echo "<li>{$registro['evento']}</li>";
            }
            ?>
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
} 
    
?>

     

<div class="alert alert-danger alert-dismissible fade show text-center" role="alert" style="display: none;">
  <strong>Felicitaciones!</strong> El evento fue borrado correctamente.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

