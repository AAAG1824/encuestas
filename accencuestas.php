<?php    ob_start();  
require "./inc/settings.php";
require "./inc/funciones.php"; 
require "./inc/validasession.php"; 
 $sdir = "";
 

  echo "<pre>";
print_r($_POST);
echo "</pre>"; 

 
$sAcc=isset( $_POST['Acc'] ) ?  Limpieza($_POST['Acc']) : '' ; 
if( $sAcc == '')
	{
		$sAcc=isset( $_GET['Acc'] ) ?  Limpieza($_GET['Acc']) : '' ; 
	}
$iId=isset( $_POST['Id'] ) ?   Limpieza($_POST['Id']) : 0 ;
if( $iId == 0)
	{
		$iId=isset( $_GET['Id'] ) ?  Limpieza($_GET['Id']) : 0 ; 
	}

$sClave ="";
$iUltimoId = 0;
if($sAcc == 'A' ) // ----------- ALTA DE REGISTRO
	{ 
 	$sNombreBreve=isset( $_POST['NombreBreve'] ) ?   Limpieza($_POST['NombreBreve']) : '' ; 
	$sClave=isset( $_POST['Clave'] ) ?   Limpieza($_POST['Clave']) : '' ; 
 	$sEmpresa=isset( $_POST['Empresa'] ) ?   Limpieza($_POST['Empresa']) : '' ; 
	$sDescripcion=isset( $_POST['Descripcion'] ) ?   ($_POST['Descripcion']) : '' ;
	$sBienvenida=isset( $_POST['Bienvenida'] ) ?   ($_POST['Bienvenida']) : '' ;
	$sFinal=isset( $_POST['Final'] ) ?   ($_POST['Final']) : '' ; 
	$sFechaInicial=isset( $_POST['FechaInicial'] ) ?   Limpieza($_POST['FechaInicial']) : '' ; 
	$sFechaFinal=isset( $_POST['FechaFinal'] ) ?   Limpieza($_POST['FechaFinal']) : '' ; 
	$iEstado=isset( $_POST['Estado'] ) ?   Limpieza($_POST['Estado']) : 0 ;
	$iNivelEncuesta =isset( $_POST['NivelEncuesta'] ) ?   Limpieza($_POST['NivelEncuesta']) : 1 ;
	$iFechaInicial = FechaSistema($sFechaInicial,33);
	$iFechaFinal 	= FechaSistema($sFechaFinal,33);

// SUBIMOS EL ARCHIVO
$sNArchivo="";  $sEArchivo="";
$iErrUpld = 0;$sRFoto 	="";
 	$sdir=getcwd();
	$sRutaFile   =	$sdir."/encuestas/logos/";
	if($_FILES['Logotipo']['name'])
			{
			if(!$_FILES['Logotipo']['error'])
				{ 
				$FileTmp =strtolower($_FILES['Logotipo']['name']); //rename file
				 list(  $sNArchivo, $sEArchivo) = preg_split('[.]', $FileTmp);			 
					$sRFoto 	= $sNArchivo ."_lgt.".$sEArchivo;
				//	die( $sRutaFile.$sRFoto);
				  move_uploaded_file($_FILES['Logotipo']['tmp_name'], $sRutaFile.$sRFoto);  
				  
				  $sFilesUpl=$sRFoto;
				  // INSERTAMOS
				 echo "---1";
				$sSql  = " INSERT INTO ts_encuestas( EstadoId, Clave,Empresa,FechaInicio, FechaFin, NombreEncuesta, Descripcion, MensajeBienvenida, MensajeFinal,SSActiva,Logotipo,NivelEncuesta, FechaAlta, UsuarioId)  ";
				$sSql .= " VALUES ( ?,?,?,?,?,?,?,?,?,?,?,?,$GblFechaHora,$iGblUsuarioId) ";
				if ($stmt = mysqli_prepare($link, $sSql))
					 {
				 echo "---2";
						mysqli_stmt_bind_param($stmt, 'issiissssssi',$iEstado,$sClave,$sEmpresa,$iFechaInicial ,$iFechaFinal,$sNombreBreve ,$sDescripcion,$sBienvenida ,$sFinal ,$sGSessionId , $sFilesUpl,$iNivelEncuesta );
				 echo "---3";
						mysqli_stmt_execute($stmt);
				 echo "---4";
						// Obtener la última ID insertada
						$iUltimoId = mysqli_insert_id($link);
				 echo "---5";
						// Cerrar la sentencia preparada de MySQL
						mysqli_stmt_close($stmt);
				 echo "--$iUltimoId-6";
					 }
				
				 echo "---	$sSql   --NivelEncuesta--issiissssss---$iEstado,$sClave,$sEmpresa,$iFechaInicial ,$iFechaFinal,$sNombreBreve ,$sDescripcion,$sBienvenida ,$sFinal ,$sGSessionId , $sFilesUpl ---"; 
				if($iUltimoId>0)
					{
				 echo "---13"; 
					header("location: encuestas.php");
					exit();
					} 
				  
				}
			else
				{
					$iErrUpld = 1;
					session_regenerate_id();
					header("location: encuestas.php");
					exit();
				}
			
			
			}
		else
		{
		$iErrUpld = 1;
		session_regenerate_id();
		header("location: encuestas.php");
		exit();
		}

	}				// ------------ Fin alta regustro

 	
if($sAcc == 'C' ) // ----------- ACTUALIZAR
{
	 	$sNombreBreve=isset( $_POST['NombreBreve'] ) ?   Limpieza($_POST['NombreBreve']) : '' ; 
	$sClave=isset( $_POST['Clave'] ) ?   Limpieza($_POST['Clave']) : '' ; 
 	$sEmpresa=isset( $_POST['Empresa'] ) ?   Limpieza($_POST['Empresa']) : '' ; 
	$sDescripcion=isset( $_POST['Descripcion'] ) ?   ($_POST['Descripcion']) : '' ;
	$sBienvenida=isset( $_POST['Bienvenida'] ) ?   ($_POST['Bienvenida']) : '' ;
	$sFinal=isset( $_POST['Final'] ) ?   ($_POST['Final']) : '' ; 
	$sFechaInicial=isset( $_POST['FechaInicial'] ) ?   Limpieza($_POST['FechaInicial']) : '' ; 
	$sFechaFinal=isset( $_POST['FechaFinal'] ) ?   Limpieza($_POST['FechaFinal']) : '' ; 
	$iEstado=isset( $_POST['Estado'] ) ?   Limpieza($_POST['Estado']) : 0 ;
	$iNivelEncuesta =isset( $_POST['NivelEncuesta'] ) ?   Limpieza($_POST['NivelEncuesta']) : 1 ;
	$sArchivoAnt=isset( $_POST['ArchivoAnt'] ) ?   ($_POST['ArchivoAnt']) : '' ; 
	$iFechaInicial = FechaSistema($sFechaInicial,33);
	$iFechaFinal 	= FechaSistema($sFechaFinal,33);
	 
	// SUBIMOS EL ARCHIVO
	$sNArchivo="";  $sEArchivo="";
	$iErrUpld = 0;$sRFoto 	="";
 	$sdir=getcwd();
	$sRutaFile   =	$sdir."/encuestas/logos/";
	 $sArchivoNew = $_FILES['Logotipo']['name'];
	if(trim($sArchivoNew) != ""   ) 
	{
	if($_FILES['Logotipo']['name'])
		{	
		
 		if(!$_FILES['Logotipo']['error'])
				{ 
				$FileTmp =strtolower($_FILES['Logotipo']['name']);
	 			$nombre_fichero = $sRutaFile.$FileTmp;
				if (file_exists($nombre_fichero)) {
   					unlink( $nombre_fichero);
				 	 
					 	 // Actualizamos	
					 $sSQL  = " UPDATE ts_encuestas SET EstadoId= ?,   Empresa= ?, FechaInicio= ?, FechaFin= ?, NombreEncuesta= ?, Descripcion= ?, ";
					 $sSQL .= " MensajeBienvenida= ?,MensajeFinal= ?,NivelEncuesta=?,  FechaAlta=$GblFechaHora  ,UsuarioId =$iGblUsuarioId WHERE  EncuestaId= ? ";
		//			 die($sSQL . "<br>$iEstado,$sEmpresa,$iFechaInicial ,$iFechaFinal,$sNombreBreve, $sDescripcion, $sBienvenida,$sFinal,$iNivelEncuesta, $iId"  );
				 if ($stmt = mysqli_prepare($link, $sSQL))
					 {
					 	mysqli_stmt_bind_param($stmt, 'isiissssii',$iEstado,$sEmpresa,$iFechaInicial ,$iFechaFinal,$sNombreBreve, $sDescripcion, $sBienvenida,$sFinal, $iNivelEncuesta, $iId );  
						mysqli_stmt_execute($stmt); 
						mysqli_stmt_close($stmt);  
						header("location: encuestas.php");
						exit();
						
					  }
					 
					 
} 
else {  
			  move_uploaded_file($_FILES['Logotipo']['tmp_name'], $sRutaFile.$FileTmp);  
					 $sFilesUpl=$FileTmp;
					 $sRutaEmpresa1="";
					 
			 $sSQL  = " UPDATE ts_encuestas SET EstadoId= ?,   Empresa= ?, FechaInicio= ?, FechaFin= ?, NombreEncuesta= ?, Descripcion= ?, ";
					 $sSQL .= " MensajeBienvenida= ?,MensajeFinal= ?, Logotipo=?,NivelEncuesta=? FechaAlta=$GblFechaHora  ,UsuarioId =$iGblUsuarioId WHERE  EncuestaId= ? ";
					 
		//			 die($sSQL . "<br>$iEstado,$sEmpresa,$iFechaInicial ,$iFechaFinal,$sNombreBreve, $sDescripcion, $sBienvenida,$sFinal, $sFilesUpl , $iNivelEncuesta,$iId "  );
				 if ($stmt = mysqli_prepare($link, $sSQL))
					 {
					 	mysqli_stmt_bind_param($stmt, 'isiisssssii',$iEstado,$sEmpresa,$iFechaInicial ,$iFechaFinal,$sNombreBreve, $sDescripcion, $sBienvenida,$sFinal, $sFilesUpl , $iNivelEncuesta,$iId );  
						mysqli_stmt_execute($stmt); 
						mysqli_stmt_close($stmt);
						
					 header("location: encuestas.php");
						exit();
						
					  }				 
					 
	}
	
	
	
 
				
				}
		} 
	}
	else
	{
	 // Actualizamos	
					 $sSQL  = " UPDATE ts_encuestas SET EstadoId= ?,   Empresa= ?, FechaInicio= ?, FechaFin= ?, NombreEncuesta= ?, Descripcion= ?, ";
					 $sSQL .= " MensajeBienvenida= ?,MensajeFinal= ?, NivelEncuesta = ?, FechaAlta=$GblFechaHora  ,UsuarioId =$iGblUsuarioId WHERE  EncuestaId= ? ";
				 if ($stmt = mysqli_prepare($link, $sSQL))
					 {
					 	mysqli_stmt_bind_param($stmt, 'isiissssii',$iEstado,$sEmpresa,$iFechaInicial ,$iFechaFinal,$sNombreBreve, $sDescripcion, $sBienvenida,$sFinal, $iNivelEncuesta,$iId );  
						mysqli_stmt_execute($stmt); 
						mysqli_stmt_close($stmt);  
						header("location: encuestas.php");
						exit();
						
					  }
	} 
	 
	 
	 
	 
}

if($sAcc == 'B' ) // ----------- BORRAR
	{ 
	
  echo "<pre>";
print_r($_GET);
echo "</pre>"; 
	// eLIMINAMOS ENCUESTA
	$sSQL  = " DELETE  FROM ts_encuestas  where EncuestaId = ? ";
	 if ($stmt = mysqli_prepare($link, $sSQL))
		 {
		    mysqli_stmt_bind_param($stmt, 'i', $iId  ); 
			mysqli_stmt_execute($stmt); 
			mysqli_stmt_close($stmt);  
		  }
	//	LAS ENCUESTA USUARIO 
	
	$sSQL  = " DELETE  FROM ts_encuestausuarios  where EncuestaId = ? ";
	 if ($stmt = mysqli_prepare($link, $sSQL))
		 {
		    mysqli_stmt_bind_param($stmt, 'i', $iId  ); 
			mysqli_stmt_execute($stmt); 
			mysqli_stmt_close($stmt);  
		  }
	//	LAS ENCUESTA USUARIO 
	
	$sSQL  = " DELETE  FROM ts_encuestapregunta  where EncuestaId = ? ";
	 if ($stmt = mysqli_prepare($link, $sSQL))
		 {
		    mysqli_stmt_bind_param($stmt, 'i', $iId  ); 
			mysqli_stmt_execute($stmt); 
			mysqli_stmt_close($stmt);  
		  }
	//	LAS ENCUESTA USUARIO 
	
	$sSQL  = " DELETE  FROM ts_encuestarespuesta  where EncuestaId = ? ";
	 if ($stmt = mysqli_prepare($link, $sSQL))
		 {
		    mysqli_stmt_bind_param($stmt, 'i', $iId  ); 
			mysqli_stmt_execute($stmt); 
			mysqli_stmt_close($stmt);  
		  }
	//	LAS ENCUESTA USUARIO 
/*	
	$sSQL  = " DELETE  FROM ts_encuestascalculodet  where EmpresaId = ? ";
	 if ($stmt = mysqli_prepare($link, $sSQL))
		 {
		    mysqli_stmt_bind_param($stmt, 'i', $iId  ); 
			mysqli_stmt_execute($stmt); 
			mysqli_stmt_close($stmt);  
		  }
	//	LAS ENCUESTA USUARIO 
	
	$sSQL  = " DELETE  FROM ts_encuestascalculoenc  where EmpresaId = ? ";
	 if ($stmt = mysqli_prepare($link, $sSQL))
		 {
		    mysqli_stmt_bind_param($stmt, 'i', $iId  ); 
			mysqli_stmt_execute($stmt); 
			mysqli_stmt_close($stmt);  
		  }
*/	
					header("location: encuestas.php");
					exit();
	}
	
ob_end_flush();
require "./inc/desconectar.php";
?>