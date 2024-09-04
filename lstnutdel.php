}<?php   
require "./inc/settings.php";
require "./inc/funciones.php"; 
require "./inc/validasession.php"; 
$iId= isset( $_GET['Id'] ) ?    ($_GET['Id']) : 0 ; 
$iIdU= isset( $_GET['IdU'] ) ?    ($_GET['IdU']) : 0 ; 
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
 
 
 
$NUs_UsuarioId="";$NUs_RolId=""; $NUs_EstadoId=""; $NUs_Usuario="";  $NUs_NombreCorto=""; $NUs_Email=""; $NUs_TotDocumento =0; $NUs_Contrasena="";
$sSQL  = " SELECT    NUs_RolId, NUs_EstadoId, NUs_Usuario,  NUs_NombreCorto, NUs_Email,  NUs_Contrasena "; 
$sSQL .= "  FROM ns_usuarios WHERE NUs_EmpresaId= ? AND NUs_UsuarioId = ?";
$iCantidad= 0 ;
if ($stmt2 = mysqli_prepare($link2, $sSQL))
  {
 		mysqli_stmt_bind_param($stmt2,'ii',$iId,$iIdU);
        mysqli_stmt_execute($stmt2);
		  mysqli_stmt_bind_result($stmt2, $NUs_RolId, $NUs_EstadoId, $NUs_Usuario,  $NUs_NombreCorto, $NUs_Email ,$NUs_Contrasena );
		  while (mysqli_stmt_fetch($stmt2)) {
		  }

        mysqli_stmt_close($stmt2);
 }

?><!DOCTYPE html>
<html lang="en">

<head>
<!-- <?php echo $sSQL. "--$iId,$iIdU-------"; ?> -->
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
            <a href="lstnutricion.php?Id=<?php echo $iId;?>" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-undo fa-sm text-white-50"></i>&nbsp;&nbsp;Regresar</a>
          </div>
 <div class="row">

            <div class="col-lg-12">

              <!-- Default Card Example -->
              <div class="card mb-4">
                <div class="card-header">
                  Actualizar: Usuario / Administrador
                </div>
                <div class="card-body">
                 <!-- form -->
              <form class="FrmPreguntas" action="accnutemp.php" enctype="multipart/form-data" method="post">
			 <input name="IdE" type="hidden" value="<?php  echo $iId; ?>">
			 <input name="Idu" type="hidden" value="<?php  echo $iIdU; ?>">
			 <input name="Usr" type="hidden" value="<?php  echo $NUs_Usuario; ?>">
			 <input name="Cve" type="hidden" value="<?php  echo $NUs_Contrasena; ?>">
			 <input name="Acc" type="hidden" value="C">
			 
				  <div class="row"> 
          <div class="col-lg-12"> 
               <div class="form-group row"> 
                  <div class="col-sm-6"> 
					<label>Nombre Corto</label> 
                  <input type="text" class="form-control " id="Nombre" name="Nombre"  value="<?php  echo $NUs_NombreCorto; ?>" size="50" required>
				  </div>
                  <div class="col-sm-6">
					<label>Correo Electronico </label> 
                  <input type="email" class="form-control " id="Correo" name="Correo"  value="<?php  echo $NUs_Email; ?>"  size="120" >
				  </div>
                </div>
                 <div class="form-group row" > 
				 <div class="col-sm-6">
					<label>Plan Nutricional </label> 
                  <input type="email" class="form-control " id="PN" name="PN" value="<?php  echo $sClave . " - " . $sEmpresa; ?>"  disabled >
				  </div>
                  <div class="col-sm-3">
					<label>Rol</label> 
					 
							<select class="form-control"  name="Rol" id="Rol"  required>
  <option value="1" <?php if($NUs_RolId == 1) { echo " selected "; }?> >Usuario</option>  <option value="2"  <?php if($NUs_RolId == 2) { echo " selected "; }?>  >Administrador</option>  <option value="69"  <?php if($NUs_RolId == 69) { echo " selected "; }?>  >Super Administrador</option> 
</select>  
				  </div>
                  <div class="col-sm-3"> 
					<label>Estado </label> 
						<select class="form-control"  name="Estado" id="Estado"  required>
  <option value="1" <?php if($NUs_EstadoId == 1) { echo " selected "; }?>   >Activo</option>  <option value="0" <?php if($NUs_EstadoId == 0) { echo " selected "; }?>  >Inactivo</option> 
</select> 
				  </div>
                  
                </div>
				  <div class="row"> 
          <div class="col-lg-12"> 
               <div class="form-group row"> 
                  <div class="col-sm-6">
					<label>Usuario</label>  
                  <input type="text" class="form-control " id="Usuario" name="Usuario"  value="<?php  echo $NUs_Usuario; ?>" size="50" disabled>
				  </div>
                  <div class="col-sm-6">																														
					<label>Contrase&ntilde;a </label> 
                  <input type="password" class="form-control " id="Contrasena" name="Contrasena" placeholder="*****"  size="20" >
				  </div>
                </div>
				<div class="form-group row">
                  <div class="col-sm-10"> 
				  <input name="submit" type="submit" value=".:: Actualizar ::."  class="btn btn-success btn-user btn-block">
				  </div>
                  <div class="col-sm-2"> 
				  <input name="submit" type="submit" value=".:: Eliminar ::."  class="btn btn-danger btn-user btn-block">
				  </div>
                </div> 
				  
               
              
          </div>
        </div></form>
				 <!-- form  -->
                </div>
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