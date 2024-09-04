<?php   
ob_start();
require "./inc/settings.php";
require "./inc/funciones.php"; 
require "./inc/validasession.php"; 
$iEstadoSiguienteId = 0;

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
            <h1 class="h3 mb-2 text-gray-800">Encuestas</h1> 
            <a href="addencuestas.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i>&nbsp;&nbsp;Agregar</a>
          </div>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Encuestas</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Clave</th>
                      <th>Empresa </th> 
                      <th>Encuesta </th> 
                      <th>Vigencia</th> 
                      <th>En<br> Proceso</th> 
                      <th>Finalizadas</th>   
                      <th>Nivel</th> 
                      <th>Estado</th> 
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$iEncuestaId = 0;
$iEstadoId = 0;
$sEmpresa = '';
$iFechaInicio = 0;
$iFechaFin = 0;
$sNombreEncuesta = '';
$sDescripcion = '';
$sMensajeBienvenida = '';
$sMensajeFinal = '';
$iTotalEncuestaFinalizadas = 0;
$iNivelEncuesta=0;
$sClave = "";
$iTotalPreguntasAsignadas = 0;$iTotalEncuestaProceso = 0;
$sSql  =	"SELECT e.EncuestaId, e.EstadoId,e.NivelEncuesta,e.Clave,e.Empresa, e.FechaInicio, e.FechaFin, e.NombreEncuesta, e.Descripcion, e.MensajeBienvenida, e.MensajeFinal,";
$sSql .=	"(SELECT count(distinct eu.NoNomina) FROM  ts_encuestausuarios eu where eu.EstadoId = 2 and eu.EncuestaId = e.EncuestaId ) as TotalEncuestaF ,";
$sSql .=	"(SELECT count(distinct eu.NoNomina) FROM  ts_encuestausuarios eu where eu.EstadoId = 1 and eu.EncuestaId = e.EncuestaId ) as TotalEncuestaP ,0 as TotalPregAsig FROM ts_encuestas e WHERE 1 ";;
$sSql .=	" ORDER BY  e.EstadoId ";

 
if ($stmt = mysqli_prepare($link, $sSql))
  {
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,$iEncuestaId,  $iEstadoId,$iNivelEncuesta,$sClave, $sEmpresa,  $iFechaInicio, $iFechaFin, $sNombreEncuesta, $sDescripcion, $sMensajeBienvenida, $sMensajeFinal, $iTotalEncuestaFinalizadas, $iTotalEncuestaProceso, $iTotalPreguntasAsignadas);
		  while (mysqli_stmt_fetch($stmt)) {

?>
                    <tr> 
                      <td class="text-primary"><?php  if( $iEstadoId == 1) { ?>
					  <a href="./encuestas/index.php?C=<?php echo $sClave; ?>" target="_blank"   ><?php echo $sClave; ?>
					  <?php  } else{  echo $sClave; }?></a></td>
                      <td><?php echo $sEmpresa; ?></td>
                      <td><?php echo $sNombreEncuesta; ?></td>
                      <td><?php echo  FechaSistema($iFechaInicio,31) . " <br> " . FechaSistema($iFechaFin,31); ?></td>
                      <td><?php echo $iTotalEncuestaProceso; ?></td>
                      <td><?php echo $iTotalEncuestaFinalizadas; ?></td> 
					  <td><?php if( $iNivelEncuesta == 1)	    {	echo 'TODOS '; 		}
					  			else if( $iNivelEncuesta == 2)  {	echo ' C/NIVEL 2 '; }  
					  			else if( $iNivelEncuesta == 3)  {	echo ' C/NIVEL 3 '; } ?></td>
					  <td><?php if( $iEstadoId == 0) {
					  				$sTipoEstado = "Activar";
					  				$iEstadoSiguienteId = 1;
					  				echo '<div class="btn btn-danger btn-sm"><span class="text">Inactivo</span></div>'; }
					  			else   {
					  				$sTipoEstado = "Desactivar";
					  				$iEstadoSiguienteId = 0;
								echo '<div class="btn btn-success btn-sm"><span class="text">Activo</span></div>'; } ?></td>
                      <td><a href="usrencuestas.php?Id=<?php echo $iEncuestaId;?>" class="btn btn-warning btn-circle btn-sm"  title="Descargar resultados" target="_blank"><i class="fas fa-print"></i></a> <a href="lstencuestas.php?Id=<?php echo $iEncuestaId;?>" class="btn btn-primary btn-circle btn-sm"  title="Lista Usuarios" ><i class="fas fa-users"></i></a> <?php if($sClave != "NOBORRAR") {?> <a class="btn btn-danger btn-circle btn-sm"  href="edtencuestas.php?Id=<?php echo $iEncuestaId;?>"   title="Editar Encuesta"  ><i class="fas fa-pen"></i></a><?php } ?></td>
					   <!-- Logout Modal-->
  <div class="modal fade" id="MdDes-<?php echo $iEncuestaId;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Mensaje</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Deseas <strong><?php echo $sTipoEstado;?></strong> la encuesta?<br><strong><?php echo $sClave; ?> - <?php echo $sEmpresa; ?></strong>
		</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
          <a class="btn btn-primary" href="accencuestas.php?Acc=B&IdS=<?php echo $iEstadoSiguienteId;?>&Id=<?php echo $iEncuestaId;?>">Si</a>
        </div>
      </div>
    </div>
  </div>
                    </tr>
   <?php
				}
	     mysqli_stmt_close($stmt);
   }
	?>              
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
ob_end_flush();
?>