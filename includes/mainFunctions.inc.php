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

// Función para verificar la existencia del correo electrónico en la tabla de usuarios
function verificaCorreo($data,$dbLink){
	// Bandera de logueo
	$response = false;

	// validar si hay datos en los parametros
	if(!empty($data) && !empty($dbLink)){

		$consulta = sprintf("SELECT * FROM tbl_users
							WHERE usr_email='%s' AND usr_activo=1
							LIMIT 1",
							trim($data));

		// Ejecutamos la cosnulta
		$respuesta = $dbLink -> query($consulta);

		// verificamos si es exitoso el login
		if($respuesta -> num_rows != 0){
			$response = true;
		}

	}

	return $response;
}

// Función para crear una cadena aleatoria
function creaPassword( $length = 10 )
{
	$key = "";
	$pattern = "abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789";

	for($i = 0 ; $i < $length ; $i++ )
	{
		$key .= $pattern[rand(0,53)];
	}

	return $key;
}


// Actualizar la contraseña del usuario en la tabla
function actualizaClave($data,$dbLink){
	$consulta = sprintf("UPDATE tbl_users SET 
						usr_pass='%s'
						WHERE usr_email='%s' LIMIT 1",
						md5($data['usr_pass']),$data['rec_correo']);
	// Ejecutamos la cosnulta
	$respuesta = $dbLink -> query($consulta);

	if($dbLink -> affected_rows == 1){
		return true;
	}
	else{
		return false;
	}
}

// función para realizar envío de correo electrónico
function mandaCorreo($mail,$data=''){

	$response = false;

	$destNombre = 'Recuperación de Contraseña';

	$body = '
		<div>
			<p></strong> su contraseña de acceso ha sido modificada </strong>, A continuación le indicamos como accesar al sistema.</p>
			<p><strong>DATOS DEL USUARIO</strong></p>
            <p><strong>Usuario: '. $data['rec_correo'] . '</p>
            <p><strong>Clave: '. $data['usr_pass'] . '</p>
		</div>
	';

	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host       = "mail.worldcargoexport.com"; // SMTP server
	// $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
	                                           // 1 = errors and messages
	                                           // 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->Host       = "mail.worldcargoexport.com"; // sets the SMTP server
	$mail->Port       = 26;                    // set the SMTP port for the GMAIL server
	$mail->Username   = "alertas-no-reply@worldcargoexport.com"; // SMTP account username
	$mail->Password   = "06107210";        // SMTP account password

	$mail->SetFrom('alertas-no-reply@worldcargoexport.com', '.:: Interfaz de Usuario ::.');

	$mail->AddReplyTo('alertas-no-reply@worldcargoexport.com', '.:: Interfaz de Usuario ::.');

	$mail->Subject    = utf8_decode(".:: Interfaz de Usuario ::. Recuperación de contraseña");

	$mail->AltBody    = "Para ver el mensaje, utilice un cliente de correo electrónico compatible con HTML!!!!"; // optional, comment out and test

	$mail->MsgHTML($body);

	$address = $data['rec_correo'];
	
	$mail->AddAddress($address, $destNombre);
	// $mail->AddBCC('luis.f.cazares@gmail.com','Luis Fernando Cázares');

	if($mail->Send()) {
	  $response = true;
	}

	return $response;
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