<?php
// Funciones principales

// Función para inicializar twig

function inicializaTwig($root){
	// Incluimos Twig Auto Loader
	require($root .'php_libs/Twig/Autoloader.php');
	Twig_Autoloader::register();

	// Definimos la ruta donde estarán nuestros templates
	$loader = new Twig_Loader_Filesystem($root.'views');

	// Inicializamos twig
	$twig = new Twig_Environment($loader);
}
?>