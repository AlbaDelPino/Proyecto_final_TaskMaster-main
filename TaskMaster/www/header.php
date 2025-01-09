<?php
include "login/conexion.php";
mysqli_select_db($conexion, "practicas");
session_start();

// Verificar si el usuario ha iniciado sesión correctamente
if (!isset($_SESSION['id_usuario']) || empty($_SESSION['id_usuario'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header("Location: ../login/index.php");
    exit; // Detener la ejecución del script después de la redirección
}

$id_usuario = $_SESSION['id_usuario'];

        // echo $id_evento;
        
        // Consulta SQL para obtener detalles del evento y el archivo asociado
        $SqlUsuario = "SELECT * FROM usuario WHERE id_usuario = $id_usuario";
        $resultUsuario = mysqli_query($conexion, $SqlUsuario);
        $datosUsuario = mysqli_fetch_assoc($resultUsuario);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mi Calendario:: Ing. Urian Viera</title>
    <link rel="stylesheet" type="text/css" href="../css/fullcalendar.min.css">
    <link rel="stylesheet" type="text/css" href="../css/estilo3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/estilo3.css" >
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/calendario.css">
</head>
<body class="body">
<header class="titulo"> 
    <div>
        <img src="../imagenes/logo2.png" alt="">
    <h1 >Gestor de Tareas</h1>
    </div>
    <a href="../perfil/perfil.php" role="button">
    <p><?php echo $datosUsuario['nombre'] ; ?></p>
                    
    </a>
    <a href="../cerrarSesion.php" role="button">
    
                    <i class="bi bi-box-arrow-right" style="font-size:2rem; color:#FA9E37;"></i>
    </a>
    
</header> 
<?php
include('login/config.php');
$SqlEventos   = "SELECT * FROM eventoscalendar ev 
inner join usuario_evento ue on ue.id_evento = ev.id
inner join usuario us on ue.id_usuario=us.id_usuario 
inner join estado es on es.id_estado=ev.id_estado 
inner join etiquetas et on et.id_etiqueta=ev.id_etiquetas 
inner join archivos ar on ev.id= ar.id_evento
where us.id_usuario = $id_usuario"; // Seleccionar solo eventos del usuario actual
$resulEventos = mysqli_query($conexion, $SqlEventos);
$sql2 = "SELECT * FROM usuario where id_usuario='$id_usuario' ";
                $res2 = mysqli_query($conn, $sql2);
                $fila = mysqli_fetch_assoc($res2);
                $usuario = $fila['nombre'];
?>
<main class="principal">
    <section class="enlaces">
        <ul>
            <li>
                <i class="bi bi-calendar3"> <a href="../calendario/calendario.php">Calendario</a></i>
            </li>
            <li>
                <i class="bi bi-calendar2-event"> <a href="../tarea/tareas.php">Tareas</a></i>
            </li>
            <li>        
                <i class="bi bi-card-list"> <a href="../listado/listado.php">Listado</a></i>
            </li>
            <li>
               <i class="bi bi-kanban"> <a href="../kanban/kanban.php">Kamban </a></i>
            </li>
            <li>
                <i class="bi bi-chat-dots"> <a href="../chat/chat.php">Chat</a></i>
            </li>
           
            <li>
                <i class="bi bi-person-fill-gear"> <a href="../perfil/perfil.php">Pefil</a></i>
            </li>
            <li>
            <?php
                    if ($usuario == "admin"){
            ?>
                <i class="bi bi-person-fill-gear"> <a href="../user/user.php">usuario</a></i>
                <?php
                    }
                ?>
            </li>
        </ul>
    </section>