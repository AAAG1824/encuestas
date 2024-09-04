<?php   
require "./inc/settings.php";
require "./inc/funciones.php"; 
require "./inc/validasession.php"; 
   $EstadoId=''; $Clave=''; $Empresa=''; $FechaInicio=''; $FechaFin=''; $Descripcion=''; $Logotipo=''; 
$iId= isset( $_GET['Id'] ) ?    ($_GET['Id']) : 0 ; 
   
$sSQL  = "SELECT  EstadoId, Clave, Empresa, FechaInicio, FechaFin, Descripcion, Logotipo ";
$sSQL .= "FROM ns_empresas WHERE  Nutriciond = ? ";

if ($stmt = mysqli_prepare($link, $sSQL))
  {
 		mysqli_stmt_bind_param($stmt,'i',$iId);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,$EstadoId, $Clave, $Empresa, $FechaInicio, $FechaFin, $Descripcion, $Logotipo );
		  while (mysqli_stmt_fetch($stmt)) {}
      			  mysqli_stmt_close($stmt); 
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
            <h1 class="h3 mb-2 text-gray-800">Editar Plan Nutricion</h1> 
            <a href="nutricion.php" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-undo fa-sm text-white-50"></i>&nbsp;&nbsp;Regresar</a>
          </div>
 <div class="row">

            <div class="col-lg-12">

              <!-- Default Card Example -->
              <div class="card mb-4">
                <div class="card-header">
                  Editar Plan Nutricion
                </div>
                <div class="card-body">
                 <!-- form -->
              <form class="FrmPreguntas" action="accnutricion.php" enctype="multipart/form-data" method="post">
			 <input name="Id" type="hidden" value="<?php echo $iId;?>">
			 <input name="Acc" type="hidden" value="C">
			 <input name="ArchivoAnt" type="hidden" value="<?php echo $Logotipo;?>">
			 <input name="Clave" type="hidden" value="<?php echo $Clave;?>">
			 
				  <div class="row"> 
          <div class="col-lg-12"> 
               <div class="form-group row"> 
                  <div class="col-sm-3">
					<label>Clave</label> 
                  <input type="text" class="form-control " id="Clave" name="Clave" value="<?php echo  $Clave; ?>" size="20" disabled>
				  </div>
                  <div class="col-sm-9">
					<label>Empresa</label> 
                  <input type="text" class="form-control " id="Empresa" name="Empresa"   required  value="<?php echo  $Empresa; ?>" >
				  </div>
                </div>
              
                <div class="form-group row" >
                  <div class="col-sm-12">
					<label>Descripci&oacute;n</label> 
                	<textarea name="Descripcion" id="Descripcion" class="form-control"  rows="3" required><?php echo  $Descripcion; ?></textarea>
				  </div>
                </div>
				 
				 
                
				  <div class="form-group row" >
                  <div class="col-sm-6">
					<label>Fecha Inicial</label> 
                	 <input type="date" name="FechaInicial" id="FechaInicial" class="form-control" value ="<?php echo FechaSistema($FechaInicio,35);?>"   required>
				  </div>
                  <div class="col-sm-6">
					<label>Fecha Final</label> 
                	 <input type="date" name="FechaFinal" id="FechaFinal" class="form-control" value ="<?php echo FechaSistema($FechaFin,35);?>"   required> 
				  </div>
                 </div>
				 <div class="form-group row" >
                  <div class="col-sm-8">
					<label>Logotipo (214px x 72px)</label> <a href="#" target="_blank"  data-toggle="modal" data-target="#MdVW" >Ver Imagen</a>
					<input type="file" id="Logotipo" name="Logotipo" class="form-control"       /> 
				  </div>
                  <div class="col-sm-4"> 
					<label>Estado</label>
						<select class="form-control"  name="Estado" id="Estado"  required   <?php if($Clave == "NOBORRAR") { echo " disabled ";}?>  >
  <option value="1"  <?php if($EstadoId == 1) { echo " selected "; } ?> >Activo</option>  <option value="0"  <?php if($EstadoId == 0) { echo " selected "; } ?>  >Inactivo</option> 
</select> 
				  </div>
                  
                </div>
				 
				<div class="form-group row">
                  <div class="col-sm-10"> 
				  <input name="submit" type="submit" value=".:: Actualizar ::."  class="btn btn-primary btn-user btn-block">
				  </div> 
                  <div class="col-sm-2"> 
				  <input name="submit" type="button" value=".:: Eliminar ::."  data-toggle="modal" data-target="#MdDel" 
				  <?php if($Clave == "NOBORRAR") { echo " disabled ";}?> class="btn btn-danger btn-user btn-block">
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

  <!--- Modal Ver Historial -- INI -->
  	  
<!-- Logout Modal : upload -->
  <div class="modal fade" id="MdVW" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelMdVW" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content"  style="width: 700px">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabelMdVW">IMGEN</span></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" style="height: 150px"><br><center>
			<img src="./nutricion/logos/<?php echo $Logotipo;?>" width="214px" height="72px"></center>
			
		</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button> 
        </div>
      </div>
    </div>
  </div>
  
  
  
					   <!-- Logout Modal-->
  <div class="modal fade" id="MdDel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Mensaje</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Deseas Eliminar  el Plan de Nutricion.<br> Incluyendo toda la informacion su historial de archivos de los pacientes?</strong>
		</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
          <a class="btn btn-primary" href="accnutricion.php?Acc=B&C=<?php echo  $Clave; ?>&L=<?php echo  $Logotipo; ?>&Id=<?php echo $iId;?>">Si</a>
        </div>
      </div>
    </div>
  </div>
  <!--- Modal Ver Historial -- FIN -->
  
  
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