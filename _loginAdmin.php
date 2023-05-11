<?php

session_start();

if( $_SERVER['HTTP_HOST'] == 'pruebas.localhost' )
{
  if( $_GET['tipo'] == 'Admin' )
  {
  	$_SESSION['rol'] = 'Administrador';
  	$_SESSION['Id'] = 1;
  	$_SESSION['nombre'] = '- Admin - Test -';
  	header('Location: /panel.php');
  }
}

?>