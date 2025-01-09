<?php
// Configuración de la conexión a la base de datos
$servidor = 'db';
$usuario = 'root';
$password = 'test';
$basededatos = 'practicas';

// Conexión a la base de datos
$con = mysqli_connect($servidor, $usuario, $password, $basededatos) or die("Error al conectar con la base de datos");

// Seleccionar la base de datos
$bd = mysqli_select_db($con, $basededatos) or die("Error al seleccionar la base de datos");
?>
