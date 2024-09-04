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
$sSession = isset( $_GET['ss'] ) ?    ($_GET['ss']) : '' ;
$iSecc = isset( $_GET['ssec'] ) ?    ($_GET['ssec']) : 0 ; 
$iNv =  isset( $_GET['Nv'] ) ?    ($_GET['Nv']) : 1 ; 

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
 
 //--
if($iNv == 2)
{
  
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

} 
// ---- barremos las preguntas fin
 
ob_end_flush();
require "../inc/desconectar.php";
?>