<?php

require '../core/configGeneral.php';

$to  			= (!empty($_REQUEST['to'])) ? $_REQUEST['to'] : 'paulsandoval77@hotmail.com';
$subject 		= (!empty($_REQUEST['subject'])) ? $_REQUEST['subject'] : 'Envio de correo';
$template 		= (!empty($_REQUEST['template'])) ? $_REQUEST['template'] : 'mail_template';

/* Obtener datos del usuario */
$dataUser 		= json_decode($_REQUEST['dataUser']);

$user_name 		= (!empty($dataUser->USU_NOMBRES)) ? $dataUser->USU_NOMBRES : '';
$user_last_name = (!empty($dataUser->USU_APELLIDOS)) ? $dataUser->USU_APELLIDOS : '';
$user_random 	= (!empty($dataUser->USU_RANDOM)) ? $dataUser->USU_RANDOM : '';
$url_recovery 	= (!empty($_REQUEST['url_recovery'])) ? $_REQUEST['url_recovery'] : '#';

/*
var_export($dataUser); 
var_export($_REQUEST); 
die('aqui');
*/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require ABSPATH . 'plugins/vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();    
    			
	// Habilitando SMTP debugging
	// 0 = apagado (para producción)
	// 1 = mensajes del cliente
	// 2 = mensajes del cliente y servidor
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;

	// Agregando compatibilidad con HTML
	$mail->Debugoutput = 'html';
    			
	// Para utilizar la autenticación SMTP
	$mail->SMTPAuth = true;
	
	// Estableciendo el nombre del servidor de email
	$mail->Host = 'smtp.gmail.com';
	
	// Estableciendo el puerto
	$mail->Port = 587;
	
	// Estableciendo el sistema de encriptación
	$mail->SMTPSecure = 'tls';
	
	// Nombre de usuario para la autenticación SMTP - usar email completo para gmail
	$mail->Username = 'paulsandoval44@gmail.com';
	
	// Password para la autenticación SMTP
	$mail->Password = 'polo1234567';
  
	// Estableciendo como quién se va a enviar el mail
	$mail->setFrom('paulsandoval44@gmail.com', NOMBRE_PROYECTO);

    // Introduzca la dirección de la que debe responder. El segundo parámetro opcional para esta función es el nombre que se mostrará para responder
	$mail->addReplyTo('paulsandoval44@gmail.com', NOMBRE_PROYECTO);

	// Estableciendo a quién se va a enviar el mail
    $mail->addAddress($to);

	$message = file_get_contents( ABSPATH . 'views/email_templates/' . $template . '.html');
    
	$message = str_replace('{title}', NOMBRE_PROYECTO , $message);
	$message = str_replace('{logo}', 'img/logo-azul.png' , $message);
	$message = str_replace('{user_name}', $user_name , $message);
	$message = str_replace('{user_last_name}', $user_last_name , $message);
	$message = str_replace('{user_random}', $user_random , $message);
	$message = str_replace('{url_recovery}', $url_recovery , $message);
	$message = str_replace('{email_to}', $$to , $message);
	
	// Establecer el formato de correo electrónico en HTML
	$mail->isHTML(true);

	// parametro 1: Cadena de mensaje HTML 		parametro 2: Ruta absoluta a un directorio base para anteponer rutas relativas a imágenes
    $mail->msgHTML($message, ABSPATH . 'views/email_templates/');

    //Content
    $mail->Subject = $subject;
	$mail->CharSet = PHPMailer::CHARSET_UTF8;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";


} catch (Exception $e) {
    echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (\Exception $e) { //The leading slash means the Global PHP Exception class will be caught
    echo $e->getMessage(); //Boring error messages from anything else!
}
 