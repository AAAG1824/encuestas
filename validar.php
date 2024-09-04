<?php   
ob_start();
require "./inc/settings.php";
require "./inc/funciones.php"; 
 

$iGblUsuarioId=0;
$sGblNombreEmpresa="";
$sGblNombreEmpleado="";
$iGblRolId = "";
$iCantidad = 0;
$iGblEncuestasId = 0;
$iGblNutricionId = 0;
$iGblDocumentacionId = 0;
$iGblServicioEId = 0;
$iGblitacorasId = 0;
$iGblAdministracionId=0;
$iEsAdmin = 0;
//
$sPsw1=isset( $_POST['exampleInputPassword'] ) ?  $_POST['exampleInputPassword'] : '' ; 
$sPsw=md5($sPsw1);
$sUsuarioSistema1=isset( $_POST['exampleInputEmail'] ) ?   Limpieza($_POST['exampleInputEmail']) : '' ;
$sUsuarioSistema  = trim($sUsuarioSistema1);

$sSQL  = " SELECT UsuarioId,  NombreEmpresa, NombreEmpleado,  RolId, Encuestas, Nutricion, Documentacion, ServicioEmpresarial, Bitacoras, Administracion   FROM ts_usuarios WHERE EstadoId = 1 AND  CorreoElectronico = ? AND Contrasena = ?  ";
 
if ($stmt = mysqli_prepare($link, $sSQL))
  {
			mysqli_stmt_bind_param($stmt,'ss',$sUsuarioSistema,$sPsw);
			mysqli_stmt_execute($stmt);
			  mysqli_stmt_bind_result($stmt,$iGblUsuarioId,  $sGblNombreEmpresa, $sGblNombreEmpleado,  $iGblRolId,$iGblEncuestasId, $iGblNutricionId, $iGblDocumentacionId, $iGblServicioEId, $iGblitacorasId ,$iGblAdministracionId  );
			  while (mysqli_stmt_fetch($stmt)) {
			$iCantidad = 1;
			$iEsAdmin = 1;
			  }
				   // Cerrar la sentencia preparada de MySQL
			mysqli_stmt_close($stmt);
	}
	else
	{ 
		
	$iEsAdmin = 0;
//	 	header("location: index.php?Err=69");
//		exit();
	}

 if( $iCantidad == 0 ) 
	{ 
		
$iEsAdmin = 0;  
	 //	header("location: index.php?Err=691");
	//	exit();
	}
else
	{
	 // Variables de Session
	  $_SESSION['iId']							=		$iGblUsuarioId  ;
	  $_SESSION['sNombreEmpresa']				=		$sGblNombreEmpresa  ; 
	  $_SESSION['sNombreEmpleado']				=		$sGblNombreEmpleado  ;
	  $_SESSION['iRolId']						=		$iGblRolId  ; 	 
	  $_SESSION['iEncId']						=		$iGblEncuestasId ;
	  $_SESSION['iNutId']						=		$iGblNutricionId ;
	  $_SESSION['iDocId']						=		$iGblDocumentacionId ;
	  $_SESSION['iSerId']						=		$iGblServicioEId ;
	  $_SESSION['iBitId']						=		$iGblitacorasId ;
 	  $_SESSION['iAdmId']						=		$iGblAdministracionId ;
	 	header("location: encuestas.php");
		exit();
	}
	
	$iCantidad = 0;
 if( $iEsAdmin == 0 ) 
	{ 	
			$sSQL  = " SELECT NUs_UsuarioId,NUs_EmpresaId,Clave,Empresa, Logotipo,NUs_RolId, NUs_NombreCorto, NUs_Email ";
			$sSQL .= "  FROM ns_usuarios INNER JOIN ns_empresas ON Nutriciond = NUs_EmpresaId  ";
			$sSQL .= "  WHERE NUs_EstadoId = 1 AND  NUs_Usuario = ? AND NUs_Contrasena = ? ";
			$iCantidad = 0; 
			$sSegui  ="";
			if ($stmt = mysqli_prepare($link, $sSQL))
			  {
					mysqli_stmt_bind_param($stmt,'ss',$sUsuarioSistema,$sPsw);
					  mysqli_stmt_execute($stmt); 
					  mysqli_stmt_bind_result($stmt, $NUs_UsuarioId, $NUs_EmpresaId, $sClave, $sEmpresa,  $sLogotipo, $NUs_RolId,  $NUs_NombreCorto, $NUs_Email); 
					  while (mysqli_stmt_fetch($stmt)) { 
							$iCantidad = 1;
					  } 	          // Cerrar la sentencia preparada de MySQL
        mysqli_stmt_close($stmt);
	  		 }
		if( $iCantidad > 0 ) 
		{
			 // Ya existe  
			  $_SESSION['NUs_UsuarioId']							=		$NUs_UsuarioId  ;
			  $_SESSION['NUs_Clave']								=		$sClave  ; 
			  $_SESSION['NUs_Empresa']								=		$sEmpresa  ;
			  $_SESSION['NUs_RolId']								=		$NUs_RolId  ; 	 
			  $_SESSION['NUs_Email']								=		$NUs_Email ;
			  $_SESSION['NUs_NombreCorto']							=		$NUs_NombreCorto ;
			  $_SESSION['NUs_EmpresaId']							=		$NUs_EmpresaId ; 
			  $_SESSION['NUs_Logotipo']								=		$sLogotipo ; 
			 header("Location: ./encuestas/index.php"); 
			 exit();
		 
			 
			} else // Esta en proceso el registro
				{  
								 header("location: ./index.php?Er=NoExiste");	
								 exit();
				}

		}	 
//

require "./inc/desconectar.php";
ob_end_flush();
?>