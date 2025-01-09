
<div class="modal fade" id="actualizarevento_<?php echo $registro['id']; ?>" tabindex="-1" aria-labelledby="actualizareventoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="actualizareventoLabel">Actualizar evento:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form name="formEventoUpdate" id="formUpdateEvento_<?php echo $registro['id']; ?>"  enctype="multipart/form-data" action="actualizar_evento2.php" class="form-horizontal" method="POST">
      <?php 


mysqli_Select_db($conexion, "practicas");
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
  $id = $registro['id'];
//   // Aquí puedes hacer lo que necesites con el ID
//   echo "ID recibido: " . $id;
// } else {
//   echo "Error: No se recibió ningún ID.";
// }
$seleccionar = "SELECT * FROM eventoscalendar ev inner join usuario_evento ue on ue.id_evento = ev.id
inner join usuario us on ue.id_usuario=us.id_usuario inner join estado es on es.id_estado=ev.id_estado inner join etiquetas et on et.id_etiqueta=ev.id_etiquetas  WHERE ev.id ='$id'";
$registros = mysqli_Query($conexion, $seleccionar);

if ($registro = mysqli_fetch_assoc($registros)) {
?>
      <input type="hidden" class="form-control" name="idEvento" id="idEvento" value="<?php echo $registro['id']; ?>">      
      <div class="form-group">
			<label for="evento" class="col-sm-12 control-label">Nombre del Evento</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="evento" id="evento" value="<?php echo $registro['evento'];?>" placeholder="Nombre del Evento" required/>
			</div>
		</div>

    <div class="form-group">
			<label for="descripcion" class="col-sm-12 control-label">Nombre del descripcion</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="descripcion" id="descripcion" value="<?php echo $registro['descripcion'];?>" placeholder="Nombre del descripcion" required/>
			</div>
		</div>

    <div class="form-group">
      <label for="" class="form-label"><b>Nombre de la etiqueta</b></label>
      <div class="col-sm-10">
      <select name="id_etiqueta" class="form-control">
          <option selected disabled>Seleccione la categoria</option>
          <?php
          include("config.php");
          mysqli_select_db($con, "practicas");
          $consultarUsuario = "SELECT * FROM etiquetas";

          $sqlUsuario = mysqli_query($con, $consultarUsuario);
                  echo "<option selected value='" . $registro['id_etiqueta'] . "'>" . $registro['nombre_etiqueta'] . "</option>";

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
      <label for="" class="form-label"><b>Estado</b></label>
      <div class="col-sm-10">
      <select name="id_estado" class="form-control">
          <option selected disabled>Seleccione la categoria</option>
          <?php
          include("config.php");
          mysqli_select_db($con, "practicas");
          $consultarUsuario = "SELECT * FROM estado";

          $sqlUsuario = mysqli_query($con, $consultarUsuario);
          echo "<option selected value='" . $registro['id_estado'] . "'>" . $registro['nombre_estado'] . "</option>";
        
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
        <input type="datetime-local"  class="form-control" value="<?php echo $registro['fecha_inicio'];?>" name="fecha_inicio" id="fecha_inicio" placeholder="Fecha Inicio">
      </div>
    </div>

    <div class="form-group">
      <label for="fecha_fin" class="col-sm-12 control-label">Fecha Final</label>
      <div class="col-sm-10">
        <input type="datetime-local"  class="form-control" value="<?php echo $registro['fecha_fin'];?>" name="fecha_fin" id="fecha_fin" placeholder="Fecha Final">
      </div>
    </div>
  

  <div class="form-group">
    <label for="color" class="form-label"><b>color </b></label>
    <div class="col-sm-10">
    <input type="color"
      class="form-control" name="color" id="color" value="<?php echo $registro['color_evento'];?>" required aria-describedby="helpId" placeholder="color">
    <small id="helpId" class="form-text text-muted">color</small>
  </div>
  </div>

  <label for="compartido" class="form-label"><b>compartido por : </b></label>

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

        <!-- Campo oculto para almacenar la ruta del archivo actual -->
        

     

	   <div class="modal-footer">
     <a href="deleteEvento.php?id=<?php echo $registro['id']; ?>"><i class="bi-trash px-1" style="font-size: 2rem; color:red;"></i> </a> 

      	<button type="submit" class="btn btn-success">Guardar Evento</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
    	</div>
	</form>
      </div>
      
    </div>
  </div>
</div>
<?php
} else {
    echo "No se encontró el producto para actualizar.";
}

?>