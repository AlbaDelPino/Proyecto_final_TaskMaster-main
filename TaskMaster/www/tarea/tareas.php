<?php

include "../header.php";


?>

    <section class="principal-tarea">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    NUEVO EVENTO
</button>

        <table  class="tabla">
            <thead>
                <tr>
                    <th scope="col">Tarea</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Fecha Inicio</th>
                    <th scope="col">Fecha Final</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Etiqueta</th>
                    <th scope="col">Archivos</th>
                    <th scope="col">compartido por:</th>
                    <th scope="col">compartir</th>
                    
                    <th scope="col">actualizar</th>
                    <th scope="col">pdf</th>
                    <th scope="col">borrar</th>
                </tr>
            </thead>
            <tbody>
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
                ?>
                    <tr class="align-middle">
                        <td scope="row" data-label="evento"><?php echo $registro['evento']; ?></td>
                        <td data-label="Descripción"><?php echo $registro['descripcion']; ?></td>
                        <td data-label="Fecha de inicio"><?php echo $registro['fecha_inicio']; ?></td>
                        <td data-label="Fecha final"><?php echo $registro['fecha_fin']; ?></td>
                        <td data-label="Estado"><?php echo $registro['nombre_estado']; ?></td>
                        <td data-label="Etiquetas"><?php echo $registro['nombre_etiqueta']; ?></td>
                        
                        </td>
                        <td data-label="Archivos">
    <a type="button" data-bs-toggle="modal" data-bs-target="#archivo_<?php echo $registro['id']; ?>" data-id="<?php echo $registro['id']; ?>">
    <i class="bi bi-file-earmark" style="font-size: 2rem; color:black;"></i>
    </a>
</td>

                        <td data-label="Compartido por:">
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

                        </td>
                        <td data-label="Compartir">
    <a type="button" data-bs-toggle="modal" data-bs-target="#compartir_<?php echo $registro['id']; ?>" data-id="<?php echo $registro['id']; ?>">
    <i class="bi bi-people-fill" style="font-size: 2rem; color:blue;"></i>
    </a>
</td>


<td data-label="Actualizar">
    <a type="button" data-bs-toggle="modal" data-bs-target="#actualizarevento_<?php echo $registro['id']; ?>" data-id="<?php echo $registro['id']; ?>">
        <i class="bi-pencil px-1" style="font-size: 2rem; color:green;"></i>
        
    </a></td>
    <td data-label="descarga">
    <a type="button" data-bs-toggle="modal" data-bs-target="#pdf_<?php echo $registro['id']; ?>" data-id="<?php echo $registro['id']; ?>">
    <i class="bi bi-download" style="font-size: 2rem; color:blue;"></i>
    </a>
</td>
                        <td data-label="Borrar"> <a href="deleteEvento.php?id=<?php echo $registro['id']; ?>"><i class="bi-trash px-1" style="font-size: 2rem; color:red;"></i> </a></td>  

                    </tr>
                    <?php  

  include('modalUpdateEvento.php');
  include('modalcompartir.php');
  include('modalpdf.php');
  include('modalarchivo.php');

?>
 
                <?php
                }
                ?>
            </tbody>
        </table>
        
        <?php  
include('modalNuevoEvento.php');

  

?>
    </section> 
</main>
<!-- Bootstrap -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
