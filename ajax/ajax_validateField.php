<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/inc/start-ajax.php";
$response = array();
// Acceden unicamente los SuperAdmins y Admins
if( !isset($_SESSION['rol']) )
{
    $response['result'] = "Error, no tiene permiso para acceder a este área.";
    die();
}

$datos = $_POST['values'];
$form_accion = (isset($datos['form_accion']))?$datos['form_accion']:'';
$table = (isset($datos['table']))?$datos['table']:'';
$column = (isset($datos['column']))?$datos['column']:'';
$valorCampo = (isset($datos['valorCampo']))?$datos['valorCampo']:'';

$valorCampo = mysqli_real_escape_string($mysqli, $valorCampo);
$table = mysqli_real_escape_string($mysqli, $table);
$column = mysqli_real_escape_string($mysqli, $column);

if( $form_accion == 'checkField')
{
    if( $stmt = $mysqli->prepare("SELECT * FROM ".$table." WHERE ".$column." = ? ") )
	{
		$stmt->bind_param('s', $valorCampo);
		$stmt->execute();
		$resultArray = get_result($stmt);
		//Si hay resultados, el campo ya existe
        if( count($resultArray) > 0 )
        {
            $response['result'] = 'Ko';
            $response['resultMessage'] = 'El campo ya existe.';
        }
        else
        {
            $response['result'] = 'Ok';
        }
		$stmt->free_result();
		$stmt->close();
	}
	else
	{
		$response['result'] = $mysqli->error;
	}
}
else
{
	$response['result'] = "Error, Función no reconocida.";
    $response['resultMessage'] = $datos;
    $response['resultMessage2'] = $table;
    $response['resultMessage3'] = $column;
}

echo json_encode($response);
die();
?>