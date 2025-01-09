<div class="modal fade" id="pdf__individual<?php echo $registro['id']; ?>" tabindex="-1" aria-labelledby="pdf__individual<?php echo $registro['id']; ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pdf__individual<?php echo $registro['id']; ?>">Descargar evento:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php 
        mysqli_Select_db($con, "practicas");
        $id = $registro['id'];
        $seleccionar = "SELECT * FROM eventoscalendar ev inner join usuario_evento ue on ue.id_evento = ev.id inner join usuario us on ue.id_usuario=us.id_usuario inner join estado es on es.id_estado=ev.id_estado inner join etiquetas et on et.id_etiqueta=ev.id_etiquetas WHERE ev.id ='$id'";
        $registros = mysqli_Query($con, $seleccionar);

        if ($registro = mysqli_fetch_assoc($registros)) {
        ?>
        <input type="hidden"  id="datoNombre" type="text" class="form-control" name="idEvento" id="idEvento" value="<?php echo $registro['id']; ?>">      
        <div class="form-group">
       
          <div class="col-sm-10">
            <a  href="excel.php?id=<?php echo $registro['id']; ?>" target="_blank"><i class="bi bi-filetype-xls" style="font-size: 2rem; color:black;"></i></a>
            <a target="_blank" href="pdf.php?id=<?php echo $registro['id']; ?>" target="_blank"><i class="bi bi-file-earmark-pdf" style="font-size: 2rem; color:black;"></i></a>
          </div>
        </div>
        <?php
        } else {
          echo "No se encontró el producto para actualizar.";
        }
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
