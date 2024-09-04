<?php   
require "./inc/settings.php";
require "./inc/funciones.php"; 
require "./inc/validasession.php";  
$iId= isset( $_GET['Id'] ) ?    ($_GET['Id']) : 0 ; 
  $sEmpresa='';
  $sLogo='';
  $sClave='';   
$sSQL = " SELECT  Empresa ,Clave,  Logotipo  FROM  ns_empresas  WHERE   Nutriciond  = ? "; 
if ($stmt2 = mysqli_prepare($link2, $sSQL))
  {
 		mysqli_stmt_bind_param($stmt2,'i',$iId);
        mysqli_stmt_execute($stmt2);
		  mysqli_stmt_bind_result($stmt2, $sEmpresa,$sClave,$sLogo );
		  while (mysqli_stmt_fetch($stmt2)) {
		  }
        mysqli_stmt_close($stmt2);
 }
?><!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $GblNomSistema;?></title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand --> 
	  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#"> <div class="sidebar-brand-icon"><img src="img/logobco.png"></div></a>
 	<!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="login.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Inicio</span></a>
      </li>
  <?php if( $iGblRolId  >  0 ) require "./inc/mnu.php"; ?> <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar --> 
		<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <?php require "./inc/top.php"; ?>
	   </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
         <!-- Page Heading -->
         
<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-2 text-gray-800"><?php  echo $sEmpresa; ?></h1>  
            <a href="nutricion.php" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-undo fa-sm text-white-50"></i>&nbsp;&nbsp;Regresar</a> 
          </div>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3"> <a href="addnutemp.php?Id=<?php echo $iId;?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i>&nbsp;&nbsp;Agregar Usuario/Administrador</a> 
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Tipo Empleado </th> 
                      <th>Empleado </th> 
                      <th>Correo Electronico</th> 
                      <th>No. Doc.</th> 
                      <th>Estado</th> 
                      <th></th>   
                    </tr>
                  </thead>
                  <tbody>
<?php 
$NUs_UsuarioId="";$NUs_RolId=""; $NUs_EstadoId=""; $NUs_Usuario="";  $NUs_NombreCorto=""; $NUs_Email=""; $NUs_TotDocumento =0;
$sSQL  = " SELECT NUs_UsuarioId,   NUs_RolId, NUs_EstadoId, NUs_Usuario,  NUs_NombreCorto, NUs_Email";
$sSQL .= " ,(SELECT COUNT( NSg_SeguimientoId ) FROM ns_seguimiento WHERE NSg_UsuarioId =NUs_UsuarioId AND  NSg_EmpresaId=NUs_EmpresaId) AS TotDoc ";
$sSQL .= "  FROM ns_usuarios WHERE NUs_EmpresaId= ? ORDER BY NUs_EstadoId DESC, NUs_RolId";
$iCantidad= 0 ;
if ($stmt = mysqli_prepare($link, $sSQL))
  {
 		mysqli_stmt_bind_param($stmt,'i',$iId);
        mysqli_stmt_execute($stmt);
		  mysqli_stmt_bind_result($stmt,$NUs_UsuarioId,$NUs_RolId, $NUs_EstadoId, $NUs_Usuario,  $NUs_NombreCorto, $NUs_Email,$NUs_TotDocumento );
		  while (mysqli_stmt_fetch($stmt)) {
		   
	 
	// Calculos Finales
	
?>  <tr> <td><?php echo  $NUs_UsuarioId; ?></td>
    <td><?php if($NUs_RolId == 1 ) { echo  "Empleado"; } else  { echo "Administrador"; } ?></td>
    <td><?php echo  $NUs_NombreCorto; ?></td>
    <td><?php echo  $NUs_Email; ?></td>
    <td><?php echo  $NUs_TotDocumento; ?></td>
    <td><?php if($NUs_EstadoId == 1 ) {echo  "Activo"; } else { echo "Inactivo";} ?></td> 
               
    <td><a href="#" class="btn btn-primary btn-circle btn-sm"  title="Ver Historial de Archivos"  data-toggle="modal" data-target="#MdVW-<?php echo $NUs_UsuarioId;?>" ><i class="fas fa-list"></i></a> <a href="#" class="btn btn-dark btn-circle btn-sm"  title="Cargar Documento"  data-toggle="modal" data-target="#MdUpl-<?php echo $NUs_UsuarioId;?>" ><i class="fas fa-upload"></i></a>  
	<a href="lstnutdel.php?Id=<?php echo $iId;?>&IdU=<?php echo $NUs_UsuarioId;?>" class="btn btn-danger btn-circle btn-sm"  title="Editar Usuario"  ><i class="fas fa-pen"></i></a>
	 </td>  
					  </tr> 
					  
					  
<!-- Logout Modal : upload -->
  <div class="modal fade" id="MdUpl-<?php echo $NUs_UsuarioId;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cargar archivo a: <span class="text-success"><?php echo  $NUs_NombreCorto; ?></span></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
		<form  class="FrmNutricion" action="accnutricionu.php" enctype="multipart/form-data" method="post">
			 <input name="IdU" type="hidden" value="<?php echo $NUs_UsuarioId;?>">
			 <input name="IdE" type="hidden" value="<?php echo $iId;?>">
			 <input name="Cve" type="hidden" value="<?php echo $sClave;?>">
		  <input name="Acc" type="hidden" value="A">
		
		 <div class="row">  
                  <div class="col-sm-6">
				  <div class="form-group">
					<label>A&ntilde;o</label> 
                  <input type="number" class="form-control " id="Anio" name="Anio"   min="<?php echo date("Y")-1; ?>" max="<?php echo date("Y")+3; ?>" value="<?php echo date("Y"); ?>"  required>
				  </div>
                </div>
                  <div class="col-sm-6">
				  <div class="form-group">
					<label>Semana</label> 
                  <input type="number" class="form-control " id="Semana" name="Semana"   min="1" max="54" value="<?php echo date("W"); ?>"  required>
				  </div>
                </div>
		 </div> 
		 <div class="row">  
                  <div class="col-sm-12">
				  <div class="form-group">
					<label>Tipo Documento</label> 
                   <select name="TipoDocumento"  required     class="form-control" > 
					  <?php
					  $intTId=0;
					  $strTName ='';
					   $seleccionado = '';
					  $sSqlCB = "SELECT NTa_TipoArchivoId,NTa_TipoArchivo FROM ns_tipoarchivo WHERE NTa_EstadoId =1 ORDER BY NTa_TipoArchivo";
					 if ($stmt2 = mysqli_prepare($link2, $sSqlCB )) {
				            mysqli_stmt_execute($stmt2);
						 	mysqli_stmt_bind_result($stmt2,$intTId,$strTName);
							while (mysqli_stmt_fetch($stmt2)) 
												{
												$strTName = LimpiezaMayusculas($strTName); 
							      echo "<option value=$intTId   >$strTName</option>";
							
												}
      			  mysqli_stmt_close($stmt2);
												
															}
					  ?> 
                      </select>  
				  </div>
                </div>
                   
		 </div>
		 <div class="row">  
                  <div class="col-sm-12"> 
				  <div class="form-group">
					<label>Observaci&oacute;n Breve</label> 
                  <textarea rows="2" class="form-control " id="Observacion" name="Observacion"    ></textarea>
				  </div>
                </div>
		 </div>
		 <div class="row">  
                  <div class="col-sm-12"> 
				  <div class="form-group">
					<label>Documento</label> 
                  <input type="file" id="Documento" name="Documento" class="form-control" required   /> 
				  </div>
                </div>
		 </div>
		 <div class="row">  
                  <div class="col-sm-12"> 
				  
				  <input name="submit" type="submit" value=".:: Cargar Archivo ::."  class="btn btn-primary btn-user btn-block">
                </div>
		 </div>
		 </form>
		</div>
         
      </div>
    </div>
  </div>
  
  <!--- Modal Ver Historial -- INI -->
  	  
<!-- Logout Modal : upload -->
  <div class="modal fade" id="MdVW-<?php echo $NUs_UsuarioId;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelMdVW" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content"  style="width: 700px">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabelMdVW">Historial: <span class="text-success"><?php echo  $NUs_NombreCorto; ?></span></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
		 	<iframe frameborder="0" src="./nutricion/lstnutricion2.php?IdE=<?php echo $iId;?>&Id=<?php echo $NUs_UsuarioId;?>" id="FrmUsuario" height="400px" width="98%" scrolling="auto" />
         </iframe>
      </div>
    </div>
  </div>
  <!--- Modal Ver Historial -- FIN -->
  
  
  
<?php 

  		$iCantidad = 1;
		  }
               // Cerrar la sentencia preparada de MySQL
        mysqli_stmt_close($stmt);
   }
   if($iCantidad == 0 )
   {?>
    <tr >
    <td colspan="9">ES NECESARIO QUE REGISTRE INFORMACI&Oacute;N </td>
  </tr> 
 
<?php }?>								  
				</tbody>
				</table>
			</div>
</div></div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer --> 
        <?php require "./inc/pie.php"; ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

 

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
<?php
require "./inc/desconectar.php";
?>