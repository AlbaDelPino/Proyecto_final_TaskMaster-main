<div class="modal fade" id="pdf" tabindex="-1" aria-labelledby="pdf" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pdf">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php 
        echo $registro['id'];
        ?>
        <input type="hidden" id="datoNombre" class="form-control" name="idEvento" value="<?php echo $registro['id']; ?>">      
        <div class="form-group">
         
            
          <div class="col-sm-10">
            <a href="excel.php?id=<?php echo $registro['id']; ?>" target="_blank"><i class="bi bi-filetype-xls" style="font-size: 2rem; color:black;"></i></a>
            <a href="pdf.php?id=<?php echo $registro['id']; ?>" target="_blank"><i class="bi bi-file-earmark-pdf" style="font-size: 2rem; color:black;"></i></a>
          </div>
        
        </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
