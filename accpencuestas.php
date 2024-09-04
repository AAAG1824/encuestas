<?php 
ob_start();
require "./inc/settings.php";
require "./inc/funciones.php"; 
require "./inc/validasession.php"; 
   

  echo "<pre>";
print_r($_POST);
echo "</pre>";

 
$sAcc=isset( $_POST['Acc'] ) ?  Limpieza($_POST['Acc']) : '' ; 
if( $sAcc == '')
	{
		$sAcc=isset( $_GET['Acc'] ) ?  Limpieza($_GET['Acc']) : '' ; 
	}
$iIdE=isset( $_POST['IdE'] ) ?   Limpieza($_POST['IdE']) : 0 ;
if( $iIdE == 0)
	{
		$iIdE=isset( $_GET['IdE'] ) ?  Limpieza($_GET['IdE']) : 0 ; 
	}

$iId=isset( $_POST['Id'] ) ?   Limpieza($_POST['Id']) : 0 ;
if( $iId == 0)
	{
		$iId=isset( $_GET['Id'] ) ?  Limpieza($_GET['Id']) : 0 ; 
	}
 
$iUltimoId = 0;
if($sAcc == 'A' ) // ----------- ALTA DE REGISTRO
	{ 
	 
	$iGrupoId=isset( $_POST['GrupoId'] ) ?   Limpieza($_POST['GrupoId']) : 0 ;
	$iConsecutivo=isset( $_POST['Consecutivo'] ) ?   Limpieza($_POST['Consecutivo']) : 0 ;
	$iPreguntaId=isset( $_POST['PreguntaId'] ) ?   Limpieza($_POST['PreguntaId']) : 0 ; 
	$iEstado=isset( $_POST['Estado'] ) ?   Limpieza($_POST['Estado']) : 0 ; 
	$iSeccion=isset( $_POST['Seccion'] ) ?   Limpieza($_POST['Seccion']) : 0 ; 
	
	$sSql  = ""; 
	$sSql .= "INSERT INTO ts_encuestapregunta(EncuestaId, GrupoId,Seccion, PreguntaId, Consecutivo, EstadoId, FechaAlta, UsuarioId) ";
	$sSql .= "VALUES(?, ?, ?, ?, ?, ?, $GblFechaHora,$iGblUsuarioId) ";
	
	if ($stmt = mysqli_prepare($link, $sSql))
		 {
		    mysqli_stmt_bind_param($stmt, 'iiiiii',$iIdE,$iGrupoId,$iSeccion,$iPreguntaId ,$iConsecutivo,$iEstado    );
			mysqli_stmt_execute($stmt);
			// Obtener la última ID insertada
			$iUltimoId = mysqli_insert_id($link);
		    // Cerrar la sentencia preparada de MySQL
        	mysqli_stmt_close($stmt);
		 } 
	if($iUltimoId>0)
		{
		header("location: addpencuestas.php?Id=$iIdE");
		exit();
		} 
	else{ // corregir error  
	header("location: addpencuestas.php?Id=$iIdE&Er=900");
		exit();
		} 
	
	
	}				// ------------ Fin alta regustro
	
	
	
ob_end_flush();

require "./inc/desconectar.php";
?>