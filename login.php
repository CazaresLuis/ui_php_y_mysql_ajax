<?php
session_name('demoUI');
session_start();


// Directorio Raíz de la app
// Es utilizado en templateEngine.inc.php
$root = '';

// Incluimos el template engine
include('includes/templateEngine.inc.php');

$twig->display('layout_login.html');

?>