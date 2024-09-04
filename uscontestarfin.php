<?php   
require "./inc/settings.php";
require "./inc/funciones.php";  

$sGSessionId = session_id(); 
//Cachamos el IdSesion de la Encuesta.
$iEncuestaId=0;
$sEmpresa="";
$iFechaInicio=0;
$iFechaFin=0;
$sNombreEncuesta=""; $sDescripcion="";  $sMensajeBienvenida="";  $sMensajeFinal=""; 
$sSS=isset( $_GET['SS'] ) ?  Limpieza($_GET['SS']) : '' ;
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

    
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar --> 
		<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <?php require "./inc/topbk.php"; ?>
	   </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
		<?php 
		if($iEncuestaId > 0 )  { 
		?>	
          <!-- Page Heading -->
		  <h1 class=" mb-4 text-gray-800"><center><?php echo $sEmpresa ?></center></h1>
		  <h4 class=" mb-4 text-gray-800"><?php echo $sMensajeFinal ?></h4> 
		  <br>
 
			  <div class="row"> 
        		  <div class="col-lg-12"> 
                 	<div class="form-group row">
                 
                  		<div class="col-sm-12"> <label>&nbsp;</label> 
						
                   	<strong><a href="usencuesta.php?SS=<?php echo $sSS;?>"	  class="btn btn-success btn-user btn-block">..:: Finalizar ::..</a></strong>
						</div>
						
					</div>
					<div class="form-group row"><div class="col-sm-12">&nbsp;</div></div>
				</div>
			</div>
				  
		</form>
		  
		<?php 
		}   else  { 
		?>	
		 <h2 class=" mb-4 text-gray-800">LO SIENTO!!!. La encuesta ya no esta activa.</h2><br>
<?php  echo $ssTxt;
		}    
		?>
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