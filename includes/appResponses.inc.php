<?php
// array de salida
$appResponse = array(
	"respuesta" => false,
	"mensaje" => "Error en la aplicación",
	"contenido" => ""
);

// Verificamos las variables post y que exista la variable accion
if(isset($_POST) && !empty($_POST) && isset($_POST['accion'])){

	switch ($_POST['accion']) {
	case 'login':
		$appResponse = array(
			"respuesta" => true,
			"mensaje" => "Ejecución de AJAX Satisfactoria",
			"contenido" => ""
		);
	break;
	
	default:
		$appResponse['mensaje'] = "Opción no disponible";
	break;
	}
}
else{
	$appResponse['mensaje'] = "Variables no definidas";
}

// Retorno de JSON
echo json_encode($appResponse);

?>