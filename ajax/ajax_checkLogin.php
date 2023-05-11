<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/inc/start-ajax.php";

$response = array();

// Acceden unicamente los Admins
if( !($_SESSION['rol'] == 'AdministradorTotal') )
{
	$response['result'] = "Error, no tiene permiso para acceder a este área.";
	die();
}

$datos = $_POST['values'];

$form_accion = (isset($datos['form_accion']))?$datos['form_accion']:'';

if( $form_accion == 'checkLogin' )
{
	$login = $datos['login'];
	
	if( $stmt = $mysqli->prepare("SELECT IdAdministrador FROM Administrador WHERE login = ?") )
	{
		$stmt->bind_param("s",$login);
		$stmt->execute();
		$resultArray = get_result($stmt);
		if( $fila = array_shift( $resultArray ) )
		{
			$response['result'] = 'Ko';
			$response['resultMessage'] = 'Login existente';
			
			echo json_encode($response);
			die();
		}
		$stmt->free_result();
		$stmt->close();
	}
	else
	{
		$response['result'] = $mysqli->error;
	}
	
	
	if( $stmt = $mysqli->prepare("SELECT IdPersona FROM Persona WHERE login = ?") )
	{
		$stmt->bind_param("s",$login);
		$stmt->execute();
		$resultArray = get_result($stmt);
		if( $fila = array_shift( $resultArray ) )
		{
			$response['result'] = 'Ko';
			$response['resultMessage'] = 'Login existente';
			
			echo json_encode($response);
			die();
		}
		$stmt->free_result();
		$stmt->close();
	}
	else
	{
		$response['result'] = $mysqli->error;
	}
	
	$response['result'] = 'Ok';
}
else if( $form_accion == 'checkMail' )
{
	$mail = $datos['mail'];
	
	if( $stmt = $mysqli->prepare("SELECT IdAdministrador FROM Administrador WHERE mail = ?") )
	{
		$stmt->bind_param("s",$mail);
		$stmt->execute();
		$resultArray = get_result($stmt);
		if( $fila = array_shift( $resultArray ) )
		{
			$response['result'] = 'Ko';
			$response['resultMessage'] = 'Login existente';
			
			echo json_encode($response);
			die();
		}
		$stmt->free_result();
		$stmt->close();
	}
	else
	{
		$response['result'] = $mysqli->error;
	}
	
	if( $stmt = $mysqli->prepare("SELECT IdPersona FROM Persona WHERE mail = ?") )
	{
		$stmt->bind_param("s",$mail);
		$stmt->execute();
		$resultArray = get_result($stmt);
		if( $fila = array_shift( $resultArray ) )
		{
			$response['result'] = 'Ko';
			$response['resultMessage'] = 'Login existente';
			
			echo json_encode($response);
			die();
		}
		$stmt->free_result();
		$stmt->close();
	}
	else
	{
		$response['result'] = $mysqli->error;
	}
	
	$response['result'] = 'Ok';
}
else
{
	$response['result'] = "Error, Función no reconocida.";
}

echo json_encode($response);
die();
?>