<?php
session_name('demoUI');
session_start();


// array de salida
$appResponse = array(
	"respuesta" => false,
	"mensaje" => "Error en la aplicación",
	"contenido" => ""
);

// Verificamos las variables post y que exista la variable accion
if(isset($_POST) && !empty($_POST) && isset($_POST['accion'])){

	// incluimos el archivo de funciones y conexión a la base de datos
	include('mainFunctions.inc.php');

	if($errorDbConexion == false){

		switch ($_POST['accion']) {
		case 'login':
			
			$appResponse['respuesta'] = userLogin($_POST,$mysqli);
			$appResponse['mensaje'] = "Usuario Encontrado";

		break;
		
		default:
			$appResponse['mensaje'] = "Opción no disponible";
		break;
		}

	}else{
		$appResponse['mensaje'] = "Error al conectar con la base de datos";
	}
		
}
else{
	$appResponse['mensaje'] = "Variables no definidas";
}

// Retorno de JSON
echo json_encode($appResponse);

?>