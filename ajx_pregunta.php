<?php 
ob_start(); 
require "./inc/settings.php";
require "./inc/funciones.php"; 
require "./inc/validasession.php"; 
$sCadenaSelect = ""; 
$iId=isset( $_POST['Id'] ) ?  Limpieza($_POST['Id']) : 0 ; 

$sCadenaSelect  .=  "<select   id='PreguntaId'  name='PreguntaId'  onChange='VamonosA2();'><option value='' > .: SELECCIONE UNA PREGUNTA :.</option>";
 ;
 if ($stmt = mysqli_prepare($link, "SELECT PreguntaId, PreguntaBreve FROM ts_preguntas WHERE EstadoId = 1 AND GrupoId =? ORDER BY Orden  ")) {
		mysqli_stmt_bind_param($stmt, 'i',   $iId);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,  $tmp_id,   $tmp_nombre);		 
	while (mysqli_stmt_fetch($stmt)) 
	{
	  
	$sCadenaSelect  .=    "<option value='$tmp_id'>$tmp_nombre</option>";
  
	}
	mysqli_stmt_close($stmt);
	
}	
$sCadenaSelect  .= "</select>";
echo $sCadenaSelect;
require "./inc/desconectar.php";
?>