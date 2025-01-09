<?php include('../header.php'); ?>
<section class="principal-perfil">
<?php
 $id_usuario = $_SESSION['id_usuario'];
                include('../conexion/config.php');
                $sql2 = "SELECT * FROM usuario where id_usuario='$id_usuario' ";
                $res2 = mysqli_query($conn, $sql2);
                $fila = mysqli_fetch_assoc($res2);
                $usuario = $fila['nombre'];
                if ($usuario == "admin"){
                  $SqlEventos2   = "SELECT * FROM usuario WHERE id_usuario= $id_usuario";
                  $resulEventos2 = mysqli_query($conn, $SqlEventos2);
                  $registro2 = mysqli_fetch_assoc($resulEventos2);
                }
                else{
                  $SqlEventos2   = "SELECT * FROM usuario us 
                  inner join ciudad ci 
                  on ci.id_ciudad= us.ciudad  WHERE us.id_usuario= $id_usuario";
                  $resulEventos2 = mysqli_query($conn, $SqlEventos2);
                
                  $registro2 = mysqli_fetch_assoc($resulEventos2);
                }
               
               
               
?>
<div class="imagen">
<?php 
echo "<img src='../{$registro2['imagen']}' alt='Imagen de producto'>"; 

?>
  <button type="button"data-bs-toggle="modal" data-bs-target="#imagen_<?php echo $registro2['id_usuario']; ?>" data-id="<?php echo $registro2['id_usuario']; ?>">
  Cambiar imagen
</button>
</div>
<div class="datos"> 
<?php 
if($usuario == "admin"){

?>
<p><br>Nombre: <br><?php echo$registro2['nombre'] ; ?></p>
<p>Apellido: <?php echo$registro2['apellido'] ; ?></p>
<p>Correo electronico: <?php echo$registro2['correo_electronico'] ; ?></p>
<p>Contraseña: ....</p>
<?php 
}else{

?>
<p>Nombre: <?php echo$registro2['nombre'] ; ?></p>
<p>Apellido: <?php echo$registro2['apellido'] ; ?></p>
<p>Ciudad: <?php echo$registro2['nombre_ciudad'] ; ?></p>
<p>Correo electronico: <?php echo$registro2['correo_electronico'] ; ?></p>
<p>Contraseña: ....</p>
<?php 
}

?>
    <button type="button"data-bs-toggle="modal" data-bs-target="#perfil_<?php echo $registro2['id_usuario']; ?>" data-id="<?php echo $registro2['id_usuario']; ?>">
  Cambiar datos del perfil
</button>
</div>

<?php
// echo $id_usuario ;
include('modalimagen.php');
include('modalperfil.php');

?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</section>