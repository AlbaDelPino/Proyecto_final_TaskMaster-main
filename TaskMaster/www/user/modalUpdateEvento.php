
<div class="modal fade" id="actualizarevento_<?php echo $registro['id_usuario']; ?>" tabindex="-1" aria-labelledby="actualizareventoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="actualizareventoLabel">Actualizar usuario:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form name="formEventoUpdate" id="formUpdateEvento_<?php echo $registro['id_usuario']; ?>"  enctype="multipart/form-data" action="actualizar_evento2.php" class="form-horizontal" method="POST">
      <?php 


mysqli_Select_db($conexion, "practicas");
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
  $id = $registro['id_usuario'];
//   // Aquí puedes hacer lo que necesites con el ID
//   echo "ID recibido: " . $id;
// } else {
//   echo "Error: No se recibió ningún ID.";
// }
$seleccionar = "SELECT * FROM usuario us inner join ciudad ci on us.ciudad=ci.id_ciudad where us.id_usuario ='$id'";
$registros = mysqli_Query($conexion, $seleccionar);

if ($registro = mysqli_fetch_assoc($registros)) {
?>
      <input type="hidden" class="form-control" name="id_usuario" id="id_usuario" value="<?php echo $registro['id_usuario']; ?>">      
      <div class="form-group">
			<label for="usuario" class="col-sm-12 control-label">Nombre del usuario</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $registro['nombre'];?>" placeholder="Nombre del usuario" required/>
			</div>
		</div>

    <div class="form-group">
			<label for="usuario" class="col-sm-12 control-label">Apellido</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="apellido" id="apellido" value="<?php echo $registro['apellido'];?>" placeholder="Nombre del apellido" required/>
			</div>
		</div>
    <div class="form-group">
      <label for="correo_electronico" class="col-sm-12 control-label">Correo electronico</label>
      <div class="col-sm-10">
        <input type="text"  class="form-control" value="<?php echo $registro['correo_electronico'];?>" name="correo_electronico" id="correo_electronico" placeholder="Fecha Inicio">
      </div>
    </div>
    <div class="form-group">
      <label for="contraseña" class="col-sm-12 control-label">contraseña</label>
      <div class="col-sm-10">
        <input type="password"  class="form-control" value="<?php echo $registro['contraseña'];?>" name="contraseña" id="contraseña" placeholder="Contraseña">
      </div>
    </div>

    <div class="form-group">
      <label for="" class="col-sm-12 form-label">ciudad</label>
      <div class="col-sm-10">
      <select name="ciudad" class="form-control">
          <option selected disabled>Seleccione la ciudad</option>
          <?php
          include("config.php");
          mysqli_select_db($con, "practicas");
          $consultarUsuario = "SELECT * FROM ciudad";

          $sqlUsuario = mysqli_query($con, $consultarUsuario);
                  echo "<option selected value='" . $registro['id_ciudad'] . "'>" . $registro['nombre_ciudad'] . "</option>";

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
          <label for="archivo_actual">Archivo Actual:</label>
          <?php 
echo "<img src='../{$registro['imagen']}' style='width:50px;' alt='Imagen de producto'>";

?>
        </div>
 
 <div class="form-group">
    <label for="fotografia">Nuevo Archivo:</label>
 
    <input type="file" class="form-control" name="fotografia" id="fotografia" required accept="image/*, .pdf, .doc, .docx, .odt">
</div>  

	   <div class="modal-footer">
      	<button type="submit" class="btn btn-success">Guardar Evento</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
    	</div>
	</form>
      </div>
      <div class="modal-footer">
       
      </div>
    </div>
  </div>
</div>
<?php
} else {
    echo "No se encontró el producto para actualizar.";
}

?>