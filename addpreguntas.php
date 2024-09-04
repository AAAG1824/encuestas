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
            <h1 class="h3 mb-2 text-gray-800">Agregar Preguntas</h1> 
            <a href="preguntas.php" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-undo fa-sm text-white-50"></i>&nbsp;&nbsp;Regresar</a>
          </div>
 <div class="row">

            <div class="col-lg-12">

              <!-- Default Card Example -->
              <div class="card mb-4">
                <div class="card-header">
                  Agregar preguntas
                </div>
                <div class="card-body">
                 <!-- form -->
              <form class="FrmPreguntas" action="accpreguntas.php" enctype="multipart/form-data" method="post">
			 <input name="Id" type="hidden" value="0">
			 <input name="Acc" type="hidden" value="A">
				  <div class="row"> 
          <div class="col-lg-12"> 
              
                <div class="form-group row">
                  <div class="col-sm-12">
                   <label>Grupo de Preguntas</label> 
			     <select name="GrupoId"  required   class="form-control" >
					  <option value="">--  SELECCIONE UNA GRUPO DE PREGUNTAS --</option>
					  <?php
					  $intTId=0;
					  $strTName ='';
					  
					  $strSql  = "  SELECT GrupoId,   GrupoBreve  FROM ts_grupos WHERE EstadoId = 1 ORDER BY GrupoBreve DESC";
				if ($stmt = mysqli_prepare($link, $strSql )) {
				            mysqli_stmt_execute($stmt);
						 	mysqli_stmt_bind_result($stmt,$intTId,$strTName);
							while (mysqli_stmt_fetch($stmt)) 
												{
												$strTName = LimpiezaMayusculas($strTName);
							      echo "<option value=$intTId>$strTName</option>";
							
												}
												
															}
					  ?> 
                      </select>     
				 
                  </div> 
                   
                </div>
                <div class="form-group row">
                  <div class="col-sm-2">
					<label>Orden</label> 
                  <input type="number" class="form-control " id="Orden" name="Orden" value=0 required>
				  </div>
                  <div class="col-sm-10">
					<label>Nombre Breve</label> 
                  <input type="text" class="form-control " id="NombreBreve" name="NombreBreve" placeholder="" required>
				  </div>
                </div>
				
                <div class="form-group row" >
                  <div class="col-sm-12">
					<label>Instrucci&oacute;n</label> 
                	<textarea name="Instruccion" id="Instruccion" class="form-control"   > </textarea>
				  </div>
                </div>
				
				
                <div class="form-group row" >
                  <div class="col-sm-12">
					<label>Pregunta</label> 
                	<textarea name="Pregunta" id="Pregunta" class="form-control"  required> </textarea>
				  </div>
                </div>
				  <div class="form-group row" >
                  <div class="col-sm-10">
					<label>Respuesta 1</label> 
                	 <input type="text" name="R1" id="R1" class="form-control"   required>
				  </div>
                  <div class="col-sm-2">
					<label>Valor 1</label> 
                	 <input type="number" name="V1" id="V1" class="form-control" value=0 required> 
				  </div>
                </div>
				
				  <div class="form-group row" >
                  <div class="col-sm-10">
					<label>Respuesta 2</label> 
                	 <input type="text" name="R2" id="R2" class="form-control"   required>
				  </div>
                  <div class="col-sm-2">
					<label>Valor 2</label> 
                	 <input type="number" name="V2" id="V2" class="form-control" value=0  required> 
				  </div>
                </div>
				
				  <div class="form-group row" >
                  <div class="col-sm-10">
					<label>Respuesta 3</label> 
                	 <input type="text" name="R3" id="R3" class="form-control" >
				  </div>
                  <div class="col-sm-2">
					<label>Valor 3</label> 
                	 <input type="number" name="V3" id="V3" class="form-control"  value=0 required> 
				  </div>
                </div>
				
				
				  <div class="form-group row" >
                  <div class="col-sm-10">
					<label>Respuesta 4</label> 
                	 <input type="text" name="R4" id="R4" class="form-control" >
				  </div>
                  <div class="col-sm-2">
					<label>Valor 4</label> 
                	 <input type="number" name="V4" id="V4" class="form-control"  value=0 > 
				  </div>
                </div>
                
				  <div class="form-group row" >
                  <div class="col-sm-10">
					<label>Respuesta 5</label> 
                	 <input type="text" name="R5" id="R5" class="form-control" >
				  </div>
                  <div class="col-sm-2">
					<label>Valor 5</label> 
                	 <input type="number" name="V5" id="V5" class="form-control"  value=0 > 
				  </div>
                </div>
				<div class="form-group row">
                  <div class="col-sm-12"> 
				  <input name="submit" type="submit" value=".:: Registrar ::."  class="btn btn-primary btn-user btn-block">
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