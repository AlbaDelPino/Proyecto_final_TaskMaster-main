<?php include('../header.php'); ?>
    <section class="principal-chatper">
    <table class="tabla">
    <thead>
        <tr>
            <th scope="col">Tarea</th>
            <th scope="col">personas</th>
            <th scope="col">chat</th>
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
                    inner join usuario_evento ue on ue.id_evento = ev.id
                    inner join usuario us on ue.id_usuario=us.id_usuario 
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
                <td><?php echo $registro['evento']; ?></td>
                <td>
                    <?php
                    $compartir = $registro['id'];
                    $SqlEventos2   = "SELECT * FROM eventoscalendar ev INNER JOIN usuario_evento ue ON ue.id_evento = ev.id INNER JOIN usuario us ON ue.id_usuario=us.id_usuario WHERE ev.id = $compartir ";
                    $id_usuario = $_SESSION['id_usuario'];
                    $resulEventos2 = mysqli_query($conn, $SqlEventos2);
                    ?>
                    <?php
                    while($registro2 = mysqli_fetch_assoc($resulEventos2)) {
                        $nombre_compartir = $registro2['nombre'];
                    //    echo $usuario;
                        if($nombre_compartir == $usuario) {

                          ?>
                          <p>yo </p>
                          <?php    // No mostrar nada
                        } else {
                    ?>
                        <p><?php echo $registro2['nombre']; ?></p>
                    <?php
                        }
                    }
                    ?>
                </td>
                <td>
               
                    <a href="per_chat.php?id=<?php echo $registro['id']; ?>">
                        <i class="bi bi-chat-dots" style="font-size: 2rem; color:green;"></i>
                    </a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

       
        
 </section> 
</main>
<!-- bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
 <!-- <p>hofgla</p>    -->
</body>
</html>