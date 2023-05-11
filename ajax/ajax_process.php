<?php


use PHPMailer\PHPMailer\PHPMailer;

require '../inc/PHPMailer-6.6.0/src/Exception.php';
require '../inc/PHPMailer-6.6.0/src/PHPMailer.php';
require '../inc/PHPMailer-6.6.0/src/SMTP.php';

require_once $_SERVER['DOCUMENT_ROOT'] . "/academia/inc/start-ajax.php";

$response = array();

// Filtramos según Sesion Activa
if( $_SESSION['rol'] == 'Administrador' )
{
	$arrayAccionesPermitidas = array(
		'crear_Administrador',
	);
}
else if( $_SESSION['rol'] == 'Persona' )
{
	$arrayAccionesPermitidas = array(
		'crear_Examen',
	);
}
else
{
	$response['result'] = "Ko";
	$response['error'] = "Error, no tiene permiso para acceder a este área.";
	echo json_encode($response);
	die();
}

$datos = $_POST['values'];

$form_accion = (isset($datos['form_accion']))?$datos['form_accion']:'';
$form_elemento = (isset($datos['form_elemento']))?$datos['form_elemento']:'';
$form_IdElemento = (isset($datos['form_IdElemento']))?$datos['form_IdElemento']:'';

unset($datos['form_accion']);
unset($datos['form_elemento']);
unset($datos['form_IdElemento']);
unset($datos['btn_submit']);


if( !in_array($form_accion . '_' . $form_elemento, $arrayAccionesPermitidas) )
{
	$response['result'] = "Ko";
	$response['error'] = "Error, no tiene permiso para acceder a esta sección.";
	
	echo json_encode($response);
	die();
}

if( isset($datos['pass']) )
{
	if( $datos['pass'] != '' )
		$datos['hashPass'] = password_hash( $datos['pass'], PASSWORD_ARGON2I, [ 'cost' => 10 ] );
	
	unset($datos['pass']);
}

foreach( $_POST['values'] as $clave => $valor) {
	if( is_array($valor) )
		$datos[$clave] = implode(",", $valor);
		
	if( substr($clave,0,10) == "notInclude" || $clave == '0' )
		unset($datos[$clave]);
	else if( substr($clave,-7) == "_submit" ) // Para obtener las fechas cib DatePicker
	{
		$datos[substr($clave,0,-7)] = $valor;
		unset($datos[$clave]);
	}
}

if( $form_accion == 'crear' )
{
	$allKeys = array_keys($datos);
	$allValues = array_values($datos);
	$camposQuery = $paramsQuery = $typesQuery = $questionsQuery = '';
	
	for( $i=0 ; $i<count($datos) ; $i++ )
	{
		$camposQuery .= ($i>0)?("," . $allKeys[$i]):$allKeys[$i];
		$paramsQuery .= ($i>0)?("," . $allValues[$i]):$allValues[$i];
		$myType = (is_int($allValues[$i]))?"i":((is_float($allValues[$i]))?"d":((is_string($allValues[$i]))?"s":"b"));
		$typesQuery .= $myType;
		$questionsQuery .= ($i>0)?",?":"?";
	}
	
	if( $stmt = $mysqli->prepare("INSERT INTO $form_elemento ( $camposQuery ) VALUES( $questionsQuery )") )
	{
		$sql_types = (isset($typesQuery))?$typesQuery:'';
		$data = $allValues;
		
		$params = array_merge(array($sql_types), $data);
		foreach( $params as $key => $value ) {
			$params[$key] = &$params[$key];
		}
		call_user_func_array(array($stmt, "bind_param"), $params);
		
		$stmt->execute();
		
		$response['result'] = "Ok";
		$response['Id'] = $mysqli->insert_id;
		
		$stmt->close();
		
		// Registrar acción
		$r_tipo = 'Alta de ' . $form_elemento;
		$r_contenido = json_encode( array('Cuenta' => $_SESSION['rol'],'Id' => $_SESSION['Id'],'Nombre' => $_SESSION['nombre'],'Nuevo Id.' => $response['Id']) );
		$r_detalles = json_encode( $datos );
		$response['resultRegistro'] = FB_RegistrarAccion( $r_tipo, $r_contenido, $r_detalles );
	}	
	else
	{
		$response['result'] = "Ko";
		$response['error'] = mysqli_error($mysqli);
	}
}
else if( $form_accion == 'editar' )
{
	
	$allKeys = array_keys($datos);
	$allValues = array_values($datos);
	$camposQuery = $paramsQuery = $typesQuery = $questionsQuery = '';
	$camposModificar = "";
	
	for( $i=0 ; $i<count($datos) ; $i++ )
	{
		$camposModificar .= ($i>0)?("," . $allKeys[$i] . " = ?"):($allKeys[$i] . " = ?");
		
		$myType = (is_int($allValues[$i]))?"i":((is_float($allValues[$i]))?"d":((is_string($allValues[$i]))?"s":"b"));
		$typesQuery .= $myType;
	}
	
	// Para cubrir el elemento final
	$typesQuery .= "s";
	array_push( $allValues, $form_IdElemento ); 
	
	if( $stmt = $mysqli->prepare("UPDATE $form_elemento SET $camposModificar WHERE Id$form_elemento = ?") )
	{
		$sql_types = $typesQuery;
		$data = $allValues;
		
		$params = array_merge(array($sql_types), $allValues);
		foreach( $params as $key => $value ) {
			$params[$key] = &$params[$key];
		}
		call_user_func_array(array($stmt, "bind_param"), $params);
		
		$stmt->execute();
		$stmt->close();
		
		$response['result'] = "Ok";
		
		// Registrar acción
		$r_tipo = 'Edición de ' . $form_elemento;
		$r_contenido = json_encode( array('Cuenta' => $_SESSION['rol'],'Id' => $_SESSION['Id'],'Nombre' => $_SESSION['nombre']) );
		$r_detalles = json_encode( $datos );
		$response['resultRegistro'] = FB_RegistrarAccion( $r_tipo, $r_contenido, $r_detalles );
	}
	else
	{
		$response['result'] = "Ko";
		$response['error'] = mysqli_error($mysqli);
	}
}
else if( $form_accion == 'eliminar' )
{
	if( $stmt = $mysqli->prepare("DELETE FROM $form_elemento WHERE Id$form_elemento = ?") )
	{
		$stmt->bind_param("i",$form_IdElemento);
		$stmt->execute();
		$stmt->close();
		
		// Registrar acción
		$r_tipo = 'Eliminación de ' . $form_elemento;
		$r_contenido = json_encode( array('Cuenta' => $_SESSION['rol'],'Id' => $_SESSION['Id'],'Nombre' => $_SESSION['nombre']) );
		$r_detalles = json_encode( array('Elemento' => $form_elemento, 'Id' => $form_IdElemento ) );
		$response['resultRegistro'] = FB_RegistrarAccion( $r_tipo, $r_contenido, $r_detalles );
		
		$response['result'] = "Ok";
	}
	else
	{
		$response['result'] = "Ko";
		$response['error'] = mysqli_error($mysqli);
	}
}
else
{
	$response['result'] = "Error, Función no reconocida.";
}

echo json_encode($response);

?>