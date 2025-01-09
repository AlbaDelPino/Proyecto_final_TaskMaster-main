<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="compartir_<?php echo $registro['id']; ?>" tabindex="-1" aria-labelledby="compartir_<?php echo $registro['id']; ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Compartir evento:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    
 <div class="botones">
 <button style="width:50%" class=" border-0" id="boton1<?php echo $registro['id']; ?>" onclick="cambiaVisibilidad(<?php echo $registro['id']; ?>)">correo</button>
 <button style="width:50%"class=" border-0" id="boton2<?php echo $registro['id']; ?>"  onclick="cambiaVisibilidad2(<?php echo $registro['id']; ?>)">whatsapp </button>
 
 </div>
      <div class="modal-body" id="compartir<?php echo $registro['id']; ?>">
      <form name="formEvento" id="compartir_<?php echo $registro['id']; ?>" enctype="multipart/form-data" action="compartir.php" class="form-horizontal" method="POST">
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
      <input type="hidden" id="datoNombre" type="text" class="form-control" name="idEvento" id="idEvento" value="<?php echo $registro['id']; ?>">      

    <div class="form-group">
        <label for="evento" class="col-sm-12 control-label">Correo Electronico</label>
        <div class="col-sm-10">
          <input  id="datotelefono" type="text" type="text" class="form-control" name="correo_electronico" id="correo_electronico" placeholder="Nombre del Evento" required/>
        </div>
      </div>
  
     
 
      
       <div class="modal-footer">
          <button type="submit" onclick="enviar()" id="btnEnviar" class="btn compartir btn-success">compartir</button>
          <button type="button"   class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </form>
      </div>
      <?php
} else {
    echo "No se encontró el producto para actualizar.";
}

?>
<div class="modal-body" id="whatsapp<?php echo $registro['id']; ?>" style="display:none;">
<form action="" class="form-horizontal">
          <!-- Input fields -->
          <input type="hidden" id="datoNombre_<?php echo $registro['id']; ?>" type="text" class="form-control" name="idEvento" value="<?php echo $registro['evento']; ?>">
          <input type="hidden"id="datofecha_inicio_<?php echo $registro['id']; ?>" type="text" class="form-control" name="idEvento" value="<?php echo $registro['fecha_inicio']; ?>">
          <input type="hidden"id="datofecha_fin_<?php echo $registro['id']; ?>" type="text" class="form-control" name="idEvento" value="<?php echo $registro['fecha_fin']; ?>">
          <input type="hidden"id="datodescripcion_<?php echo $registro['id']; ?>" type="text" class="form-control" name="idEvento" value="<?php echo $registro['descripcion']; ?>">
          <input type="hidden"id="datoestado_<?php echo $registro['id']; ?>" type="text" class="form-control" name="idEvento" value="<?php echo $registro['nombre_estado']; ?>">
          <!-- <a type="hidden" id="datoarchivo_<?php echo $registro['id']; ?>" href="../pdf/<?php echo $registro['evento'];echo $registro['id']; ?>.pdf" alt="Imagen de usuario"><?php echo $registro['evento'];echo $registro['id']; ?>.pdf</a> -->
                                
          <!-- <input type="hidden" id="datoNombre_<?php echo $registro['id']; ?>" type="text" class="form-control" name="idEvento" value="<?php echo $registro['evento']; ?>"> -->
          <div class="form-group">
            <label for="evento" class="col-sm-12 control-label">Teléfono</label>
            <div class="col-sm-10">
              <input id="datotelefono_<?php echo $registro['id']; ?>" type="text" class="form-control" name="correo_electronico" placeholder="Número de teléfono" required/>
            </div>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
          
          <a onclick="enviar(<?php echo $registro['id']; ?>)" target="_blank" id="btnEnviar_<?php echo $registro['id']; ?>" href="#" class="btn btn-success">Enviar</a>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </form>
       <script>
    /*https://api.whatsapp.com/send?phone=(codigo pais)(codigo de area)(numero sin el 15)&text=*/
    /* Espacio : %20  ``*/

    /* Traer los inputs */
    /* Crear funcion añadiendo el valor correspondiente a la variable mensaje */

    function enviar(id) {
        var datoNombre = document.querySelector('#datoNombre_' + id);
        var datofecha_inicio = document.querySelector('#datofecha_inicio_' + id);
        var datofecha_fin = document.querySelector('#datofecha_fin_' + id);
        var datodescripcion = document.querySelector('#datodescripcion_' + id);
        var datoestado = document.querySelector('#datoestado_' + id);
        var datoarchivo = document.querySelector('#datoarchivo_' + id);
        var datotelefono = document.querySelector('#datotelefono_' + id);
        var btnEnviar = document.querySelector('#btnEnviar_' + id);

        var mensaje = `https://api.whatsapp.com/send?phone=34${datotelefono.value}&text=Tarea:${datoNombre.value}%0Afecha_inicio:${datofecha_inicio.value}%0Afecha_fin:${datofecha_fin.value}%0Adescripción:${datodescripcion.value}%0Aestado:${datoestado.value}`;
        console.log(mensaje)
        btnEnviar.href = mensaje;
        
    }
</script>
      </div>
    </div>
  </div>
</div>

<script>
  
   function cambiaVisibilidad2(id) {
       var div1 = document.getElementById('compartir'+ id);
       var div2 = document.getElementById('whatsapp'+ id);
       var boton1 = document.getElementById('boton1'+ id);
       var boton2 = document.getElementById('boton2'+ id);
       if(div2.style.display == 'none'){
        div2.style.display = 'block';
        div1.style.display = 'none';
        boton1.style.backgroundColor ="#ccc";
           boton2.style.backgroundColor="#53af53"
    }
   }
   function cambiaVisibilidad(id) {
       var div1 = document.getElementById('compartir'+ id);
       var div2 = document.getElementById('whatsapp'+ id);
       var boton1 = document.getElementById('boton1'+ id);
       var boton2 = document.getElementById('boton2'+ id);
       if(div2.style.display == 'block'){
           div2.style.display = 'none';
           div1.style.display = 'block';
           boton2.style.backgroundColor ="#ccc";
           boton1.style.backgroundColor="#53af53"
       }
   }
</script>