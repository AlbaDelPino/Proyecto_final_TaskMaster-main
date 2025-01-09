
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
<div class="modal fade" id="perfil_<?php echo $registro2['id_usuario']; ?>" tabindex="-1" aria-labelledby="perfil_<?php echo $registro2['id_usuario']; ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="perfil_<?php echo $registro2['id_usuario']; ?>">Actualizar perfil:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form name="perfil" id="perfil_<?php echo $registro['id']; ?>"  enctype="multipart/form-data" action="actualizar_perfil.php" class="form-horizontal" method="POST">
      
<input type="hidden" class="form-control" name="idEvento" id="idEvento" value="<?php echo $registro2['id_usuario']; ?>">      
      <div class="form-group">
			<label for="evento" class="col-sm-12 control-label">Nombre del usuario</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $registro2['nombre'];?>" placeholder="Nombre del Evento" required/>
			</div>
		</div>

      <div class="form-group">
			<label for="evento" class="col-sm-12 control-label">apellido</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="apellido" id="apellido" value="<?php echo $registro2['apellido'];?>" placeholder="Nombre del Evento" required/>
			</div>
		</div>

      <div class="form-group">
			<label for="ciudad" class="col-sm-12 control-label">ciudad</label>
			<div class="col-sm-10">
          <select name="ciudad" class="form-control"> 
              <option selected disabled>Seleccione la categoria</option>
              <?php
              include("config.php");
              mysqli_select_db($con, "practicas");
              $consultarUsuario = "SELECT * FROM ciudad";

              $sqlUsuario = mysqli_query($con, $consultarUsuario);
              echo "<option selected value='" . $registro2['id_ciudad'] . "'>" . $registro2['nombre_ciudad'] . "</option>";
            
              // Verifica si hay resultados antes de recorrerlos
              if ($sqlUsuario) {
                  while ($resultadoUsuario = mysqli_fetch_assoc($sqlUsuario)) {
                      echo "<option value='" . $resultadoUsuario['id_ciudad'] . "'>" . $resultadoUsuario['nombre_ciudad'] . "</option>";
                  }
              } else {
                  echo "Error en la consulta: " . mysqli_error($conn);
              }
              ?>
          </select>			
        </div>
		</div>

      <div class="form-group">
			<label for="evento" class="col-sm-12 control-label">correo electronico</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="correo" id="correo" value="<?php echo $registro2['correo_electronico'];?>" placeholder="Nombre del Evento" required/>
			</div>
		</div>
    <div class="form-group">
			<label for="evento" class="col-sm-12 control-label">contraseña</label>
			<div class="col-sm-10">
				<input type="password" class="form-control" name="contraseña" id="contraseña" value="<?php echo $registro2['contraseña'];?>" placeholder="contraseña">
			</div>
		</div>

    <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
      </div>
      </form>
   
  </div>
</div>