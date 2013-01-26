<?php

// Constantes conexión con la base de datos
define("server", 'localhost');
define("user", 'tutosWeb');
define("pass", 'YxAp8DmthQnC5NWp');
define("mainDataBase", 'tutosWeb');

// Variable que indica el status de la conexión a la base de datos
$errorDbConexion = false;

function userLogin($data,$dbLink){
	// Bandera de logueo
	$respuestaLogin = false;

	// validar si hay datos en los parametros
	if(!empty($data) && !empty($dbLink)){

		$consulta = sprintf("SELECT * FROM tbl_users
							WHERE usr_email='%s' AND usr_pass='%s' AND usr_activo=1
							LIMIT 1",
							trim($data['usr_email']),md5(trim($data['usr_pass'])));

		// Ejecutamos la cosnulta
		$respuesta = $dbLink -> query($consulta);

		// verificamos si es exitoso el login
		if($respuesta -> num_rows != 0){

			$userData = $respuesta -> fetch_assoc();

			$respuestaLogin = true;

			$_SESSION['userLogin'] = true;
			$_SESSION['userNombre'] = $userData['usr_nombre'].' '.$userData['usr_apellidos'];
			$_SESSION['userID'] = $userData['idUsuario'];
		}

	}

	return $respuestaLogin;
}

// Verificar constantes para conexión al servidor
if(defined('server') && defined('user') && defined('pass') && defined('mainDataBase'))
{
	// Conexión con la base de datos
	
	$mysqli = new mysqli(server, user, pass, mainDataBase);
	
	// Verificamos si hay error al conectar
	if (mysqli_connect_error()) {
	    $errorDbConexion = true;
	}
	else{
		// Evitando problemas con acentos
		$mysqli -> query('SET NAMES "utf8"');
	}
	
}


?>