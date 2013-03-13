<?php
session_name('demoUI');
session_start();


// array de salida
$appResponse = array(
	"respuesta" => false,
	"mensaje" => "Error en la aplicación",
	"contenido" => ""
);

$root = '../';

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

		case 'recuperaPass':
			// verificar variable de correo que no este vacía
			if(!empty($_POST['rec_correo'])){
				// Verificamos que exista la cuentad e correo electrónico en nuestra tabla de usuarios
				if(verificaCorreo($_POST['rec_correo'],$mysqli)){

					// Crear clave de acceso
					$_POST['usr_pass'] = creaPassword();

					// Actulizamos el password en la tabla
					if(actualizaClave($_POST,$mysqli)){
						// Enviamos por correo electrónico la clave

						// Cargamos e inicializamos el phpmailer
						require_once($root.'php_libs/PHPMailer_v5.1/class.phpmailer.php');

						// Creamos el objeto mail
						$mail = new PHPMailer();

						if(mandaCorreo($mail,$_POST)){

							$appResponse['respuesta'] = true;
							$appResponse['mensaje'] = "Se envió correctamente la clave de aceso";

						}else{
							$appResponse['mensaje'] = "Se creo correctamente la contraseña pero no se realizó el evnío de la misma por correo electrónico";
						}

					}
					else{
						$appResponse['mensaje'] = "No se puede actualziar la contraseña del usuario";
					}

				}
				else{
					$appResponse['mensaje'] = "Usuario no encontrado";
				}
			}
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