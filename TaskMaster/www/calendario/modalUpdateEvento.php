
<div class="modal" id="modalUpdateEvento"  tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Actualizar  Evento </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form name="formEventoUpdate" id="formEventoUpdate"  enctype="multipart/form-data" action="actualizar_evento2.php" class="form-horizontal" method="POST">
      
      <input type="hidden" class="form-control" name="idEvento" id="idEvento">
      
      <div class="form-group">
			<label for="evento" class="col-sm-12 control-label">Nombre del Evento</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="evento" id="evento" placeholder="Nombre del Evento" required/>
			</div>
		</div>

    <div class="form-group">
			<label for="descripcion" class="col-sm-12 control-label">Descripcion</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion" required/>
			</div>
		</div>

    <div class="form-group">
      <label for="" class="col-sm-12  form-label">Nombre de la etiqueta</label>
      <div class="col-sm-10">
      <select name="id_etiqueta" class="form-control">
          <option selected disabled>Seleccione la etiqueta</option>
          <?php
          include("config.php");
          mysqli_select_db($con, "practicas");
          $consultarUsuario = "SELECT * FROM etiquetas";

          $sqlUsuario = mysqli_query($con, $consultarUsuario);

          // Verifica si hay resultados antes de recorrerlos
          if ($sqlUsuario) {
              while ($resultadoUsuario = mysqli_fetch_assoc($sqlUsuario)) {
                  echo "<option value='" . $resultadoUsuario['id_etiqueta'] . "'>" . $resultadoUsuario['nombre_etiqueta'] . "</option>";
              }
          } else {
              echo "Error en la consulta: " . mysqli_error($conn);
          }
          ?>
      </select>
    </div>
    </div>

    <div class="form-group">
      <label for="" class="col-sm-12 form-label">Estado</label>
      <div class="col-sm-10">
      <select name="id_estado" class="form-control">
          <option selected disabled>Seleccione el estado</option>
          <?php
          include("config.php");
          mysqli_select_db($con, "practicas");
          $consultarUsuario = "SELECT * FROM estado";

          $sqlUsuario = mysqli_query($con, $consultarUsuario);

          // Verifica si hay resultados antes de recorrerlos
          if ($sqlUsuario) {
              while ($resultadoUsuario = mysqli_fetch_assoc($sqlUsuario)) {
                  echo "<option value='" . $resultadoUsuario['id_estado'] . "'>" . $resultadoUsuario['nombre_estado'] . "</option>";
              }
          } else {
              echo "Error en la consulta: " . mysqli_error($conn);
          }
          ?>
      </select>
    </div>
    </div>

    <div class="form-group">
      <label for="fecha_inicio" class="col-sm-12 control-label">Fecha Inicio</label>
      <div class="col-sm-10">
        <input type="datetime-local"  class="form-control" name="fecha_inicio" id="fecha_inicio" placeholder="Fecha Inicio">
      </div>
    </div>

    <div class="form-group">
      <label for="fecha_fin" class="col-sm-12 control-label">Fecha Final</label>
      <div class="col-sm-10">
        <input type="datetime-local"  class="form-control" name="fecha_fin" id="fecha_fin" placeholder="Fecha Final">
      </div>
    </div>
  

  <div class="form-group">
    <label for="color" class="col-sm-12  form-label">Color </label>
    <div class="col-sm-10">
    <input type="color"
      class="form-control" name="color" id="color"  required aria-describedby="helpId" placeholder="color">
    <small id="helpId" class="form-text text-muted">Color</small>
  </div>
  </div>
 

 

<!-- Agrega un nuevo campo de entrada de tipo file para permitir al usuario seleccionar un nuevo archivo -->


	   <div class="modal-footer">
      	<button type="submit" class="btn btn-success">Guardar Evento</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
    	</div>
	</form>
    </div>
  </div>
</div>