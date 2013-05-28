<?php
session_name('demoUI');
session_start();

// Directorio Raíz de la app
// Es utilizado en templateEngine.inc.php
$root = '';

if(!empty($_SESSION) && $_SESSION['userLogin'] == true){
	// Incluimos el template engine
	include('includes/templateEngine.inc.php');

	// Cargamos la plantilla
	$twig->display('layout_catalogo.html',array(
		"userName" => $_SESSION['userNombre'],
		"userID" => $_SESSION['userID']
	));
}
else{
	header("Location:login.php");
}

	

?>