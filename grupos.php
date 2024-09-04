<?php   
require "./inc/settings.php";
require "./inc/funciones.php"; 
require "./inc/validasession.php"; 


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
	  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="login.php">  <div class="sidebar-brand-icon"><img src="img/logobco.png"></div></a>
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
            <h1 class="h3 mb-2 text-gray-800">Grupos de Preguntas</h1> 
            <a href="addgrupos.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i>&nbsp;&nbsp;Agregar</a>
          </div>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Grupos</h6>
			  
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#Id</th>
                      <th>Grupo</th>
                      <th># Preguntas</th>
                      <th># Encuestas</th> 
                      <th>Estado</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  
                  <tbody>
<?php 
$iGrupoId=0;
$iEstadoId=0;
$sGrupoBreve="";
$sGrupo="";
$iTPreguntas=0;
$iTEncuestas=0;
 
$sSQL  = " SELECT g.GrupoId, g.EstadoId, g.GrupoBreve, g.Grupo, ";
$sSQL .= " (SELECT count(p.PreguntaId) FROM ts_preguntas p WHERE p.EstadoId = 1 AND p.GrupoId = g.GrupoId ) as TPreguntas, "; 
$sSQL .= " (SELECT count(DISTINCT e.EncuestaId) FROM ts_encuestapregunta e WHERE e.EstadoId = 1 AND e.GrupoId = g.GrupoId) as TEncuestas "; 
$sSQL .= " FROM ts_grupos g WHERE 1 ORDER BY g.EstadoId DESC ";
if ($stmt = mysqli_prepare($link, $sSQL))
  {
  	 	  mysqli_stmt_execute($stmt);
		  mysqli_stmt_bind_result($stmt,$iGrupoId,  $iEstadoId, $sGrupoBreve,  $sGrupo,$iTPreguntas, $iTEncuestas  );
		  while (mysqli_stmt_fetch($stmt)) {
?>                <tr>
                      <td><?php echo $iGrupoId;?></td> 
					  <td><?php echo $sGrupoBreve;?></td>  
					  <td><?php echo $iTPreguntas;?></td>  
					  <td><?php echo $iTEncuestas;?></td>
                      <td><?php if( $iEstadoId == 0) {echo '<div class="btn btn-danger btn-sm"><span class="text">Inactivo</span></div>'; }
					  			else {echo '<div class="btn btn-success btn-sm"><span class="text">Activo</span></div>'; } ?></td>
                      <td><?php if ($iTPreguntas ==0  &&  $iTEncuestas == 0 )  {  ?><a href="delgrupos.php?Id=<?php echo $iGrupoId;?>" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a> <?php }?><a href="vergrupos.php?Id=<?php echo $iGrupoId;?>" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-search"></i></a> <a href="updgrupos.php?Id=<?php echo $iGrupoId;?>" class="btn btn-success btn-circle btn-sm"><i class="fas fa-pen"></i></a></td>
                    </tr>
  <?php 
  											}
               // Cerrar la sentencia preparada de MySQL
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
?>