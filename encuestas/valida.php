<?php    ob_start();  
require "../inc/settings.php";
require "../inc/funciones.php";  
 

 
$iCantidad = 0;
$iEncuestaId=0;
$iContestarId=0;
$iAvance =0;
$iEEstadoId = 0;
$iNomina=isset( $_POST['Nomina'] ) ?   Limpieza($_POST['Nomina']) : 0 ;
$iEdad=isset( $_POST['Edad'] ) ?   Limpieza($_POST['Edad']) : 0 ; 
$iGenero=isset( $_POST['Genero'] ) ?   Limpieza($_POST['Genero']) : 0 ; 
$iEncuesta = isset( $_POST['EmpresaId'] ) ?   Limpieza($_POST['EmpresaId']) : 0 ;  
$iGradoId = isset( $_POST['GradoId'] ) ?   Limpieza($_POST['GradoId']) : 0 ;    
$sArea = isset( $_POST['Area'] ) ?   Limpieza($_POST['Area']) : '' ;    
$sDepartamento = isset( $_POST['Departamento'] ) ?   Limpieza($_POST['Departamento']) : '' ;    
$iMobile = isset( $_POST['Mobile'] ) ?   Limpieza($_POST['Mobile']) : 0 ;  
 $iEEstadoId=0;
$sSQL  = " SELECT   ContestarId, Avance ,EstadoId FROM ts_encuestausuarios WHERE EncuestaId = ? and NoNomina = ?  ";
 
if ($stmt = mysqli_prepare($link, $sSQL))
  {
 		mysqli_stmt_bind_param($stmt,'ii',$iEncuesta,$iNomina);
        mysqli_stmt_execute($stmt);
		  mysqli_stmt_bind_result($stmt, $iContestarId, $iAvance , $iEEstadoId );
		  while (mysqli_stmt_fetch($stmt)) {
 				$iCantidad = 1;
		  }
               // Cerrar la sentencia preparada de MySQL
        mysqli_stmt_close($stmt);
	} 

	$sSS = "";
  echo "<pre>";
print_r($_POST);
echo "</pre><br>$sSQL  --> $iEncuesta,$iNomina<br>  $iContestarId, $iAvance , $iEEstadoId $iContestarId-->".base64_encode($iContestarId);
  
if( $iEEstadoId != 2 )  // Finalizo el Registro
{	
 echo "<br>AA";
		if( $iCantidad > 0 ) 
		{
		 // Ya existe 
 echo "-BB"; 
 	 	  echo "location.href='seccion$iAvance.php?M=$iMobile&Sc=$iAvance&IdE=".base64_encode($iEncuesta)."&Id=".base64_encode($iContestarId) . "';";
		 echo "-1-";
		 header("Location: ./seccion$iAvance.php?M=$iMobile&Sc=$iAvance&IdE=".base64_encode($iEncuesta)."&Id=".base64_encode($iContestarId)); 
		 exit();
		  echo "-2-";
			 
		}
		else
		{
 echo "-CC";
			// Es nueva.
			// insertamos el usuario  $sSS 
			$sSS = session_id();
			$iUltimoId = 0; 
			$sSql  = " INSERT INTO ts_encuestausuarios( EncuestaId, Correo, NoNomina, Edad, Genero, SSUsuario, EstadoId, Link, Avance,EstudiosId,Area,Departamento, Fecha, UsuarioId)";
			$sSql .= " VALUES(?,'',?,?,?,?,1,'',1,?,?,?,$GblFechaHora,696969)";
			 if ($stmt = mysqli_prepare($link, $sSql))
					 {
						mysqli_stmt_bind_param($stmt, 'iiiisiss',$iEncuesta,$iNomina,$iEdad ,$iGenero,$sSS ,$iGradoId,$sArea,$sDepartamento	   );
						mysqli_stmt_execute($stmt);
						// Obtener la última ID insertada
						$iUltimoId = mysqli_insert_id($link);
						// Cerrar la sentencia preparada de MySQL
						mysqli_stmt_close($stmt);
					 }
				
				if($iUltimoId>0)
					{
					  
				 header("location: seccion1.php?M=$iMobile&IdE=".base64_encode($iEncuesta)."&Id=".base64_encode($iUltimoId));
				 exit();
					} 

			    else 
					{ 
			 
				 header("location: Despedida.php?M=$iMobile&IdRpt=1");
				 exit();
					}
		}
}
else // Esta en proceso el registro
{ 
				 header("location: Despedida.php?M=$iMobile&Id=$iContestarId");	exit();
}

ob_end_flush();
require "../inc/desconectar.php";
?>