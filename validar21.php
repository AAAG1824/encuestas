<?php   
require "./inc/settings.php";
require "./inc/funciones.php"; 
 

$iGblUsuarioId=0;
$sGblNombreEmpresa="";
$sGblNombreEmpleado="";
$iGblRolId = "";
$iCantidad = 0;
//

$sPsw1=isset( $_POST['exampleInputPassword'] ) ?  $_POST['exampleInputPassword'] : '' ; 
$sPsw=md5($sPsw1);
$sUsuarioSistema1=isset( $_POST['exampleInputEmail'] ) ?   Limpieza($_POST['exampleInputEmail']) : '' ;
$sUsuarioSistema  = trim($sUsuarioSistema1);
	 	$strLink ="";
$sSQL  = " SELECT UsuarioId,  NombreEmpresa, NombreEmpleado,  RolId FROM ts_usuarios WHERE EstadoId = 1 AND  CorreoElectronico = ? AND Contrasena = ?  ";
 
if ($stmt = mysqli_prepare($link, $sSQL))
  {
 		mysqli_stmt_bind_param($stmt,'ss',$sUsuarioSistema,$sPsw);
        mysqli_stmt_execute($stmt);
		  mysqli_stmt_bind_result($stmt,$iGblUsuarioId,  $sGblNombreEmpresa, $sGblNombreEmpleado,  $iGblRolId  );
		  while (mysqli_stmt_fetch($stmt)) {
 				$iCantidad = 1;
		  }
               // Cerrar la sentencia preparada de MySQL
        mysqli_stmt_close($stmt);
	}
	else
	{ 
		
	 	$strLink = "location: ./index.php?Err=69";  
	}

	  
		
 if( $iCantidad == 0 ) 
	{ 
		  
	 	$strLink = "location: ./index.php?Err=691"; 
	}
else
	{
	 // Variables de Session
	  $_SESSION['iId']							=		$iGblUsuarioId  ;
	  $_SESSION['sNombreEmpresa']				=		$sGblNombreEmpresa  ; 
	  $_SESSION['sNombreEmpleado']				=		$sGblNombreEmpleado  ;
	  $_SESSION['iRolId']						=		$iGblRolId  ; 
	 
 	$strLink = "location: ./login.php"; 
	}
 
require "./inc/desconectar.php";
?><!DOCTYPE html>
<html lang="es">  
  <head>    
    <title>Ejecucion de Codigo</title>    
    <meta charset="UTF-8">  
    <script> 
         window.location.href = '<?php echo $strLink; ?>';
    </script>
  </head>  
  <body >.</body>  
</html>