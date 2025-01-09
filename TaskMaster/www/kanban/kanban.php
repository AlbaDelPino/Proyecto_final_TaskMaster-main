<?php include('../header.php'); ?>
    <?php  

include('modalkanban.php');

include('modalNuevoEvento.php');

?>

    <section class="principal-kanban">
        
        <article>
        <button type="button" class="btn btn-primary  fs-5" data-bs-toggle="modal" data-bs-target="#example2Modal">
            Añadir
            </button>
        </article>
       
        <article class="no_iniciado" id="divPendiente" ondrop="drop(event,'Pendiente')" ondragover="allowDrop(event,'Pendiente')" data-estado="Pendiente">
         <h2 class="fs-5">No iniciado </h2>   
         <?php
                include('../login/config.php');

                $sql2 = "SELECT * FROM usuario where id_usuario='$id_usuario' ";
                $res2 = mysqli_query($conn, $sql2);
                $fila = mysqli_fetch_assoc($res2);
                $usuario = $fila['nombre'];
                if ($usuario == "admin"){
                    $SqlEventos3  = "SELECT * FROM eventoscalendar ev 
                    
                    inner join estado es on es.id_estado=ev.id_estado 
                    inner join etiquetas et on et.id_etiqueta=ev.id_etiquetas 
                    -- inner join archivo_evento ae on ae.id_evento = ev.id
                    -- inner join archivos ar on ae.id_archivo= ar.id_archivo
                   "; // Seleccionar solo eventos del usuario actual
                    $resulEventos3 = mysqli_query($conexion, $SqlEventos3);
                }
                else{
                    $SqlEventos3  = "SELECT * FROM eventoscalendar ev 
                    inner join usuario_evento ue on ue.id_evento = ev.id
                    inner join usuario us on ue.id_usuario=us.id_usuario 
                    inner join estado es on es.id_estado=ev.id_estado 
                    inner join etiquetas et on et.id_etiqueta=ev.id_etiquetas 
                    -- inner join archivo_evento ae on ae.id_evento = ev.id
                    -- inner join archivos ar on ae.id_archivo= ar.id_archivo
                    where us.id_usuario = $id_usuario"; // Seleccionar solo eventos del usuario actual
                    $resulEventos3 = mysqli_query($conexion, $SqlEventos3);
                }

              

?>
          <?php
         
        while($registro = mysqli_fetch_assoc($resulEventos3)) {
            $estado =$registro['nombre_estado'];
         if($estado == "Pendiente") {
                        ?>   
                     
                 <a id="<?php echo $registro['id']; ?>" data-estado="Pendiente" ondragstart="drag(event,'Pendiente')" draggable="true"  data-bs-toggle="modal" data-bs-target="#actualizarevento_<?php echo $registro['id']; ?>" data-id="<?php echo $registro['id']; ?>">
                 <P style=" background-color: <?php echo $registro['color_evento']; ?>;color:#fff;"><?php echo $registro['evento']; ?></P>
         </a>
                       
                    
        <?php  

        include('modalUpdateEvento.php');

        ?>
                    <?php
                    } else{
                        
                ?>
       
        
         <?php
         }
                }
                ?>

        </article>

        <article class="en_curso" id="divEnProceso" ondrop="drop(event,'En proceso')" ondragover="allowDrop(event,'En proceso')" data-estado="En proceso">
            
         <h2 class="fs-5">En curso</h2> 
         <?php
         $sql3 = "SELECT * FROM usuario where id_usuario='$id_usuario' ";
         $res3 = mysqli_query($conn, $sql3);
         $fila3 = mysqli_fetch_assoc($res3);
         $usuario3 = $fila3['nombre'];
         if ($usuario3 == "admin"){
            $SqlEventos3  = "SELECT * FROM eventoscalendar ev  inner join estado es on es.id_estado = ev.id_estado ";
            $resulEventos3 = mysqli_query($conn, $SqlEventos3); 
        }
        else{
            $SqlEventos3  = "SELECT * FROM eventoscalendar ev inner join usuario_evento ue on ue.id_evento = ev.id
            inner join usuario us on ue.id_usuario=us.id_usuario inner join estado es on es.id_estado = ev.id_estado WHERE ue.id_usuario = $id_usuario";
            $resulEventos3 = mysqli_query($conn, $SqlEventos3); 
        }
          
        while($registro = mysqli_fetch_assoc($resulEventos3)) {
            $estado =$registro['nombre_estado'];
           
          if($estado == "En proceso") {
            ?>  
           
           <a id="<?php echo $registro['id']; ?>"data-estado="En proceso" ondragstart="drag(event,'En proceso')" draggable="true" data-bs-toggle="modal"  data-bs-target="#actualizarevento_<?php echo $registro['id']; ?>" data-id="<?php echo $registro['id']; ?>">
           <P style=" background-color: <?php echo $registro['color_evento']; ?>;color:#fff;"><?php echo $registro['evento']; ?></P>
          </a> 
                       
                    
        <?php  

        include('modalUpdateEvento.php');

        ?>
                    <?php
                    } else{
                        
                ?>
       
        
         <?php
         }
                }
                ?>
         
        </article>

        

        <article class="completado"id="divCompletado" ondrop="drop(event,'Completado')" ondragover="allowDrop(event,'Completado')" data-estado="Completado">
            <h2 class="fs-5">Completado</h2> 
            <?php
            $sql2 = "SELECT * FROM usuario where id_usuario='$id_usuario' ";
            $res2 = mysqli_query($conn, $sql2);
            $fila2 = mysqli_fetch_assoc($res2);
            $usuario2 = $fila3['nombre'];
            if ($usuario2 == "admin"){
                $SqlEventos2  = "SELECT * FROM eventoscalendar ev  inner join estado es on es.id_estado = ev.id_estado ";
                $resulEventos2 = mysqli_query($conn, $SqlEventos2);  
            }
            else{
                $SqlEventos2  = "SELECT * FROM eventoscalendar ev inner join usuario_evento ue on ue.id_evento = ev.id
                inner join usuario us on ue.id_usuario=us.id_usuario inner join estado es on es.id_estado = ev.id_estado WHERE ue.id_usuario = $id_usuario";
                $resulEventos2 = mysqli_query($conn, $SqlEventos2); 
            }
         
        while($registro = mysqli_fetch_assoc($resulEventos2)) {
            $estado =$registro['nombre_estado'];
        if($estado== "Completado" ) {
                        ?>   
                        
                   <a id="<?php echo $registro['id']; ?>" data-estado="Completado" ondragstart="drag(event,'Completado')" ondragstart="drag(event)" draggable="true"    data-bs-toggle="modal" data-bs-target="#actualizarevento_<?php echo $registro['id']; ?>" data-id="<?php echo $registro['id']; ?>">
                   <P style=" background-color: <?php echo $registro['color_evento']; ?>;color:#fff;"><?php echo $registro['evento']; ?></P>

                        
                        <?php  

include('modalUpdateEvento.php');

?>
                    <?php
                    } else{
                        
                ?>
        
       
        
         <?php
         }
                }
                
                ?>
           </article>
           
           <article class="detenido" id="divDetenido" ondrop="drop(event,'Detenido')" ondragover="allowDrop(event,'Detenido')" data-estado="Detenido">
         <h2  class="fs-5">Detenido</h2>  
          
         <?php
         $sql4 = "SELECT * FROM usuario where id_usuario='$id_usuario' ";
         $res4 = mysqli_query($conn, $sql4);
         $fila4 = mysqli_fetch_assoc($res4);
         $usuario4 = $fila3['nombre'];
         if ($usuario4 == "admin"){
            $SqlEventos4   = "SELECT * FROM eventoscalendar ev  inner join estado es on es.id_estado = ev.id_estado";
            $resulEventos4 = mysqli_query($conn, $SqlEventos4);  
            }
            else{
                $SqlEventos4   = "SELECT * FROM eventoscalendar ev inner join usuario_evento ue on ue.id_evento = ev.id
             inner join usuario us on ue.id_usuario=us.id_usuario inner join estado es on es.id_estado = ev.id_estado WHERE ue.id_usuario = $id_usuario";
             $resulEventos4 = mysqli_query($conn, $SqlEventos4);
            }
              
        while($registro = mysqli_fetch_assoc($resulEventos4)) {
            $estado =$registro['nombre_estado'];
        if($estado== "Detenido") {
                        ?>  
                      
                      <a id="<?php echo $registro['id']; ?>"data-estado="Detenido" ondragstart="drag(event,'Detenido')" draggable="true" data-bs-toggle="modal"  data-bs-target="#actualizarevento_<?php echo $registro['id']; ?>" data-id="<?php echo $registro['id']; ?>">
                      <P style=" background-color: <?php echo $registro['color_evento']; ?>;color:#fff;"><?php echo $registro['evento']; ?></P>
                     </a>    
                   
                    <?php  

                           include('modalUpdateEvento.php');

                     ?>
                    <?php
                        } else{
                                
                    ?>
                
            
                
                     <?php
                      }
                        }
                        
                     ?>
                    
            

        </article>
    </section> 
</main>
<!-- bootstrap -->
<script src="../js/jquery-3.0.0.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/moment.min.js"></script>	
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    // JavaScript para manejar el arrastrar y soltar
    function allowDrop(ev) {
        ev.preventDefault();
    }

    function drag(ev) {
        ev.dataTransfer.setData("text", ev.target.id);
    }

    function drop(ev) {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        var targetId = ev.target.id; // Obtener el ID del contenedor de destino
        var target = document.getElementById(targetId); // Obtener el contenedor de destino
        target.appendChild(document.getElementById(data));
        var idEvento = data;
        var estado = target.getAttribute('data-estado'); // Obtener el estado del contenedor de destino
        actualizarEstado(idEvento, estado);
    }

    function actualizarEstado(idEvento, estado) {
        console.log("ID del evento:", idEvento);
        console.log("Estado:", estado);

        $.ajax({
            url: 'actualizar_estado.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ idEvento: idEvento, estado: estado }),
            success: function(response) {
                console.log(response);
                // Después de que se haya actualizado el estado, recargar la página
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error('Error en la solicitud:', error);
            }
        });
    }
</script>



</body>
</html>