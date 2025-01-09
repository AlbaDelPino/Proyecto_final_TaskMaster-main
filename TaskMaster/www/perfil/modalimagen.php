<?php
include('../conexion/config.php');


$id_usuario = $_SESSION['id_usuario'];


$sql3 = "SELECT * FROM usuario where id_usuario='$id_usuario' ";
              
                $res3 = mysqli_query($conn, $sql3);
                $fila3 = mysqli_fetch_assoc($res3);
                $usuario3 = $fila3['nombre'];
                if ($usuario3 == "admin"){
                  $SqlEventos2   = "SELECT * FROM usuario WHERE id_usuario= $id_usuario";
                  $resulEventos2 = mysqli_query($conn, $SqlEventos2);
             
                  $registro3 = mysqli_fetch_assoc($resulEventos2);
              
                }
                else{
                  $SqlEventos2   = "SELECT * FROM usuario us 
                  inner join ciudad ci 
                  on ci.id_ciudad= us.ciudad  WHERE us.id_usuario= $id_usuario";
                  $resulEventos2 = mysqli_query($conn, $SqlEventos2);
                
                  $registro3 = mysqli_fetch_assoc($resulEventos2);
                }
               
?>

<div class="modal fade" id="imagen_<?php echo $registro3['id_usuario']; ?>" tabindex="-1" aria-labelledby="imagen_<?php echo $registro3['id_usuario']; ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imagen_<?php echo $registro3['id_usuario']; ?>">Actualizar imagen:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form name="perfil" id="imagen_<?php echo $registro3['id_usuario']; ?>" enctype="multipart/form-data" action="actualizar_imagen.php" class="form-horizontal" method="POST">
          <input type="hidden" class="form-control" name="idEvento" id="idEvento" value="<?php echo $registro3['id_usuario']; ?>">
          <?php 
            echo "<img width='300hm' height='300hm' src='../{$registro2['imagen']}' alt='Imagen de producto'>"; 

            ?>
          
          <div class="mb-3">
      <label for="" class="form-label"><b>Imagen</b></label>
      <div class="col-sm-10">
      <input type="file"
        class="form-control" name="fotografia" id="fotografia" required accept="image/*">
      <small id="helpId" class="form-text text-muted">fotografia</small>
    </div>
    </div> 
          

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
