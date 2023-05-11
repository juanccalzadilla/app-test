<?php

session_start();

require_once("../_BBDD_Connect.php");

$accion = $_POST['accion'];

if( $accion == 'EnvioMail' )
{
	function EnviarMensaje( $in_cuenta, $in_token )
	{
		global $mailing_NameFrom;
		global $mailing_MailFrom;
		global $global_urlAcademia;
		
		$nombreFrom = $mailing_NameFrom;
		$mailFrom = $mailing_MailFrom;
		$mailReply = $mailing_MailFrom;
		$subject = 'Solicitud de restablecimiento de cotnraseña';
		
		$direccionMail = $in_cuenta['mail']; // El correo del destinatario
		$tokenReset = $in_token; // La clave de seguridad
		$tipoCuenta = $in_cuenta['tipo']; // El tipo del destinatario
		
		// carriage return type (RFC)
		$eol = "\r\n";
		
		// main header
		$headers = "From: " . $nombreFrom . "<" . $mailFrom . ">" . $eol;
		$headers .= "Reply-To: <" . $mailReply . ">" . $eol;
		$headers .= "MIME-Version: 1.0" . $eol;
		$headers .= "Content-type: text/html; charset=UTF-8" . $eol;
		
		$message = <<<EOT
		<!DOCTYPE html>
		<html>
			<head>
				<title></title>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<meta http-equiv="X-UA-Compatible" content="IE=edge" />
				<style type="text/css">
				/* FONTS */
				@import url('https://fonts.googleapis.com/css?family=Lato&display=swap');
				/* CLIENT-SPECIFIC STYLES */
				body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
				table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
				img { -ms-interpolation-mode: bicubic; }
				/* RESET STYLES */
				img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
				table { border-collapse: collapse !important; }
				body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }
				/* MEDIA QUERIES */
				@media screen and (max-width: 480px) {
					.mobile-hide { display: none !important; }
					.mobile-center { text-align: center !important; }
				}
				div[style*="margin: 16px 0;"] { margin: 0 !important; }
				</style>
			</head>
			<body style="margin: 0 !important; padding: 0 !important; background-color: #eeeeee;" bgcolor="#eeeeee">
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td align="center" style="background-color: #eeeeee;" bgcolor="#eeeeee">
							<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
								<tr>
									<td align="center" style="padding: 35px 35px 20px 35px; background-color: #ffffff;" bgcolor="#ffffff">
									<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
										<tr>
											<td align="left" style="font-family: 'Lato', sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;">
												<font face="'Lato', sans-serif;">
												<p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;">
												   Estimado cliente,
												</p>
												<p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;">
													A través del siguiente enlace puede establecer una <strong>nueva contraseña</strong> para el acceso a nuestro gestor on-line.
												</p>
												
												<a href="{$global_urlAcademia}/restablecer.php?mail={$direccionMail}&tipo={$tipoCuenta}&tokenReset={$tokenReset}">Restablecer Contraseña</a>
												
												<p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;">
												   En caso de que no funcione el enlace, por favor, copie la siguiente dirección URL e introdúzcala en la barra de direcciones de su navegador.
												</p>
												</font>
												<p style="font-size: 16px; font-weight: 400;">
													{$global_urlAcademia}/restablecer.php?mail={$direccionMail}&tokenReset={$tokenReset}
												</p>
												<font face="'Lato', sans-serif;">
												<p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;">
												   Atentamente,
												</p>
												<p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;">
													&nbsp &nbsp &nbsp &nbsp &nbsp EL EQUIPO DE EFDI
												</p>
												</font>
											</td>
										</tr>
									</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</body>
		</html>
EOT;
	
		return( mail($direccionMail, $subject, $message, $headers) );
	}
	
	function BuscarCuentaMail( $in_tabla, $in_mail )
	{
		global $mysqli;
		
		if( $stmt = $mysqli->prepare("SELECT * FROM $in_tabla WHERE mail = ?") )
		{
			$stmt->bind_param('s',$in_mail);
			$stmt->execute();
			$resultArray = get_result($stmt);
			$row = array_shift( $resultArray );
			$stmt->free_result();
			$stmt->close();
			
			if( isset($row) )
			{
				$resultado = array(
					"tipo" => $in_tabla,
					"mail" => $in_mail,
					"Id" => $row['Id'.$in_tabla]
				);
				return $resultado;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
		
	}
	
	$mail = $_POST['mail'];
	
	// Buscamos el tipo de cuenta
	$cuenta = BuscarCuentaMail( 'Administrador', $mail );
	if( !isset($cuenta['Id']) )
		$cuenta = BuscarCuentaMail( 'Profesor', $mail );
	
	if( !isset($cuenta['Id']) )
		$cuenta = BuscarCuentaMail( 'Director', $mail );
	
	if( !isset($cuenta['Id']) )
		$cuenta = BuscarCuentaMail( 'Alumno', $mail );
	
	if( !isset($cuenta['Id']) )
	{
		$response['result'] = "Ko";
		$response['textResult'] = "Por favor, revise los datos e inténtelo de nuevo más tarde.";

		echo json_encode($response);
		die();
	}
	
	// Generamos un hash
	$tokenReset = hash('tiger192,3', Date('s') . '3|=!)I_/\CaD3m' . Date('Y-m-d H_i_s'));
	
	// Guardamos el hash en la cuenta
	if( $stmt = $mysqli->prepare("UPDATE " . $cuenta['tipo'] . " SET tokenReset = '$tokenReset', fechaHoraReset = NOW() WHERE mail = ?") )
	{
		$stmt->bind_param("s",$mail);
		$stmt->execute();
	}
	else
	{
		$response['result'] = "Ko";
		$response['textResult'] = "Ha habido un error. Por favor, inténtelo de nuevo más tarde.";
		$response['errorSetTokenReset'] = $mysqli->error;
		echo json_encode($response);
		die();
	}
	
	// Enviamos el mensaje
	$resultadoEnvio = EnviarMensaje( $cuenta, $tokenReset );
	
	if( isset($resultadoEnvio['errorEnvio']) )
	{
		$response['errorEnvio'] = $resultadoEnvio['errorEnvio'];
		$response['textResult'] = "Ha habido un al enviar el e-mail. Por favor, inténtelo de nuevo más tarde.";
		echo json_encode($response);
		die();
	}
	
	// Registramos la acción
	$contenido = json_encode( array('E-Mail' => $mail,'Tipo Cuenta' => $cuenta['tipo'],'IP' => $_SERVER['REMOTE_ADDR'],'Proxy' => (isset($_SERVER['HTTP_X_FORWARDED_FOR']))?$_SERVER['HTTP_X_FORWARDED_FOR']:'') );
	if( $stmt = $mysqli->prepare("INSERT INTO Registro (fechaHora, tipo, contenido) VALUES ( NOW(), 'Solicitud Restablecer Contraseña', ? )") )
	{
		$stmt->bind_param("s",$contenido);
		$stmt->execute();
		$response['textResult'] = "E-Mail enviado. Por favor, revise su bandeja de entrada.";
		$response['result'] = "Ok";
	}
	else
	{
		$response['errorRegistro'] = $mysqli->error;
		$response['textResult'] = "Ha habido un error. Por favor, inténtelo de nuevo más tarde.";
		$response['result'] = "Ko";
	}
	
	// Devolvemos el resultado
	echo json_encode($response);
	die();
}
else if( $accion == 'Restablecer' )
{
	$accion = $_POST['accion'];
	$mail = $_POST['mail'];
	$token = $_POST['token'];
	$tipo = $_POST['tipo'];
	$pass = $_POST['pass'];
	
	if( $tipo != "Administrador" && $tipo != "Persona" )
	{
		echo "Error";
		die();
	}
	
	if( $token != "" )
	{
		if( $stmt = $mysqli->prepare("SELECT * FROM $tipo WHERE mail = ?") )
		{
			$stmt->bind_param("s",$mail);
			$stmt->execute();
			$resultArray = get_result($stmt);
			$row = array_shift( $resultArray );
			$stmt->close();
			
			if( isset($row) )
			{
				if( time() - strtotime($row['fechaHoraReset']) < 3601 )
				{
					if( $token == $row['tokenReset'] )
					{
						$hashPass = password_hash( $pass, PASSWORD_DEFAULT, [ 'cost' => 10 ] );
						
						if( $mysqli->query("UPDATE $tipo SET hashPass = '$hashPass', tokenReset = '' WHERE Id$tipo = " . $row['Id'.$tipo]) )
						{
							$contenido = json_encode( array('E-Mail' => $mail,'Tipo Cuenta' => $tipo,'IP' => $_SERVER['REMOTE_ADDR'],'Proxy' => (isset($_SERVER['HTTP_X_FORWARDED_FOR']))?$_SERVER['HTTP_X_FORWARDED_FOR']:'' ) );
							if( $stmt = $mysqli->prepare("INSERT INTO Registro (fechaHora, tipo, contenido) VALUES ( NOW(), 'Restablecicimiento de Contraseña', ? )") )
							{
								$stmt->bind_param("s",$contenido);
								$stmt->execute();
							}
							else
								$response['errorRegistro'] = $mysqli->error;
							
							$response['textResult'] = "Contraseña restablecida correctamente.";
							$response['result'] = "Ok";
						}
						else
						{
							$response['textResult'] = "Ha habido un error restableciendo la contraseña. Por favor, restablezca la conrtaseña de nuevo.";
							$response['result'] = "Ko";
						}
					}
					else
					{
						$response['textResult'] = "Ha habido un error con el enlace. Por favor, restablezca la conrtaseña de nuevo.";
						$response['result'] = "Ko";
					}
				}
				else
				{
					$response['textResult'] = "El enlace ha expirado. Por favor, restablezca la conrtaseña de nuevo.";
					$response['result'] = "Ko";
				}
				
				echo json_encode($response);
				die();
			}
		}
	}
	
	$response['result'] = "Ko";
	$response['textResult'] = "Ha habido un error. Por favor, inténtelo de nuevo más tarde.";
	echo json_encode($response);
	die();
}
else
{
	$response['result'] = "Ko";
	$response['textResult'] = "Ha habido un error. Por favor, inténtelo de nuevo más tarde.";

	echo json_encode($response);
	die();
}
?>