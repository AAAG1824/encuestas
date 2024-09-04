<?php  

$iGId=0;
$iGPuestoId=0;
$sGPuesto='';
$iGTipoUsuarioId=0;
$sGTipoUsuario='';
$sGPermisos='';
$sGNombreEmpleado='';
$sGCorreoElectronico='';
$iGAdministrador=0;
$iGFechaCumpleanos=0;
$iGEstadoId=0;
$iGFechaIngresoEmpresa=0;
$sGFoto=''; 
$sGSessionId = session_id(); 

if(empty($sGSessionId))
	{ 
	$sGSessionId = session_id();
	}
 
if(isset($_SESSION['iId']))
		{    
		  	
		 	 
			 // Variables de Session
			 
$iGblUsuarioId					= $_SESSION['iId'];
$sGblNombreEmpresa				= $_SESSION['sNombreEmpresa'];
$sGblNombreEmpleado				= $_SESSION['sNombreEmpleado'];
$iGblRolId 						= $_SESSION['iRolId'];

  
		 
		}
else
		{
		header("location: ../index.php?MEr=69");
		exit();
		}


 
?>
