<?php
	header('Content-Type: text/html; charset=utf-8');
	
	require_once($_SERVER['DOCUMENT_ROOT'].'/_Globales.php');
	
	$datosConexion = new DatosConexion();
	
	setlocale(LC_ALL, 'es_ES');
	
	$mysqli = new mysqli($datosConexion->dbhost, $datosConexion->dbusername, $datosConexion->dbuserpass, $datosConexion->dbname);
	
	if($mysqli->connect_error) 
		die('BBDD error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
	
	if (!$mysqli->set_charset("utf8"))
	{
		printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
		exit();
	}
	
	function get_result( $Statement )
	{
		$RESULT = array();
		$Statement->store_result();
		for ( $i = 0; $i < $Statement->num_rows; $i++ ) {
			$Metadata = $Statement->result_metadata();
			$PARAMS = array();
			while ( $Field = $Metadata->fetch_field() ) {
				$PARAMS[] = &$RESULT[ $i ][ $Field->name ];
			}
			call_user_func_array( array( $Statement, 'bind_result' ), $PARAMS );
			$Statement->fetch();
		}
		return $RESULT;
	}
?>