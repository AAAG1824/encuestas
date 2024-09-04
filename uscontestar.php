<?php   
require "./inc/settings.php";
require "./inc/funciones.php";  

$sGSessionId = session_id(); 
//Cachamos el IdSesion de la Encuesta. 
$iSeccActual =  0;
$iSeccTotal = 0 ;
$sSql2 ="";
//Cachamos el IdSesion de la Encuesta.
$iEncuestaId=0;
$sEmpresa="";
$iFechaInicio=0;
$iFechaFin=0;
$sNombreEncuesta=""; $sDescripcion="";  $sMensajeBienvenida="";  $sMensajeFinal=""; 
$sSS=isset( $_GET['SS'] ) ?  Limpieza($_GET['SS']) : '' ;
$iId=isset( $_GET['Id'] ) ?  Limpieza($_GET['Id']) : 0 ;
$iIP=isset( $_GET['iP'] ) ?  Limpieza($_GET['iP']) : 0 ;
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
 
 // Traenmos las secciones Totales
 
$sSql  = "SELECT COUNT(distinct Seccion)  FROM  ts_encuestapregunta WHERE EncuestaId = ? and EstadoId = 1";
 if ($stmt = mysqli_prepare($link, $sSql))
  {
	mysqli_stmt_bind_param($stmt,'i',$iEncuestaId);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,$iSeccTotal );
		  while (mysqli_stmt_fetch($stmt)) {
		  }
		  
	     mysqli_stmt_close($stmt);
 }
 
 $sInstruccion="";
$sSql  = "SELECT ep.Seccion ,p.Instruccion FROM  ts_encuestapregunta ep INNER JOIN ts_preguntas p ON p.PreguntaId = ep.PreguntaId";
$sSql .= "   where ep.EncuestaPreguntaId =  ? and ep.EstadoId = 1";
 if ($stmt = mysqli_prepare($link, $sSql))
  {
	mysqli_stmt_bind_param($stmt,'i',$iIP);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,$iSeccActual,$sInstruccion );
		  while (mysqli_stmt_fetch($stmt)) {
		  }
		  
	     mysqli_stmt_close($stmt);
 }
  
  
 // Info de la pregunta
 
 
 
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
		 	
          <!-- Page Heading  SELECT COUNT(Seccion) as Secciones FROM  ts_encuestapregunta WHERE EncuestaId = 1 and EstadoId = 1-->
		  <h1 class=" mb-4 text-gray-800"><center><?php echo $sEmpresa ?> &nbsp; ( <?php echo  $iSeccActual ."/" . $iSeccTotal;  ?> )</center></h1>
		 
          <h4 class=" mb-4 text-gray-800"><?php echo $sInstruccion;?></h4>
		  <br>
		  <form class="FrmPreguntas" action="uscontestaracc.php?SS=<?php echo $sSS;?>&Id=<?php echo $iId;?>&iP=<?php echo $iIP;?>" enctype="multipart/form-data" method="post"> 
  		  <input name="Acc" type="hidden" value="A">
			  
			  <table class="table table-bordered"   width="100%" cellspacing="0">
                    <thead><tr>
                      <th>Pregunta</th> 
                      <th colspan="5">Respuestas</th>
					 </tr></thead> 
                  <tbody>
        	 <?php 
			 
$iPreguntaId=0; 
$iEncuestaPreguntaId=0;
$iConsecutivo=0; 
$sPregunta	="";
$sRespuesta01	="";
$iValor01	=0;
$sRespuesta02	="";
$iValor02 	=0;
$sRespuesta03	="";
$iValor03	=0; 
$sRespuesta04	=""; 
$iValor04 	=0;
$sRespuesta05	="";
$iValor05	=0;
$iEncuestaPreguntaIdF=0;
			 $iCon=1;
$sSql  =	" SELECT ep.EncuestaPreguntaId,ep.Consecutivo,p.PreguntaId,p.Pregunta,p.Respuesta01,p.Valor01,p.Respuesta02,p.Valor02 ,p.Respuesta03,p.Valor03,";
$sSql .=	"p.Respuesta04,p.Valor04,p.Respuesta05,p.Valor05    FROM  ts_encuestapregunta ep INNER JOIN ts_preguntas p ON p.PreguntaId = ep.PreguntaId ";
$sSql .=	"WHERE ep.EstadoId = 1 AND ep.EncuestaId = $iEncuestaId AND ep.Seccion =  $iSeccActual  ORDER BY ep.Consecutivo"; 
 
if ($stmt = mysqli_prepare($link, $sSql))
  {
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,$iEncuestaPreguntaId,  $iConsecutivo, $iPreguntaId, $sPregunta, $sRespuesta01, $iValor01, $sRespuesta02, $iValor02 , $sRespuesta03, $iValor03 , $sRespuesta04, $iValor04 , $sRespuesta05, $iValor05  );
		  while (mysqli_stmt_fetch($stmt)) {			 
			  
			  ?>
                    <tr>
                      <td><?php echo $sPregunta; ?></td> 
                      <?php if(trim($sRespuesta01) != '' ) {?><td  ><label><input type="radio" name="P<?php echo $iCon;?>" value="<?php echo $iEncuestaPreguntaId .'-1';?>" required> <?php echo $sRespuesta01;?></label></td><?php }?> 
					   <?php if(trim($sRespuesta02) != '' ) {?><td  ><label><input type="radio" name="P<?php echo $iCon;?>" value="<?php echo $iEncuestaPreguntaId .'-2';?>" required> <?php echo $sRespuesta02;?></label></td><?php }?> 
					   <?php if(trim($sRespuesta03) != '' ) {?><td  ><label><input type="radio" name="P<?php echo $iCon;?>" value="<?php echo $iEncuestaPreguntaId .'-3';?>" required> <?php echo $sRespuesta03;?></label></td><?php }?> 
					   <?php if(trim($sRespuesta04) != '' ) {?><td  ><label><input type="radio" name="P<?php echo $iCon;?>" value="<?php echo $iEncuestaPreguntaId .'-4';?>" required> <?php echo $sRespuesta04;?></label></td><?php }?> 
					   <?php if(trim($sRespuesta05) != '' ) {?><td  ><label><input type="radio" name="P<?php echo $iCon;?>" value="<?php echo $iEncuestaPreguntaId .'-5';?>" required>  <?php echo $sRespuesta05;?></label></td><?php }?> 
					 </tr>
			 <?php
$iEncuestaPreguntaIdF=$iEncuestaPreguntaId;

			 $iCon=$iCon+1;
			 }
	     mysqli_stmt_close($stmt);
   }
			 ?></tbody>
				</table>  
  		  <input name="IdScc" type="hidden" value="<?php echo $iSeccActual;?>">
  		  <input name="IdPF" type="hidden" value="<?php echo $iEncuestaPreguntaIdF;?>"><br>
		<div class="row"> 
        		  <div class="col-lg-12"> 
                 	<div class="form-group row">
                  	<div class="col-sm-10">  
                   	<strong> 	<input name="submit" type="submit" value="Registrar"  class="btn btn-primary btn-user btn-block"></strong>                   	</div>
                  	<div class="col-sm-2">  
                   	<strong> <a href="usencuesta.php?SS=<?php echo $sSS;?>"   class="btn btn-danger btn-user btn-block">Salir</a></strong>                   	</div>
					</div>
					</div>
		</div>
		</form>
		  
		    
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