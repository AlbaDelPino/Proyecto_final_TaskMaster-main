<?php

include "../header.php";


?>

    <section class="principal-tarea">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  nuevo evento
</button>

        <table  class="tabla">
            <thead>
                <tr>
                    <th scope="col">Nombre de usuario</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Correo_electronico</th>
                    <th scope="col">Contraseña</th>
                    <th scope="col">Ciudad</th>
                    <th scope="col">Actualizar</th>
                    <th scope="col">Borrar</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include('../login/config.php');
                $sql2 = "SELECT * FROM usuario where id_usuario='$id_usuario' ";
                $res2 = mysqli_query($conn, $sql2);
                $fila = mysqli_fetch_assoc($res2);
                $usuario = $fila['nombre'];

                $SqlEventos3  = "SELECT * FROM usuario us inner join ciudad ci on us.ciudad=ci.id_ciudad"; // Seleccionar solo eventos del usuario actual
                $resulEventos3 = mysqli_query($conexion, $SqlEventos3);
                
                

?>
               
                <?php
                
                while($registro = mysqli_fetch_assoc($resulEventos3)) {
                ?>
                    <tr class="align-middle">
                        <td scope="row" data-label="nombre usuario"><?php echo $registro['nombre']; ?></td>
                        <td data-label="apellido"><?php echo $registro['apellido']; ?></td>
                        <td data-label="correo electronico"><?php echo $registro['correo_electronico']; ?></td>
                        <td data-label="contraseña" >.......</td>
                        <td data-label="Estado"><?php echo $registro['nombre_ciudad']; ?></td>
                        <td data-label="Actualizar">
                            <a type="button" data-bs-toggle="modal" data-bs-target="#actualizarevento_<?php echo $registro['id_usuario']; ?>" data-id="<?php echo $registro['id_usuario']; ?>">
                                <i class="bi-pencil px-1" style="font-size: 2rem; color:green;"></i>
                                
                            </a>
                        </td>
                        <td data-label="Borrar"> <a href="deleteEvento.php?id=<?php echo $registro['id_usuario']; ?>"><i class="bi-trash px-1" style="font-size: 2rem; color:red;"></i> </a></td>  
                       
                        
         
                        <?php  

include('modalUpdateEvento.php');


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
