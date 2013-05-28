<?php
session_name('demoUI');
session_start();


// Vaciamos las variables de sesión
if(!empty($_SESSION)){
	$_SESSION = array();
	session_destroy();
}

header("Location:index.php");

?>