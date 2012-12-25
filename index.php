<?php
session_name('demoUI');
session_start();

// Directorio Raíz de la app
// Es utilizado en templateEngine.inc.php
$root = '';

if(!empty($_SESSION)){
	// Incluimos el template engine
	include('includes/templateEngine.inc.php');

	// Cargamos la plantilla
	$twig->display('layout_index.html');
}
else{
	header("Location:login.php");
}

	

?>