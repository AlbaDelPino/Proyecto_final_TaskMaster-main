<?php 
	/* Desarrollado por: PROGRAMANDO BROTHERS 	
	Suscribete a : https://www.youtube.com/ProgramandoBrothers y comparte los vídeos.
	Recuerda: "EL CONOCIMIENTO SE COMPARTE, POR MÁS POCO QUE SEA".gg
	*/
	session_start();
	
	$_SESSION['usuario'] = array();
	
	// remove all session variables
	session_unset();

	// destroy the session
	session_destroy();
	
	
	header("Location: index.php");
 ?>
 <br>
