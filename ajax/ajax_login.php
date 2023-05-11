<?php
session_start();

require_once("../_BBDD_Connect.php");
require_once("../inc/functionsBackoffice.php");

$login = $_POST['login'];
$pass = $_POST['pass'];

if( $stmt = $mysqli->prepare("SELECT * FROM Persona WHERE login = ?") )
{
	$stmt->bind_param("s",$login);
	$stmt->execute();
	$resultArray = get_result($stmt);
	$row = array_shift( $resultArray );
	$stmt->free_result();
	$stmt->close();
	
	if( isset($row) )
	{
		if( password_verify($pass,$row['hashPass']) )
		{
			$_SESSION['rol'] = 'Persona';
			$_SESSION['Id'] = $row['IdPersona'];
			$_SESSION['nombre'] = $row['nombre'];
			// $_SESSION['estadoCuenta'] = FB_CheckEstadoCuenta( $row['IdPersona'] );
			
			$response['result'] = "Ok";
			$response['textResult'] = "Accediendo...";
			// if( $_SESSION['estadoCuenta'] == 0 )
			// 	$response['goTo'] = "index_persona.php";
			// else if ($_SESSION['estadoCuenta'] == 4)
			// 	$response['goTo'] = "cliente_error.php";	
			// else
			// $response['goTo'] = "misFacturas.php?type=1";
			
			$IdPersona = $row['IdPersona'];
			if( $mysqli->query("UPDATE Persona SET fechaUltimoAcceso = NOW() WHERE IdPersona = $IdPersona") !== true )
				$response['errorActualizacion'] = $mysqli->error;
			
			$r_tipo = 'Acceso';
			$r_contenido = json_encode( array('Cuenta' => 'Persona','Id' => $row['IdPersona'],'Nombre' => $row['nombre']) );
			$response['resultRegistro'] = FB_RegistrarAccion( $r_tipo, $r_contenido, '' );
			
			echo json_encode($response);
			die();
		}
	}
}

if( $stmt = $mysqli->prepare("SELECT * FROM Administrador WHERE login = ?") )
{
	$stmt->bind_param("s",$login);
	$stmt->execute();
	$resultArray = get_result($stmt);
	$row = array_shift( $resultArray );
	$stmt->free_result();
	$stmt->close();
	
	if( isset($row) )
	{
		if( password_verify($pass,$row['hashPass']) )
		{
			$_SESSION['rol'] = 'Administrador';
			$_SESSION['Id'] = $row['IdAdministrador'];
			$_SESSION['nombre'] = $row['nombre'];
			
			$response['result'] = "Ok";
			$response['textResult'] = "Accediendo...";
			$response['goTo'] = "index.php";
			
			$IdAdministrador = $row['IdAdministrador'];
			if( $mysqli->query("UPDATE Administrador SET fechaUltimoAcceso = NOW() WHERE IdAdministrador = $IdAdministrador") !== true )
				$response['errorActualizacion'] = $mysqli->error;
			
			$r_tipo = 'Acceso';
			$r_contenido = json_encode( array('Cuenta' => 'Administrador','Id' => $row['IdAdministrador'],'Nombre' => $row['nombre']) );
			$response['resultRegistro'] = FB_RegistrarAccion( $r_tipo, $r_contenido, '' );
			
			echo json_encode($response);
			die();
		}
	}
}

$response['result'] = "Ko";
$response['textResult'] = "Usuario y/o Contraseña incorrectos";

echo json_encode($response);
die();
