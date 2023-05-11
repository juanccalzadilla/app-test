<?php

session_start();

if( session_destroy() )
{
	header( "refresh:1;url=login.php" );
}
?>
<html class="no-js">
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  </head>
  <body>
	<div style="text-align:center; width:100%; margin-top:30vh;">
	  <!-- <img src="/backoffice/img/logo.png" style="width: 25vw;" /> -->
	  <p>Logo</p>
	</div>
	<div style="text-align:center; width:100%;margin-top: -25px;">
	  <h3>... Cerrando sesión ...</h3>
	</div>
  </body>
	
</html>