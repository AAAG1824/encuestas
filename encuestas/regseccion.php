<?php    ob_start();   
require "../inc/settings.php";
require "../inc/funciones.php";  
 $iEncuestaId =0;
 $sEmpresa ='';
 $iFechaInicio =0;
 $iFechaFin =0;
 $sNombreEncuesta ='';
 $sDescripcion ='';
 $sMensajeBienvenida ='';
 $sMensajeFinal ='';

$iIdE =0;
$iId = 0;
$IdE=isset( $_GET['IdE'] ) ?    ($_GET['IdE']) : 0 ; 
$Id = isset( $_GET['Id'] ) ?    ($_GET['Id']) : 0 ;  
$iSeccActual = isset( $_GET['Is'] ) ?    ($_GET['Is']) : 0 ;  
$iIdE =  base64_decode($IdE);
$iId  =  base64_decode($Id);
$iAcc = isset( $_POST['Acc'] ) ?    ($_POST['Acc']) : 0 ;
$iPreguntas = isset( $_POST['Pg'] ) ?    ($_POST['Pg']) : 0 ;
$iPreguntaInicial = isset( $_POST['PgI'] ) ?    ($_POST['PgI']) : 1 ;
$sSession = isset( $_POST['ss'] ) ?    ($_POST['ss']) : '' ;
$iSecc = isset( $_POST['ssec'] ) ?    ($_POST['ssec']) : 0 ;
$iMobile = isset( $_POST['M'] ) ?    ($_POST['M']) : 0 ;
$iNoNomina = 0 ;
$i=1;

echo "<pre>";
print_r($_GET);
echo "</pre>";

echo "<pre>";
print_r($_POST);
echo "</pre>";
//die("<br>");
// Extraemos el # Nomina
$iNoNomina = 0 ; 
$EsNo = 0;

$sSql  = " ";
$sSql .= "  SELECT DISTINCT NoNomina FROM ts_encuestausuarios WHERE ContestarId = ?  ";
 if ($stmt = mysqli_prepare($link, $sSql))
  {
	mysqli_stmt_bind_param($stmt,'i',$iId);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,$iNoNomina);
		  while (mysqli_stmt_fetch($stmt)) {
		  }
		  
	     mysqli_stmt_close($stmt);
 }
 
 $sSql  = " ";
$sSql .= " SELECT EncuestaId, Empresa, FechaInicio, FechaFin, NombreEncuesta, Descripcion, MensajeBienvenida, MensajeFinal FROM ts_encuestas e ";
$sSql .= " WHERE e.EstadoId= 1 AND  EncuestaId = ? AND (  $GblFecha between FechaInicio AND FechaFin ) ";
 if ($stmt = mysqli_prepare($link, $sSql))
  {
	mysqli_stmt_bind_param($stmt,'i',$iIdE);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,$iEncuestaId, $sEmpresa, $iFechaInicio, $iFechaFin, $sNombreEncuesta, $sDescripcion, $sMensajeBienvenida, $sMensajeFinal);
		  while (mysqli_stmt_fetch($stmt)) {
		  }
		  
	     mysqli_stmt_close($stmt);
 }
  
// ---- barremos las preguntas ini
 $V=0;
  
 for ($i= $iPreguntaInicial;  $i <= $iPreguntas; $i++)	
  	{
	 $Nm ='R'.$i;
	 $iRespuesta =	isset( $_POST[$Nm] ) ?  Limpieza($_POST[$Nm]) : -1 ;  
	 
	 // Eliminamos
	 $sSQL  = " DELETE  FROM ts_encuestarespuesta   where EncuestaId  = ?  and ContestarId = ?  and PreguntaId  = ? "; 
	 if ($stmt = mysqli_prepare($link, $sSQL))
		 {
		    mysqli_stmt_bind_param($stmt, 'iii',$iIdE,$iId,$i  ); 
			mysqli_stmt_execute($stmt); 
			mysqli_stmt_close($stmt);  
		  }	
	 // Insertamos
	 $iUltimoId = 0 ;
	 
	 if( $iRespuesta == 1)
	 	$EsNo = 1;
	 
 	$sSQL  = " INSERT INTO ts_encuestarespuesta(EncuestaId,  ContestarId ,PreguntaId, RespuestaId, UsuarioContestoId, FechaAlta, UsuarioId)  ";
 	$sSQL .= " VALUES ( ?,?,?,?,?,$GblFechaHora,66699)";
	//  die("- $sSQL -<br>---,$iId---$iProductoId---".$iExistenciaActual."--");
	 if ($stmt = mysqli_prepare($link, $sSQL))
		 {
		    mysqli_stmt_bind_param($stmt, 'iiiii',$iIdE,$iId,$i , $iRespuesta,$iNoNomina  ); 
	 		mysqli_stmt_execute($stmt);
			// Obtener la última ID insertada 
		    // Cerrar la sentencia preparada de MySQL
        	mysqli_stmt_close($stmt);
		 }
	
	 
	}

//Avanzar a la pagina siguiente:
$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}"."/halzaenc/encuestas/seccion$iSecc.php" ;
  
$urlexists = url_exists( $url );

	  
    if($EsNo == 0 && $iSeccActual==1 )
		{ $iSecc=5;
		}
 
		
if($iSecc <=26)
{
 
	$sSQL  = " UPDATE ts_encuestausuarios SET EstadoId=1,Avance =  $iSecc  , Fecha= $GblFechaHora , UsuarioId = 66699   where ContestarId = ? ";
	 if ($stmt = mysqli_prepare($link, $sSQL))
		 {
		    mysqli_stmt_bind_param($stmt, 'i',$iId  ); 
			mysqli_stmt_execute($stmt); 
			mysqli_stmt_close($stmt);  
		  }
		  
				session_regenerate_id();
    	 		header("location: seccion$iSecc.php?M=$iMobile&Sc=".$iSecc."&IdE=".$IdE."&Id=".$Id);
				exit();
		 
 
}
else
{

					 header("location: error.php?M=$iMobile&IdRpt=2&IP=seccion$iSecc.php");
					exit();
}
// ---- barremos las preguntas fin
 
ob_end_flush();
require "../inc/desconectar.php";
?>