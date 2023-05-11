<?php

// TO-DO: Configurar un SMTP para que funcione también en local.

// Report simple running errors
// error_reporting(E_ERROR | E_WARNING | E_PARSE);

// -------------------

$global_entorno = 'LOCAL'; 		// localhost
// $global_entorno = 'DEV';		// etnykalabs
// $global_entorno = 'PROD';	//

if( $global_entorno == 'LOCAL' )
{
	// --> Configuracion extra <--
	
	/**
	 * Aqui los datos extras que pueda usar la aplicación
	 */

	// Servidor
	$global_dominio = 'nuevo-proyecto.localhost/';								// Central - Dominio
	$global_web = 'http://127.0.0.1/';								// Central - URL completa
	$global_endpoints = 'http://127.0.0.1/endpoints/';	// Central - URL de los endpoints
	
	// E-Mail
	$mailing_NameFrom = "Soporte - Nuevo Proyecto";		// Nombre del e-mail emisor (Nombre del remitente)
	$mailing_MailFrom = "no-reply@nuevop.etnykalabs.com";					// Dirección del e-mail emisor
	
	// Clase para la conexión con la BBDD (Necesaria para algunos procesos)
	class DatosConexion
	{
		public $dbhost='localhost';
		public $dbusername='root';
		public $dbuserpass='';
		public $dbname='etnykalabs_nuevop';
	}
	
	// Clase para el servidor SMTP
	class DatosSMTP
	{
		public $Host = 'mail.etnykalabs.com';
		public $SMTPAuth = true;
		public $Username = 'nuevo@etnykalabs.com'; //Credenciales de la cuenta de correo
		public $Password = 'x.Kqf_^^_JC&WT@2022'; //Credenciales de la cuenta de correo
		public $Port = 465; //Puerto de conexión al servidor de envío
		public $reply_name = 'No Reply'; // Nombre del remitente de la respuesta
		public $reply_mail = 'nuevo@etnykalabs.com'; // Dirección del remitente de la respuesta
		public $from_name = 'Nuevo proyecto'; // Nombre del remitente
		public $from_mail = 'nuevop@etnykalabs.com'; // Dirección del remitente
	}
}
else if( $global_entorno == 'DEV' )
{
	// --> Configuracion <--
	/**
	 * Aqui los datos extras que pueda usar la aplicación
	 */

	// Servidor
	$global_dominio = 'nuevop.etnykalabs.com';													// Central - Dominio
	$global_web = 'https://www.nuevop.etnykalabs.com/';								// Central - URL completa
	$global_endpoints = 'https://www.nuevop.etnykalabs.com/endpoints/';	// Central - URL de los endpoints
	
	// E-Mail
	$mailing_NameFrom = "Soporte - Nuevo P";		// Nombre del e-mail emisor
	$mailing_MailFrom = "no-reply@nuevop.etnykalabs.com";					// Dirección del e-mail emisor
	
	// Clase para la conexión con la BBDD (Necesaria para algunos procesos)
	class DatosConexion
	{
		public $dbhost='localhost';
		public $dbusername='etnykala_alfredo';
		public $dbuserpass='alfredo@2016';
		public $dbname='etnykalabs_nuevop';
	}
	
	// Clase para el servidor SMTP
	class DatosSMTP
	{
		public $Host = 'mail.etnykalabs.com';
		public $SMTPAuth = true;
		public $Username = 'nuevop@etnykalabs.com';
		public $Password = 'x.Kqf_^^_JC&WT@2022';
		public $Port = 465;
		public $reply_name = 'No Reply';
		public $reply_mail = 'nuevop@etnykalabs.com';
		public $from_name = 'Nuevo proyecto - Soporte';
		public $from_mail = 'nuevop@etnykalabs.com';
	}
}
else if( $global_entorno == 'PROD' )
{
	// --> Configuracion <--
	/**
	 * Aqui los datos extras que pueda usar la aplicación
	 */

	
	// Servidor
	$global_dominio = '';								// Dominio principal
	$global_web = '';							// URL completa
	$global_endpoints = '';			//  URL de los endpoints
	
	// E-Mail
	$mailing_NameFrom = "";	// Nombre del e-mail emisor
	$mailing_MailFrom = "";							// Dirección del e-mail emisor
	
	// Clase para la conexión con la BBDD (Necesaria para algunos procesos)
	class DatosConexion
	{
		public $dbhost='localhost';
		public $dbusername='';
		public $dbuserpass='';
		public $dbname='etnykalabs_';
	}
	
	// Clase para el servidor SMTP
	class DatosSMTP
	{
		public $Host = 'mail.etnykalabs.com';
		public $SMTPAuth = true;
		public $Username = '';
		public $Password = '';
		public $Port = 465;
		public $reply_name = 'No Reply';
		public $reply_mail = '';
		public $from_name = '';
		public $from_mail = '';
	}
}
?>