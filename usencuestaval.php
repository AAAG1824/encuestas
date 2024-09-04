<?php   
require "./inc/settings.php";
require "./inc/funciones.php";  
   

  echo "<pre>";
print_r($_POST);
echo "</pre>";

 
	$sSS=isset( $_POST['SS'] ) ?   Limpieza($_POST['SS']) : '' ;
	$iNomina=isset( $_POST['Nomina'] ) ?   Limpieza($_POST['Nomina']) : 0 ;
	$iEdad=isset( $_POST['Edad'] ) ?   Limpieza($_POST['Edad']) : 0 ; 
	$iGenero=isset( $_POST['Genero'] ) ?   Limpieza($_POST['Genero']) : 0 ; 
	$iId=isset( $_POST['Id'] ) ?   Limpieza($_POST['Id']) : 0 ;
	$iCantidad = 0;
 $iEncuestaId=0;
 $iContestarId=0;
 $iAvance =0;
 $iEEstadoId = 0;
 
 
$sSQL  = " SELECT   ContestarId, Avance ,EstadoId FROM ts_encuestausuarios WHERE EncuestaId = ? and NoNomina = ?  ";
 
if ($stmt = mysqli_prepare($link, $sSQL))
  {
 		mysqli_stmt_bind_param($stmt,'ii',$iId,$iNomina);
        mysqli_stmt_execute($stmt);
		  mysqli_stmt_bind_result($stmt, $iContestarId, $iAvance , $iEEstadoId );
		  while (mysqli_stmt_fetch($stmt)) {
 				$iCantidad = 1;
		  }
               // Cerrar la sentencia preparada de MySQL
        mysqli_stmt_close($stmt);
	} 
	
if( $iEEstadoId != 2 )  // Finalizo el Registro
{	
	
if( $iCantidad > 0 ) 
{
 // Ya existe 
 
		session_regenerate_id();
		header("location: uscontestar.php?SS=$sSS&Id=$iContestarId&iP=$iAvance");
	 
}
else
{
// No Existe insertar y tomar la 1a pregunta
$iEncuestaPreguntaId = 0;
$iPreguntaId= 0;
$iGrupoId= 0;
$iConsecutivo= 0;
$sSQL  = " SELECT EncuestaPreguntaId ,PreguntaId,GrupoId,Consecutivo FROM ts_encuestapregunta WHERE EncuestaId = ? AND EstadoId = 1  order by Consecutivo asc Limit 0,1 ";

 
 
if ($stmt = mysqli_prepare($link, $sSQL))
  {
 		mysqli_stmt_bind_param($stmt,'i',$iId);
        mysqli_stmt_execute($stmt);
		  mysqli_stmt_bind_result($stmt,$iEncuestaPreguntaId,$iPreguntaId,$iGrupoId,$iConsecutivo );
		  while (mysqli_stmt_fetch($stmt)) { 	  }
               // Cerrar la sentencia preparada de MySQL
        mysqli_stmt_close($stmt);
	}

// insertamos el usuario  $sSS 
	$iUltimoId = 0;
$sSql  = " INSERT INTO ts_encuestausuarios( EncuestaId, Correo, NoNomina, Edad, Genero, SSUsuario, EstadoId, Link, Avance, Fecha, UsuarioId)";
$sSql .= " VALUES(?,'',?,?,?,?,1,'',?,$GblFechaHora,696969)";
if ($stmt = mysqli_prepare($link, $sSql))
		 {
		    mysqli_stmt_bind_param($stmt, 'iiiisi',$iId,$iNomina,$iEdad ,$iGenero,$sSS  ,$iEncuestaPreguntaId    );
			mysqli_stmt_execute($stmt);
			// Obtener la última ID insertada
			$iUltimoId = mysqli_insert_id($link);
		    // Cerrar la sentencia preparada de MySQL
        	mysqli_stmt_close($stmt);
		 }
	
	if($iUltimoId>0)
		{
		session_regenerate_id();
		header("location: uscontestar.php?SS=$sSS&Id=$iUltimoId&iP=$iEncuestaPreguntaId");
		exit();
		} 

}	
}else
{
 // Ya existe 
		session_regenerate_id();
		header("location: uscontestarfin.php?SS=$sSS&Id=$iContestarId&iP=$iAvance");
	 
}
 



require "./inc/desconectar.php";
?>