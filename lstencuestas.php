<?php   
require "./inc/settings.php";
require "./inc/funciones.php"; 
require "./inc/validasession.php";  
$iId= isset( $_GET['Id'] ) ?    ($_GET['Id']) : 0 ; 

// Declaraciones	
 $iContestarId=0; $iNoNomina=0; $iEdad=0; $iGenero=0; $iEstudiosId=0;$sGrado ="";
 $sEmpresa="";
 $sLogo="";
 $iT1=0;$iT2=0; $iTT = 0;
$iT2A=0;  $iT2A1=0;  $iT2B=0;  $iT2B1=0;  $iT2B2=0;  $iT2C=0;  $iT2C1=0;  $iT2C2=0;  $iT2D=0;  $iT2D1=0;  $iT2D2=0;  
$iT2D3=0;  $iT2E=0;  $iT2E1=0;  $iT2E2=0;
$iT1A=0;  $iT1A1=0;  $iT1B=0;  $iT1B1=0;  $iT1B2=0;  $iT1C=0;  $iT1C1=0;  $iT1C2=0;  $iT1D=0;  $iT1D1=0;  $iT1D2=0;  
$iT1D3=0;  $iT1E=0;  $iT1E1=0;  $iT1E2=0;
$sAlerta=0; $iT1A1_1=0; $iT1A1_2=0; $iT1A1_3=0; $iT1B1_1=0; $iT1B1_2=0; $iT1B1_3=0; $iT1B1_4=0; $iT1B1_5=0; $iT1B1_6=0; 
$iT1B2_1=0; $iT1B2_2=0; $iT1B2_3=0; $iT1B2_4=0; $iT1C1_1=0; $iT1C2_1=0; $iT1C2_2=0; $iT1D1_1=0; $iT1D1_2=0; $iT1D2_1=0; 
$iT1D2_2=0; $iT1D3_1=0; $iT1E1_1=0; $iT1E1_2=0; $iT1E2_1=0; 
  $iT2A1_1=0; $iT2A1_2=0;  $iT2A1_3=0;  $iT2B1_1=0;  $iT2B1_2=0;  $iT2B1_3=0;  $iT2B1_4=0;  $iT2B1_5=0;  
$iT2B1_6=0;  $iT2B2_1=0;  $iT2B2_2=0;  $iT2B2_3=0;  $iT2B2_4=0;  $iT2C1_1=0;  $iT2C2_1=0;  $iT2C2_2=0;  $iT2D1_1=0;  
$iT2D1_2=0;  $iT2D2_1=0;  $iT2D2_2=0;  $iT2D3_1=0;  $iT2E1_1=0;  $iT2E1_2=0;  $iT2E2_1=0;  $iT2E2_2 =0;

   
$sSQL = " SELECT  Empresa ,  Logotipo  FROM  ts_encuestas  WHERE   EncuestaId  = ? "; 
if ($stmt2 = mysqli_prepare($link2, $sSQL))
  {
 		mysqli_stmt_bind_param($stmt2,'i',$iId);
        mysqli_stmt_execute($stmt2);
		  mysqli_stmt_bind_result($stmt2, $sEmpresa,$sLogo );
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
            <h1 class="h3 mb-2 text-gray-800"><?php  echo $sEmpresa; ?></h1>  
            <a href="encuestas.php" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-undo fa-sm text-white-50"></i>&nbsp;&nbsp;Regresar</a> 
          </div>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              
              <div class="row"><div class="col-sm-8"><h6 class="m-0 font-weight-bold text-primary">Listado de Personal</h6></div>
              <div class="col-sm-4" align="right"	><!-- <a href="infexcel.php?Id=<?php  echo $iId; ?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
              <i class="fas fa-download	 fa-sm text-white-50"></i></a>&nbsp;--><a href="infrpt.php?Id=<?php  echo $iId; ?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
              <i class="fas fa-user-tag	 fa-sm text-white-50"></i></a></div></div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No <br>Nomina</th>
                      <th>Profesion </th> 
                      <th>Edad </th> 
                      <th>Genero</th> 
                      <th>Estado</th> 
                      <th>Alerta</th>  
                      <th>Calificaci&oacute;n<br>Grupo 2</th> 
                      <th>Calificaci&oacute;n<br>Grupo 3</th>  
                    </tr>
                  </thead>
                  <tbody>
<?php 

$sSQL  = " SELECT distinct e.ContestarId,e.NoNomina,e.Edad,e.Genero,e.EstadoId, g.GradoEstudio FROM  ts_encuestausuarios e INNER JOIN ts_gradoestudio g ON ";
$sSQL .= " g.GradoId = e.EstudiosId   WHERE e.EncuestaId = ?  order by e.NoNomina";
$iCantidad= 0 ;
if ($stmt = mysqli_prepare($link, $sSQL))
  {
 		mysqli_stmt_bind_param($stmt,'i',$iId);
        mysqli_stmt_execute($stmt);
		  mysqli_stmt_bind_result($stmt, $iContestarId, $iNoNomina , $iEdad, $iGenero,$iEEstadoId,$sGrado );
		  while (mysqli_stmt_fetch($stmt)) {
		   
		  
	// consultamos el Grupo 1 de Totales	
	   
	$sSQL1  = " SELECT Alerta, A, A1, B, B1, B2, C, C1, C2, D, D1, D2, D3, E, E1, E2  FROM ts_encuestascalculoenc ";
	$sSQL1 .= " WHERE   EncuestaId = $iContestarId   AND  NoNominda =  $iNoNomina  AND Grupo = 1 "; 
	if ($stmt2 = mysqli_prepare($link2, $sSQL1))
	  {
			//mysqli_stmt_bind_param($stmt2,'ii',$iContestarId, $iNoNomina );
			mysqli_stmt_execute($stmt2);
			  mysqli_stmt_bind_result($stmt2,  $sAlerta,$iT1A, $iT1A1, $iT1B, $iT1B1, $iT1B2, $iT1C,$iT1C1, $iT1C2, $iT1D, $iT1D1, $iT1D2, $iT1D3, $iT1E, $iT1E1, $iT1E2 );
			  while (mysqli_stmt_fetch($stmt2)) {
			  }
			mysqli_stmt_close($stmt2);
	 }
	 $iT1 = $iT1A + $iT1B + $iT1C + $iT1D + $iT1E;
	// consultamos el Grupo 2 de Totales  
	   
	$sSQL1  = " SELECT   A, A1, B, B1, B2, C, C1, C2, D, D1, D2, D3, E, E1, E2  FROM ts_encuestascalculoenc ";
	$sSQL1 .= " WHERE   EncuestaId = $iContestarId   AND  NoNominda =  $iNoNomina  AND Grupo = 2 "; 
	if ($stmt2 = mysqli_prepare($link2, $sSQL1))
	  {
			//mysqli_stmt_bind_param($stmt2,'ii',$iContestarId, $iNoNomina );
			mysqli_stmt_execute($stmt2);
			  mysqli_stmt_bind_result($stmt2,  $iT2A, $iT2A1, $iT2B, $iT2B1, $iT2B2, $iT2C, $iT2C1, $iT2C2, $iT2D, $iT2D1, $iT2D2, $iT2D3, $iT2E, $iT2E1, $iT2E2  );
			  while (mysqli_stmt_fetch($stmt2)) {
			  }
			mysqli_stmt_close($stmt2);
	 }
	 $iT2 = $iT2A + $iT2B + $iT2C + $iT2D + $iT2E;
	 $iTT = $iT1+$iT2;
	// consultamos el Grupo 1 de  Detalle
	
	$sSQL1  = " SELECT   A1_1, A1_2, A1_3, B1_1, B1_2, B1_3, B1_4, B1_5, B1_6, B2_1, B2_2, B2_3, B2_4, C1_1, C2_1, C2_2, D1_1, D1_2, D2_1, D2_2, D3_1, E1_1, E1_2, E2_1, E2_2   ";
	$sSQL1 .= " FROM ts_encuestascalculodet WHERE   EncuestaId = $iContestarId   AND  NoNomina =  $iNoNomina  AND Grupo = 1 "; 
	echo "<!-- $sSQL1 -->";
	if ($stmt2 = mysqli_prepare($link2, $sSQL1))
	  {
			//mysqli_stmt_bind_param($stmt2,'ii',$iContestarId, $iNoNomina );
			mysqli_stmt_execute($stmt2);
			  mysqli_stmt_bind_result($stmt2,  $iT1A1_1, $iT1A1_2, $iT1A1_3, $iT1B1_1, $iT1B1_2, $iT1B1_3, $iT1B1_4, $iT1B1_5, $iT1B1_6, $iT1B2_1, $iT1B2_2, $iT1B2_3, $iT1B2_4, $iT1C1_1, $iT1C2_1, $iT1C2_2, $iT1D1_1, $iT1D1_2, $iT1D2_1, $iT1D2_2, $iT1D3_1, $iT1E1_1, $iT1E1_2, $iT1E2_1, $iT1E2_2   );
			  while (mysqli_stmt_fetch($stmt2)) {
			  }
			mysqli_stmt_close($stmt2);
	 }
	// consultamos el Grupo 2 de  Detalle
	
	$sSQL1  = " SELECT   A1_1, A1_2, A1_3, B1_1, B1_2, B1_3, B1_4, B1_5, B1_6, B2_1, B2_2, B2_3, B2_4, C1_1, C2_1, C2_2, D1_1, D1_2, D2_1, D2_2, D3_1, E1_1, E1_2, E2_1, E2_2   ";
	$sSQL1 .= " FROM ts_encuestascalculodet WHERE   EncuestaId = $iContestarId   AND  NoNomina =  $iNoNomina  AND Grupo = 2 "; 
	echo "<!-- $sSQL1 -->";
	if ($stmt2 = mysqli_prepare($link2, $sSQL1))
	  {
			//mysqli_stmt_bind_param($stmt2,'ii',$iContestarId, $iNoNomina );
			mysqli_stmt_execute($stmt2);
			  mysqli_stmt_bind_result($stmt2,  $iT2A1_1, $iT2A1_2, $iT2A1_3, $iT2B1_1, $iT2B1_2, $iT2B1_3, $iT2B1_4, $iT2B1_5, $iT2B1_6, $iT2B2_1, $iT2B2_2, $iT2B2_3, $iT2B2_4, $iT2C1_1, $iT2C2_1, $iT2C2_2, $iT2D1_1, $iT2D1_2, $iT2D2_1, $iT2D2_2, $iT2D3_1, $iT2E1_1, $iT2E1_2, $iT2E2_1, $iT2E2_2   );
			  while (mysqli_stmt_fetch($stmt2)) {
			  }
			mysqli_stmt_close($stmt2);
	 }
	// Calculos Finales
	
?>					<tr> <td><?php echo  $iNoNomina; ?></td>
    <td><?php echo  $sGrado; ?></td>
    <td><?php echo  $iEdad; ?></td>
    <td><?php if($iGenero == 1 ) {echo  "Masculino"; } else { echo "Femenino";} ?></td>
    <td><?php if($iEEstadoId == 1 ) {echo  "En Proceso"; } else { echo "Finalizado";} ?></td>
    <td><?php   echo  substr($sAlerta,1,1)."_".substr($sAlerta,2,1)."_".substr($sAlerta,3,1); ?></td>
              
    <td><?php echo  $iT1; ?></td>
    <td><?php echo  $iT2; ?></td>  
					  </tr>
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