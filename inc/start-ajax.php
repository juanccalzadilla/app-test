<?php

// Sesión
if( !isset($_SESSION) )
	session_start();

if( !isset($_SESSION['rol']) )
{
	// Activar / desactivar control de usuarios
	$response['result'] = "Ko";
	$response['error'] = "Error de sesión";
	echo json_encode($response);
	die();
}

// Componentes
require_once $_SERVER['DOCUMENT_ROOT'] . "/_BBDD_Connect.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/inc/functionsBackoffice.php";

?>