<?php    ob_start();  
require "./inc/settings.php";
require "./inc/funciones.php"; 
require "./inc/validasession.php"; 
 $sdir = "";
echo "<pre>";
print_r($_POST);
echo "</pre>";

$sAcc=isset( $_POST['Acc'] ) ?  Limpieza($_POST['Acc']) : '' ; 
if( $sAcc == '')
	{
		$sAcc=isset( $_GET['Acc'] ) ?  Limpieza($_GET['Acc']) : '' ; 
	}
	
$iId=isset( $_POST['IdE'] ) ?   Limpieza($_POST['IdE']) : 0 ;
if( $iId == 0)
	{
		$iId=isset( $_GET['IdE'] ) ?  Limpieza($_GET['IdE']) : 0 ; 
	} 

$iIdC=isset( $_POST['Cve'] ) ?   Limpieza($_POST['Cve']) : '' ;
if( $iIdC == '')
	{
		$iIdC=isset( $_GET['Cve'] ) ?  Limpieza($_GET['Cve']) : '' ; 
	}
	
$sClave ="";
$iUltimoId = 0;
if($sAcc == 'A' ) // ----------- ALTA DE REGISTRO
	{ 
	 
	
						$iCantidad=0;
	$sNombres		= isset( $_POST['Nombre'] ) ?   Limpieza($_POST['Nombre']) : '' ; 
	$sCorreo		= isset( $_POST['Correo'] ) ?   Limpieza($_POST['Correo']) :'' ; 
	$iRol			= isset( $_POST['Rol'] ) ?   Limpieza($_POST['Rol']) : 0 ; 
	$iEstado		= isset( $_POST['Estado'] ) ?   Limpieza($_POST['Estado']) : 0 ;
	$sUsuario		= isset( $_POST['Usuario'] ) ?   Limpieza($_POST['Usuario']) : '' ; 
	$sContrasena	= isset( $_POST['Contrasena'] ) ?   Limpieza($_POST['Contrasena']) : '' ; 
	$sSql  = " INSERT INTO ns_usuarios(  NUs_EmpresaId, NUs_RolId, NUs_EstadoId, NUs_Usuario, NUs_Contrasena, NUs_NombreCorto, NUs_Email, NUs_Fecha, NUs_UsuarioAltaId)";
	$sSql .= " VALUES ( ?,?,?,?,md5(?),?,?, $GblFechaHora,$iGblUsuarioId) ";
	if ($stmt = mysqli_prepare($link, $sSql))
					 { 
						mysqli_stmt_bind_param($stmt, 'iiissss',$iId,$iRol,$iEstado,$sUsuario ,$sContrasena, $sNombres, $sCorreo );
		  				mysqli_stmt_execute($stmt); 
						// Obtener la última ID insertada
						$iCantidad=1;
						$iUltimoId = mysqli_insert_id($link);
					 	$sdir=getcwd(); 
						
						$sRutaEmpresa   =	$sdir."/nutricion/empresas/";
						$sRutaEmpresa1  =$sRutaEmpresa."F_".$iIdC."/E_".ZerosIzq($iUltimoId,10)."/";
						$sRutaEmpresa2  =$sRutaEmpresa."F_".$iIdC."/"; 
						// die($sRutaEmpresa1 . "<br>" .$sRutaEmpresa2 );
						if (!file_exists($sRutaEmpresa1)) {
													mkdir($sRutaEmpresa1, 0777, true);
													 $srcfile=  $sRutaEmpresa2. "index.php";
													 $dstfile1=	$sRutaEmpresa1. "index.php";
								 					 copy($srcfile, $dstfile1);
													 
													}
						// Cerrar la sentencia preparada de MySQL
						mysqli_stmt_close($stmt); 
			 
			// Insertar registro FIN
			}
			if($iUltimoId>0)
					{ 
					header("location: lstnutricion.php?Id=$iId");
					exit();
					} 
			else 
					{ 
					header("location: lstnutricion.php?Id=$iId&Err=NO SE REGISTRO EL EMPLEADO");
					exit();
					} 
	
	}

else if($sAcc == 'C' ) // ----------- ALTA DE REGISTRO
	{ 
	$iCantidad=0; 
	$idUsr			= isset( $_POST['Idu'] ) ?   Limpieza($_POST['Idu']) : '' ; 
	$sNombres		= isset( $_POST['Nombre'] ) ?   Limpieza($_POST['Nombre']) : '' ; 
	$sCorreo		= isset( $_POST['Correo'] ) ?   Limpieza($_POST['Correo']) :'' ; 
	$iRol			= isset( $_POST['Rol'] ) ?   Limpieza($_POST['Rol']) : 0 ; 
	$iEstado		= isset( $_POST['Estado'] ) ?   Limpieza($_POST['Estado']) : 0 ;
	$sUsuario		= isset( $_POST['Usr'] ) ?   Limpieza($_POST['Usr']) : '' ; 
	$sContrasena	= isset( $_POST['Contrasena'] ) ?   Limpieza($_POST['Contrasena']) : ''  ; 
	$Cve			= isset( $_POST['Cve'] ) ?   Limpieza($_POST['Cve']) : '' ; 
	$sSubmit 		= isset( $_POST['submit'] ) ?   Limpieza($_POST['submit']) : '' ; 
	$sqlContrasena="";
 
	if(trim($sSubmit) != ".:: Eliminar ::.") // ----------- Actualizamos
			{ 
		
				if(trim($sContrasena) != "")
				{				
				if(trim(md5($sContrasena)) != $Cve ) {
					$sqlContrasena="  NUs_Contrasena=?,";}
				else {	$sqlContrasena=""; }
				
				} 
			 	$sSQL  = " UPDATE ns_usuarios SET   NUs_RolId=?, NUs_EstadoId=?, NUs_Usuario=?, $sqlContrasena NUs_NombreCorto=?, NUs_Email=?,";
			$sSQL .= " NUs_Fecha=$GblFechaHora, NUs_UsuarioAltaId=$iGblUsuarioId  WHERE  NUs_UsuarioId = ?";
		
				if ($stmt = mysqli_prepare($link, $sSQL))
				 {
				 	if($sqlContrasena=="")
						{
						
	  	// die("1.----".	$sSQL ."--->" .trim(md5($sContrasena)) ." =?= " .$Cve);
					 mysqli_stmt_bind_param($stmt, 'iisssi',$iRol ,$iEstado,$sUsuario,$sNombres,$sCorreo,$idUsr); 
					 
							
						}
					else
						{
			
		//  die("2s.----".	$sSQL ."--->" .trim(md5($sContrasena)) ." =?= ". $Cve);			 
		  $sContrasena = md5($sContrasena);
					 	mysqli_stmt_bind_param($stmt, 'iissssi',$iRol ,$iEstado,$sUsuario,$sContrasena,$sNombres,$sCorreo,$idUsr); 
						}
			 mysqli_stmt_execute($stmt); 
					mysqli_stmt_close($stmt);  
					
							header("location: lstnutricion.php?Id=$iId");
							exit();
			
		 
				  }
			 
			}
	else   // ----------- Borramos
			{	  
			
	$sSQL  = " DELETE FROM ns_usuarios WHERE NUs_UsuarioId = ? ";
			 if ($stmt = mysqli_prepare($link, $sSQL))
				 {
					mysqli_stmt_bind_param($stmt, 'i',$idUsr ); 
					mysqli_stmt_execute($stmt); 
					mysqli_stmt_close($stmt);  
					
							header("location: lstnutricion.php?Id=$iId");
							exit();
				  }
	//	$iIdS $iId 
			}
	
//	header("location: lstnutricion.php?Id=$iId");
	exit();
	}
	 	


 
ob_end_flush();
require "./inc/desconectar.php";
?>