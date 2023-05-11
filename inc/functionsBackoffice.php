<?php
	
	// -----------------------------------------------------------
	// ------------------------- GESTION -------------------------
	// -----------------------------------------------------------
	
	// SUPER ADMINISTRADOR
	
	function FB_GetDatosIndex()
	{
		global $mysqli;
		
		$resultadoFuncion = array();
		return( $resultadoFuncion );
	}
	
	function FB_GetGlobales()
	{
		global $mysqli;
		
		$resultadoFuncion = array();
		
		if( $stmt = $mysqli->prepare("SELECT * FROM Globales WHERE IdGlobales = 1") )
		{
			$stmt->execute();
			$resultArray = get_result($stmt);
			if( $fila = array_shift( $resultArray ) )
				$resultadoFuncion = $fila;
			$stmt->free_result();
			$stmt->close();
		}
		else
		{
			$resultadoFuncion['result'] = $mysqli->error;
		}
		
		return( $resultadoFuncion );
	}
	
	// ADMINISTRADOR
	
	function FB_GetAdministradores()
	{
		global $mysqli;
		
		$resultadoFuncion = array();
		
		if( $stmt = $mysqli->prepare("SELECT IdAdministrador, nombre, apellidos, mail, fechaUltimoAcceso FROM Administrador ORDER BY IdAdministrador ASC") )
		{
			$stmt->execute();
			$resultArray = get_result($stmt);
			while( $fila = array_shift( $resultArray ) ) $resultadoFuncion[] = $fila;
			$stmt->free_result();
			$stmt->close();
		}
		else
		{
			$resultadoFuncion['result'] = $mysqli->error;
		}
		
		return( $resultadoFuncion );
	}
	
	// REGISTRO
	
	function FB_RegistrarAccion( $in_tipo, $in_descripcion, $in_detalles )
	{
		global $mysqli;
		
		if( $stmt = $mysqli->prepare("INSERT INTO Registro (fechaHora, tipo, contenido, detalles) VALUES ( NOW(), ?, ?, ? )") )
		{
			$stmt->bind_param("sss",$in_tipo, $in_descripcion, $in_detalles);
			$stmt->execute();
			return true;
		}
		else
			return $mysqli->error;
	}
	
	function FB_GetRegistros( $año )
	{
		global $mysqli;
		
		$resultadoFuncion = array();
		
		if( $stmt = $mysqli->prepare("SELECT * FROM Registro WHERE YEAR(fechaHora) = ? ORDER BY fechaHora DESC") )
		{
			$stmt->bind_param("i",$año);
			$stmt->execute();
			$resultArray = get_result($stmt);
			while( $fila = array_shift( $resultArray ) ) $resultadoFuncion[] = $fila;
			$stmt->free_result();
			$stmt->close();
		}
		else
		{
			$resultadoFuncion['result'] = $mysqli->error;
		}
		
		return( $resultadoFuncion );
	}
	
	function FB_GetAñosRegistros()
	{
		global $mysqli;
		
		$resultadoFuncion = array();
		
		if( $stmt = $mysqli->prepare("SELECT DISTINCT YEAR(fechaHora) AS dist_año FROM Registro") )
		{
			$stmt->execute();
			$resultArray = get_result($stmt);
			while( $fila = array_shift( $resultArray ) ) $resultadoFuncion[] = $fila['dist_año'];
			$stmt->free_result();
			$stmt->close();
		}
		else
		{
			$resultadoFuncion['result'] = $mysqli->error;
		}
		
		return( $resultadoFuncion );
	}
	
	
	// -----------------------------------------------------------
	// ----------------------- AUXILIARES ------------------------
	// -----------------------------------------------------------
	
	function slugify($text)
	{
	  $text = str_replace('ñ', 'n', $text);
	  $text = str_replace('á', 'a', $text);
	  $text = str_replace('é', 'e', $text);
	  $text = str_replace('í', 'i', $text);
	  $text = str_replace('ó', 'o', $text);
	  $text = str_replace('ú', 'u', $text);
	  $text = str_replace(' ', '-', $text);
	  
	  // replace non letter or digits by -
	  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
	  
	  // transliterate
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	  
	  // trim
	  $text = trim($text, '-');
	  
	  // lowercase
	  $text = strtolower($text);
	  
	  // remove unwanted characters
	  $text = preg_replace('~[^-\w]+~', '', $text);
	  
	  if (empty($text))
	  {
		return 'n-a';
	  }
	  
	  return $text;
	}




	/// FUNCIONES FUERA DEL CORE --------------------------------------- V