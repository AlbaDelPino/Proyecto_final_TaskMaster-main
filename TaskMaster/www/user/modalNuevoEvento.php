<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear un nuevo usuario:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form name="formEvento" id="formEvento" enctype="multipart/form-data" action="nueva_tarea.php" class="form-horizontal" method="POST">
		
    <div class="form-group">
        <label for="nombre" class="col-sm-12 control-label">Nombre del usuario</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre del usuario" required/>
        </div>
      </div>
  
      <div class="form-group">
        <label for="apellido" class="col-sm-12 control-label">Apellido</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido" required/>
        </div>
      </div>
  
      <div class="form-group">
        <label for="correo_electronico" class="col-sm-12 control-label">correo_electronico</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="correo_electronico" id="correo_electronico" placeholder="correo_electronico">
        </div>
      </div>
  
      
      <div class="form-group">
        <label for="contraseña" class="col-sm-12 control-label">contraseña</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="contraseña">
        </div>
      </div>
  
      <div class="form-group">
        <label for="" class="col-sm-12 form-label">Nombre de la ciudad</label>
        <div class="col-sm-10">
        <select name="id_ciudad" class="form-control">
            <option selected disabled>Seleccione la ciudad</option>
            <?php
            include("config.php");
            mysqli_select_db($con, "practicas");
            $consultarUsuario = "SELECT * FROM ciudad";
  
            $sqlUsuario = mysqli_query($con, $consultarUsuario);
  
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
      <label for="" class="col-sm-12 form-label">Imagen</label>
      <div class="col-sm-10">
      <input type="file"
        class="form-control" name="fotografia" id="fotografia" required accept="image/*, .pdf, .doc, .docx, .odt">
      <small id="helpId" class="form-text text-muted">fotografia</small>
    </div>
    </div>
  
 
      
       <div class="modal-footer">
          <button type="submit" class="btn btn-success">Guardar Evento</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </form>
      </div>
      
    </div>
  </div>
</div>