<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/inc/start-ajax.php";

$response = array();

// Filtramos según Sesion Activa
if( $_SESSION['rol'] == 'Administrador' )
{
	$arrayTablasPermitidas = array(
		'Administrador',
	);
}
else if( $_SESSION['rol'] == 'Persona' )
{
	$arrayTablasPermitidas = array(
		'Persona',
	);
}
else
{
	$response['result'] = "Ko";
	$response['error'] = "Error, no tiene permiso para acceder a este área. Rol:" . $_SESSION['rol'];
	$response['rol'] = $_SESSION['rol'];
	echo json_encode($response);
	die();
}

if( !in_array($_POST['Elem'], $arrayTablasPermitidas) )
{
	$response['result'] = "Ko";
	$response['error'] = "Error, no tiene permiso para acceder a esta sección.";
	echo json_encode($response);
	die();
}

$Elem = (isset($_POST['Elem']))?$_POST['Elem']:'';
$IdElem = (isset($_POST['IdElem']))?$_POST['IdElem']:'';

$Elem = preg_replace("/[^a-záéíóúA-Z0-9]+/", "", $Elem);

if( $Elem == "" || $IdElem == "" )
	die();

if( $stmt = $mysqli->prepare("SELECT * FROM $Elem WHERE Id$Elem = ?") )
{
	$stmt->bind_param('i',$IdElem);
	$stmt->execute();
	$resultArray = get_result($stmt);
	if( $fila = array_shift( $resultArray ) )
	{
		// Eliminamos la posibilidad de obtener hashes
		if( isset($fila['hashPass']) ) unset( $fila['hashPass'] );
		$response = $fila;
	}
	$stmt->free_result();
	$stmt->close();
}

echo json_encode($response);

?>