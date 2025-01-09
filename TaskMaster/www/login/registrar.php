<?php 
	/* Desarrollado por: PROGRAMANDO BROTHERS 	
	Suscribete a : https://www.youtube.com/ProgramandoBrothers y comparte los vídeos.
	Recuerda: "EL CONOCIMIENTO SE COMPARTE, POR MÁS POCO QUE SEA".
	*/
	include_once('conexion.php');
	mysqli_select_db($conn, "practicas");

	$nombre = $_POST['nombre'];
	$ape = $_POST['apellido'];
	$correo = $_POST['correo'];
	$contra = $_POST['contra'];
	$ciudad = $_POST['ciudad'];
	

	$sql = "INSERT INTO usuario (nombre, apellido, correo_electronico, contraseña,ciudad,imagen) VALUES ('$nombre', '$ape', '$correo', '$contra','$ciudad','../imagenes/user_defecto.png');";
	$res = mysqli_query($conn,$sql);
	// echo $sql;
	if ( isset( $res ) )
    header( 'Location: ../index.php?no=1' );
	else
		echo "error";	

?>