<?php   
require "./inc/settings.php";
require "./inc/funciones.php";  
   

  echo "<pre>";
print_r($_POST);
echo "</pre>";

$sSS=isset( $_GET['SS'] ) ?  Limpieza($_GET['SS']) : '' ;
$iId=isset( $_GET['Id'] ) ?  Limpieza($_GET['Id']) : 0 ;
$iIP=isset( $_GET['iP'] ) ?  Limpieza($_GET['iP']) : 0 ;
$IdScc=isset( $_POST['IdScc'] ) ?  Limpieza($_POST['IdScc']) : 0 ;
$IdPF=isset( $_POST['IdPF'] ) ?  Limpieza($_POST['IdPF']) : 0 ;

// Extraemos el # Nomina
$iNoNomina = 0 ; 

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
$sSql .= " WHERE e.EstadoId= 1 AND  SSActiva = ? AND (  $GblFecha between FechaInicio AND FechaFin ) ";
 if ($stmt = mysqli_prepare($link, $sSql))
  {
	mysqli_stmt_bind_param($stmt,'s',$sSS);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,$iEncuestaId, $sEmpresa, $iFechaInicio, $iFechaFin, $sNombreEncuesta, $sDescripcion, $sMensajeBienvenida, $sMensajeFinal);
		  while (mysqli_stmt_fetch($stmt)) {
		  }
		  
	     mysqli_stmt_close($stmt);
 }
 $V=0;
 $i= 1;
 $iT = 20;
 for ($i = 1; $i < $iT; $i++)	
  	{
	 $Nm ='P'.$i;
	 $sNomPregunta =	isset( $_POST[$Nm] ) ?  Limpieza($_POST[$Nm]) : -1 ;
	 $V=	isset( $_POST[$Nm] ) ?  Limpieza($_POST[$Nm]) : -1 ;
	  if(  $V== -1 )
	 	{		$Nm ='P'.($i-1);	break; 		}
	else
		{
// Eliminamos registro anterior 
 	 $sArrPregunta =explode('-',$sNomPregunta);
	 	// echo "<br> $sArrPregunta[0] --- $sArrPregunta[1] <br>";
		
 	$sSQL  = " DELETE  FROM ts_encuestarespuesta   where EncuestaId  = ? and PreguntaId  = ? ";
	//  die("- $sSQL -<br>---,$iId---$iProductoId---".$iExistenciaActual."--");
	 if ($stmt = mysqli_prepare($link, $sSQL))
		 {
		    mysqli_stmt_bind_param($stmt, 'ii',$iEncuestaId,$sArrPregunta[0]  ); 
			mysqli_stmt_execute($stmt); 
			mysqli_stmt_close($stmt);  
		  }	
		
// Insertamos el registro		
$iUltimoId = 0 ;
 	$sSQL  = " INSERT INTO ts_encuestarespuesta(EncuestaId, PreguntaId, RespuestaId, UsuarioContestoId, FechaAlta, UsuarioId)  ";
 	$sSQL .= " VALUES ( ?,?,?,?,$GblFechaHora,66699)";
	//  die("- $sSQL -<br>---,$iId---$iProductoId---".$iExistenciaActual."--");
	 if ($stmt = mysqli_prepare($link, $sSQL))
		 {
		    mysqli_stmt_bind_param($stmt, 'iiii',$iEncuestaId,$sArrPregunta[0],$sArrPregunta[1],$iNoNomina  ); 
	 		mysqli_stmt_execute($stmt);
			// Obtener la última ID insertada 
		    // Cerrar la sentencia preparada de MySQL
        	mysqli_stmt_close($stmt);
		 }
	
	 
			
			
			 
		  }	

	
		}
	 		
	  
 
 
 
 
 
 // Extraemos la siguiente pregunta
 $iExiste = 0;
 $iEncuestaPregunta=0;
 $iPreguntaId = 0;
  $iEncuestaPreguntaNw=0;
 
$sSql = " SELECT ep.EncuestaPreguntaId,ep.PreguntaId FROM ts_encuestapregunta  ep WHERE  ep.EstadoId = 1 AND ep.EncuestaId = $iEncuestaId ORDER BY  ep.Seccion, ep.Consecutivo";

 if ($stmt = mysqli_prepare($link, $sSql))
  { 
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,$iEncuestaPregunta, $iPreguntaId);
		  while (mysqli_stmt_fetch($stmt)) {
			  if($iExiste>0 ) 
				{ 				  break;			}
			  if($IdPF == $iEncuestaPregunta ) 
				{ 				$iExiste = 1; 				}
		  
		  }
		  $iEncuestaPreguntaNw= $iEncuestaPregunta;
		  
	     mysqli_stmt_close($stmt);
		
			
 } 
 	
 		
 
  if( $iEncuestaPreguntaNw == $IdPF  && $iExiste == 1)
		 
		 	{
		 	$iEncuestaPreguntaNw = 66699; // Fin de la encuesta
			$sSQL  = " UPDATE ts_encuestausuarios SET EstadoId=2,Avance =  $iEncuestaPreguntaNw  , Fecha= $GblFechaHora , UsuarioId = 66699   where ContestarId = ? ";
	 if ($stmt = mysqli_prepare($link, $sSQL))
		 {
		    mysqli_stmt_bind_param($stmt, 'i',$iId  ); 
			mysqli_stmt_execute($stmt); 
			mysqli_stmt_close($stmt);  
				header("location: uscontestarfin.php?SS=$sSS&Id=$iId");
				exit();
		  }
			}
		else
			{ 
			$sSQL  = " UPDATE ts_encuestausuarios SET Avance =  $iEncuestaPreguntaNw  , Fecha= $GblFechaHora , UsuarioId = 66699   where ContestarId = ?  ";
	 if ($stmt = mysqli_prepare($link, $sSQL))
		 {
		    mysqli_stmt_bind_param($stmt, 'i',$iId  ); 
			mysqli_stmt_execute($stmt); 
			mysqli_stmt_close($stmt);  
		  }
		    	header("location: uscontestar.php?SS=$sSS&Id=$iId&iP=$iEncuestaPreguntaNw");
				exit();
		} 
require "./inc/desconectar.php";
?>