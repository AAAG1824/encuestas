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
$iId=isset( $_POST['Id'] ) ?   Limpieza($_POST['Id']) : 0 ;
if( $iId == 0)
	{
		$iId=isset( $_GET['Id'] ) ?  Limpieza($_GET['Id']) : 0 ; 
	}

 
$iUltimoId = 0;
if($sAcc == 'A' ) // ----------- ALTA DE REGISTRO
	{ 
	
	$iGrupoId=isset( $_POST['GrupoId'] ) ?   Limpieza($_POST['GrupoId']) : 0 ;
	$iOrden=isset( $_POST['Orden'] ) ?   Limpieza($_POST['Orden']) : 0 ;
	$sNombreBreve=isset( $_POST['NombreBreve'] ) ?   Limpieza($_POST['NombreBreve']) : '' ;
	$sInstruccion=isset( $_POST['Instruccion'] ) ?   ($_POST['Instruccion']) : '' ;
	$sPregunta=isset( $_POST['Pregunta'] ) ?   ($_POST['Pregunta']) : '' ;
	$sR1=isset( $_POST['R1'] ) ?   Limpieza($_POST['R1']) : '' ;
	$iV1=isset( $_POST['V1'] ) ?   Limpieza($_POST['V1']) : 0 ;
	$sR2=isset( $_POST['R2'] ) ?   Limpieza($_POST['R2']) : '' ;
	$iV2=isset( $_POST['V2'] ) ?   Limpieza($_POST['V2']) : 0 ;
	$sR3=isset( $_POST['R3'] ) ?   Limpieza($_POST['R3']) : '' ;
	$iV3=isset( $_POST['V3'] ) ?   Limpieza($_POST['V3']) : 0 ;
	$sR4=isset( $_POST['R4'] ) ?   Limpieza($_POST['R4']) : '' ;
	$iV4=isset( $_POST['V4'] ) ?   Limpieza($_POST['V4']) : 0 ;
	$sR5=isset( $_POST['R5'] ) ?   Limpieza($_POST['R5']) : '' ;
	$iV5=isset( $_POST['V5'] ) ?   Limpieza($_POST['V5']) : 0 ;
	//die('<br>-->' . $sInstruccion);
	
	$sSQL  = "INSERT INTO ts_preguntas( GrupoId, EstadoId, Orden, PreguntaBreve, Instruccion, Pregunta, ";
	$sSQL .= "Respuesta01, Valor01, Respuesta02, Valor02, Respuesta03, Valor03, Respuesta04, Valor04, Respuesta05, Valor05, ";
	$sSQL .= "Respuesta06, Valor06, FechaAlta, UsuarioId) VALUES ( ?,1,?,?,?,? ,?,?,?,?,?,?,?,?,?,?,'',0,$GblFechaHora,$iGblUsuarioId) ";
	if ($stmt = mysqli_prepare($link, $sSQL))
		 {
		    mysqli_stmt_bind_param($stmt, 'iissssisisisisi',$iGrupoId,$iOrden ,$sNombreBreve,$sInstruccion ,$sPregunta,$sR1 ,$iV1,$sR2 ,$iV2,$sR3 ,$iV3,$sR4,$iV4,$sR5,$iV5 );
			mysqli_stmt_execute($stmt);
			// Obtener la última ID insertada
			$iUltimoId = mysqli_insert_id($link);
		    // Cerrar la sentencia preparada de MySQL
        	mysqli_stmt_close($stmt);
		 }
	
	if($iUltimoId>0)
		{
	 	header("location: preguntas.php");
		exit();
		}
	}				// ------------ Fin alta regustro

ob_end_flush();
require "./inc/desconectar.php";
?>