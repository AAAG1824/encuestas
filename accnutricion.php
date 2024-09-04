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
$iId=isset( $_POST['Id'] ) ?   Limpieza($_POST['Id']) : 0 ;
if( $iId == 0)
	{
		$iId=isset( $_GET['Id'] ) ?  Limpieza($_GET['Id']) : 0 ; 
	}

$sClave ="";
$iUltimoId = 0;
if($sAcc == 'A' ) // ----------- ALTA DE REGISTRO
	{ 
	$sNombreBreve=isset( $_POST['NombreBreve'] ) ?   Limpieza($_POST['NombreBreve']) : '' ; 
	$sClave=isset( $_POST['Clave'] ) ?   Limpieza($_POST['Clave']) : '' ; 
 	$sEmpresa=isset( $_POST['Empresa'] ) ?   Limpieza($_POST['Empresa']) : '' ; 
	$sDescripcion=isset( $_POST['Descripcion'] ) ?   ($_POST['Descripcion']) : '' ; 
	$sFinal=isset( $_POST['Final'] ) ?   ($_POST['Final']) : '' ; 
	$sFechaInicial=isset( $_POST['FechaInicial'] ) ?   Limpieza($_POST['FechaInicial']) : '' ; 
	$sFechaFinal=isset( $_POST['FechaFinal'] ) ?   Limpieza($_POST['FechaFinal']) : '' ; 
	$iEstado=isset( $_POST['Estado'] ) ?   Limpieza($_POST['Estado']) : 0 ;
	$iFechaInicial = FechaSistema($sFechaInicial,33);
	$iFechaFinal 	= FechaSistema($sFechaFinal,33);
	
	// SUBIMOS EL ARCHIVO
	$sNArchivo="";  $sEArchivo="";
	$iErrUpld = 0;$sRFoto 	="";
	 $sdir=getcwd();
	 $sRutaFile   =	$sdir."/nutricion/logos/";
	 $sRutaEmpresa   =	$sdir."/nutricion/empresas/";
	 if($_FILES['Logotipo']['name'])
		{	
				if(!$_FILES['Logotipo']['error'])
				{ 
					$FileTmp =strtolower($_FILES['Logotipo']['name']); //rename file				  
					// list(  $sNArchivo, $sEArchivo) = split('[.]', $FileTmp);		
					//	$sRFoto 	= $sNArchivo ."_log.".$sEArchivo;	  
				 	 move_uploaded_file($_FILES['Logotipo']['tmp_name'], $sRutaFile.$FileTmp);  
					 $sFilesUpl=$FileTmp;
					 $sRutaEmpresa1="";
				  // INSERTAMOS
				 $sSql  = " INSERT INTO ns_empresas( EstadoId, Clave,Empresa,FechaInicio, FechaFin,  Descripcion, Logotipo, FechaAlta,   ";
				$sSql .= " UsuarioId) VALUES ( ?,?,?,?,?,?,?,$GblFechaHora,$iGblUsuarioId) ";
				if ($stmt = mysqli_prepare($link, $sSql))
					 { 
						mysqli_stmt_bind_param($stmt, 'issiiss',$iEstado,$sClave,$sEmpresa,$iFechaInicial ,$iFechaFinal, $sDescripcion, $sFilesUpl );
		  				mysqli_stmt_execute($stmt); 
						// Obtener la última ID insertada
						$iUltimoId = mysqli_insert_id($link); 
						 $sRutaEmpresa1  =$sRutaEmpresa."F_".$sClave."/E_".ZerosIzq($iUltimoId,10)."/";
						 $sRutaEmpresa2  =$sRutaEmpresa."F_".$sClave."/";
						 if (!file_exists($sRutaEmpresa1)) {
								mkdir($sRutaEmpresa1, 0777, true);
								 $srcfile=  $sRutaEmpresa. "index.php";
								 $dstfile1=	$sRutaEmpresa1. "index.php";
								 $dstfile2=	$sRutaEmpresa2. "index.php";
								// mkdir(dirname($dstfile), 0777, true); 
								 copy($srcfile, $dstfile2);
							}
						// Cerrar la sentencia preparada de MySQL
						mysqli_stmt_close($stmt); 
					  }
				 
				if($iUltimoId>0)
					{ 
					header("location: nutricion.php");
					exit();
					}  
		 
				}	 
			}
			else
				{
				$iErrUpld = 1; 
				header("location: nutricion.php?Err=69");
				exit();
				}
	
	}
if($sAcc == 'C')
{
 
	$sClave=isset( $_POST['Clave'] ) ?   Limpieza($_POST['Clave']) : '' ; 
 	$sEmpresa=isset( $_POST['Empresa'] ) ?   Limpieza($_POST['Empresa']) : '' ; 
	$sDescripcion=isset( $_POST['Descripcion'] ) ?   ($_POST['Descripcion']) : '' ; 
	$sArchivoAnt=isset( $_POST['ArchivoAnt'] ) ?   ($_POST['ArchivoAnt']) : '' ; 
	$sFechaInicial=isset( $_POST['FechaInicial'] ) ?   Limpieza($_POST['FechaInicial']) : '' ; 
	$sFechaFinal=isset( $_POST['FechaFinal'] ) ?   Limpieza($_POST['FechaFinal']) : '' ; 
	$iEstado=isset( $_POST['Estado'] ) ?   Limpieza($_POST['Estado']) : 0 ;
	$iFechaInicial = FechaSistema($sFechaInicial,33);
	$iFechaFinal 	= FechaSistema($sFechaFinal,33);
	// SUBIMOS EL ARCHIVO
	$sNArchivo="";  $sEArchivo="";
	$iErrUpld = 0;$sRFoto 	="";
	 $sdir=getcwd();
	 $sRutaFile   =	$sdir."/nutricion/logos/"; 
	 $sArchivoNew = $_FILES['Logotipo']['name'];
	 
 	if(trim($sArchivoNew) != ""   ) 
	{
	 if($_FILES['Logotipo']['name'])
		{	
		
		if(!$_FILES['Logotipo']['error'])
				{ 
					$FileTmp =strtolower($_FILES['Logotipo']['name']); //rename file				  
					// list(  $sNArchivo, $sEArchivo) = split('[.]', $FileTmp);		
					//	$sRFoto 	= $sNArchivo ."_log.".$sEArchivo;	  
				 	 move_uploaded_file($_FILES['Logotipo']['tmp_name'], $sRutaFile.$FileTmp);  
					 $sFilesUpl=$FileTmp;
					 $sRutaEmpresa1="";
					 
					 // Actualizamos
					 $sSQL  = " UPDATE ns_empresas SET EstadoId=?, Empresa=?,FechaInicio=?, FechaFin=?,  Descripcion=?, Logotipo=?,FechaAlta=$GblFechaHora";
					 $sSQL .= " ,UsuarioId =$iGblUsuarioId WHERE Nutriciond = ? ";
					  
			 if ($stmt = mysqli_prepare($link, $sSQL))
				 {
						mysqli_stmt_bind_param($stmt, 'isiissi',$iEstado,$sEmpresa,$iFechaInicial ,$iFechaFinal, $sDescripcion, $sFilesUpl ,$iId );  
					mysqli_stmt_execute($stmt); 
					mysqli_stmt_close($stmt);  
					header("location: nutricion.php");
					exit();
					
				  }
					   
			 
		 
				}	 
		
		}	
			
	}
	else
	{ 
	
	 // Actualizamos
					 $sSQL  = " UPDATE ns_empresas SET EstadoId=?, Empresa=?,FechaInicio=?, FechaFin=?,  Descripcion=?,  FechaAlta=$GblFechaHora,UsuarioId =$iGblUsuarioId WHERE Nutriciond = ? ";
			 if ($stmt = mysqli_prepare($link, $sSQL))
				 {
						mysqli_stmt_bind_param($stmt, 'isiisi',$iEstado,$sEmpresa,$iFechaInicial ,$iFechaFinal, $sDescripcion, $iId );  
					mysqli_stmt_execute($stmt); 
					mysqli_stmt_close($stmt);  
					header("location: nutricion.php");
					exit();
					
				  }
					   
	}
}	
$sEliminados =" NADA ";
if($sAcc == 'B' ) // ----------- ELIMINAR DE REGISTRO
{
 		
		$sClave=isset( $_GET['C'] ) ?  Limpieza($_GET['C']) : "" ; 
		$sLogo=isset( $_GET['L'] ) ?  Limpieza($_GET['L']) : "" ; 
		$sClave=   "F_" .$sClave;
 
	 $sdir=getcwd();
	 $sRutaFile   =	$sdir."/nutricion/logos/";
	 $sRutaFile  .= $sLogo;
	 unlink($sRutaFile);
	 $sRutaEmpresa   =	$sdir."/nutricion/empresas/" . $sClave ;
	 echo $sRutaEmpresa;
	 
 	 EliminarFolderCompleto( $sRutaEmpresa );
 
 
	 // extramos el directorio
 
	// ELIMINAMOS LOS USUARIOS
	$sSQL  = " DELETE FROM ns_usuarios WHERE NUs_EmpresaId = ? ";
			 if ($stmt = mysqli_prepare($link, $sSQL))
				 {
					mysqli_stmt_bind_param($stmt, 'i',$iId ); 
					mysqli_stmt_execute($stmt); 
					mysqli_stmt_close($stmt);  
					
				  }
	
	// eLIMINAMOS EL PROYECTO		
	$sSQL  = " DELETE FROM ns_empresas WHERE Nutriciond = ? ";
			 if ($stmt = mysqli_prepare($link, $sSQL))
				 {
					mysqli_stmt_bind_param($stmt, 'i',$iId ); 
					mysqli_stmt_execute($stmt); 
					mysqli_stmt_close($stmt);  
					
				  }
	
	// ELIMNAMOS LOS ARCHIVOS	
	$sSQL  = " DELETE FROM ns_seguimiento WHERE NSg_EmpresaId = ? ";
			 if ($stmt = mysqli_prepare($link, $sSQL))
				 {
					mysqli_stmt_bind_param($stmt, 'i',$iId ); 
					mysqli_stmt_execute($stmt); 
					mysqli_stmt_close($stmt);  
					
				  }
	
	 header("location: nutricion.php");
 	exit();
				 
}
 
ob_end_flush();
require "./inc/desconectar.php";
?>