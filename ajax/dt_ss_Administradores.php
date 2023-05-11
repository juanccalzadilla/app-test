<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/start.php");

require_once($_SERVER['DOCUMENT_ROOT'].'/_Globales.php');
$datosConexion = new DatosConexion();

// Tabla de la BBDD
$table = 'Administrador';
 
// Key de la tabla
$primaryKey = 'IdAdministrador';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'IdAdministrador', 'dt' => 0 ),
    array( 'db' => 'nombre', 'dt' => 1 ),
    array( 'db' => 'apellidos', 'dt' => 2 ),
    array( 'db' => 'mail', 'dt' => 3 ),
    array( 'db' => 'fechaUltimoAcceso',  'dt' => 4 ),
    array( 'dt' => 5 )
);
 
// SQL server connection information
$sql_details = array(
		'user' => $datosConexion->dbusername,
		'pass' => $datosConexion->dbuserpass,
		'db'   => $datosConexion->dbname,
		'host' => $datosConexion->dbhost
	);

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require( $_SERVER['DOCUMENT_ROOT'] . '/inc/ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);