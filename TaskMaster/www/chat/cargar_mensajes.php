<?php
include "../login/conexion.php";
mysqli_select_db($conexion, "practicas");
session_start();

// Verificar si el usuario ha iniciado sesión correctamente
if (!isset($_SESSION['id_usuario']) || empty($_SESSION['id_usuario'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header("Location: ../login/index.php");
    exit; // Detener la ejecución del script después de la redirección
}
include('../conexion/config.php');
$id_evento = $_GET['id'];
$SqlEventos3 = "SELECT * FROM eventoscalendar e LEFT JOIN chat c ON e.id = c.id_evento INNER JOIN usuario u ON c.id_usuario = u.id_usuario WHERE c.id_evento = $id_evento ORDER BY fecha_envio DESC";
$resulEventos3 = mysqli_query($con, $SqlEventos3);
$id_usuario = $_SESSION['id_usuario'];


while($registro4 = mysqli_fetch_assoc($resulEventos3)) {
    $nombre_compartir = $registro4['id_usuario'];
    if($nombre_compartir == $id_usuario) {
?>
<article class="mensaje me">
<h6>Yo</h6>

<div>
    <p><?php echo $registro4['mensaje']; ?></p>
    <img src="../<?php echo $registro4['imagen']; ?>" alt="j">
    <a href="deletechat.php?id=<?= $registro4['id_chat']; ?>">
        <i class="bi-trash px-1" style="font-size: 2rem; color:red;"></i> 
    </a>
</div>
</article>
<?php
// echo $id_usuario ;
include('modalchat.php');
?>
<?php
    } else {
?> 
<article class="mensaje">

<h6><?php echo $registro4['nombre']; ?></h6>
<div>
    <img src="../<?php echo $registro4['imagen']; ?>" alt="j">
    <p><?php echo $registro4['mensaje']; ?></p>
</div>
 
</article>
<?php
    }
}
?>
