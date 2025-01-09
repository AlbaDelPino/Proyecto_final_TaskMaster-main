<?php
    /* Desarrollado por: PROGRAMANDO BROTHERS 	
    Suscribete a : https://www.youtube.com/ProgramandoBrothers y comparte los vídeos.
    Recuerda: "EL CONOCIMIENTO SE COMPARTE, POR MÁS POCO QUE SEA".
    */
    include_once('conexion.php');
    mysqli_select_db($conn, "practicas");
    $usuario = $_POST['usuario'];
    $contra = $_POST['contra'];

    $sql = "SELECT COUNT(*) FROM usuario WHERE (nombre COLLATE utf8mb4_bin ='$usuario' AND contraseña COLLATE utf8mb4_bin ='$contra')";

    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($res);

    $sql2 = "SELECT id_usuario FROM usuario where nombre='$usuario' ";
    $res2 = mysqli_query($conn, $sql2);
    $fila = mysqli_fetch_assoc($res2);
    $id_usuario = $fila['id_usuario'];

    if ($row[0] > 0) {
        session_start();
        $_SESSION['id_usuario'] = $id_usuario;
        header('Location: ../calendario/calendario.php?no=1');
       
	
        exit(); // Asegura que se detenga la ejecución después de la redirección
    } else {
        header('Location: ../index.php');
        exit(); // Asegura que se detenga la ejecución después de la redirección
    }
?>
