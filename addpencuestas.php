<?php   
require "./inc/settings.php";
require "./inc/funciones.php"; 
require "./inc/validasession.php"; 

$iId=isset( $_POST['Id'] ) ?   Limpieza($_POST['Id']) : 0 ;
if( $iId == 0)
	{
		$iId=isset( $_GET['Id'] ) ?  Limpieza($_GET['Id']) : 0 ; 
	}

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
$iTotalPreguntasAsignadas = 0;
$sSql  =	"SELECT e.EncuestaId, e.EstadoId,e.Empresa, e.FechaInicio, e.FechaFin, e.NombreEncuesta, e.Descripcion, e.MensajeBienvenida, e.MensajeFinal,";
$sSql .=	"(SELECT count(distinct eu.CorreoEnviado) FROM  ts_encuestausuarios eu where eu.EstadoId = 9 and eu.EncuestaId = e.EncuestaId ) as TotalEncuestaF ,";
$sSql .=	"(SELECT  count(distinct ep.PreguntaId )  FROM ts_encuestapregunta ep WHERE ep.EstadoId  = 1 AND ep.EstadoId = e.EncuestaId) AS TotalPregAsig FROM ts_encuestas e WHERE 1 ";
$sSql .=	" AND  e.EncuestaId = ? ";


if ($stmt = mysqli_prepare($link, $sSql))
  {
	mysqli_stmt_bind_param($stmt,'i',$iId);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,$iEncuestaId,  $iEstadoId, $sEmpresa,  $iFechaInicio, $iFechaFin, $sNombreEncuesta, $sDescripcion, $sMensajeBienvenida, $sMensajeFinal, $iTotalEncuestaFinalizadas, $iTotalPreguntasAsignadas);
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
            <h1 class="h3 mb-2 text-gray-800">Agregar Preguntas a la Encuesta</h1> 
            <a href="encuestas.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i>&nbsp;&nbsp;regresar</a>
          </div>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Encuesta: <?php echo  $sNombreEncuesta;?></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
			  <!-- form -->
              <form class="FrmPreguntas" action="accpencuestas.php" enctype="multipart/form-data" method="post">
			 <input name="IdE" type="hidden" value="<?php echo $iId; ?>">
			 <input name="Id" type="hidden" value="0">
			 <input name="Acc" type="hidden" value="A">
				  <div class="row"> 
        		  <div class="col-lg-12"> 
                 <div class="form-group row">
                  <div class="col-sm-9">
                   <label>Grupo de Preguntas</label> 
			     	<select name="GrupoId" id="GrupoId"   required   class="form-control" onChange="VamonosA();">
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
							
												} 			}
					  ?> 
                      </select>     
				    </div> 
                  <div class="col-sm-1">
                   <label>Secci&oacute;n</label>
                  <input type="number" class="form-control " id="Seccion" name="Seccion"  value=1 required> </div>
				
                  <div class="col-sm-2">
                   <label>Estado</label> 
			     	<select name="Estado" id="Estado"   required   class="form-control"  >
					  <option value="1" selected="selected">ACTIVO</option>
					  <option value="0">INACTIVO</option>
					 
                      </select>     
				    </div> 
                 </div>
				 
                <div class="form-group row">
                  <div class="col-sm-2">
                   <label>Consecutivo</label> 
                  <input type="number" class="form-control " id="Consecutivo" name="Consecutivo"   required>
				    </div> 
                 
				 <div class="col-sm-6">
                   <label>Grupo de Preguntas</label> 
			     	<select name="PreguntaId" id="PreguntaId"   required   class="form-control"  onChange="VamonosA2();">
					  <option value="">--  SELECCIONE UNA PREGUNTA --</option>
					   </select>     
				    </div> 
					 <div class="col-sm-2">
                 	  <br> 
                   	<strong>	<a href="#" id="VerPregunta" name="VerPregunta" style="color:#666666">Seleccione una Pregunta</a></strong>
				    </div> 
					
					 <div class="col-sm-2">
                 	  <label>&nbsp;</label> 
                   	<strong>	 <input name="submit" type="submit" value="+ Agregar"  class="btn btn-primary btn-user btn-block"></strong>
				    </div> 
                 </div>
			</div></div></form>
			 <div class="form-group row">
                  <div class="col-sm-12">&nbsp;
				  </div>
			</div>
			  <!-- form -->
			  <div class="row"> 
        		  <div class="col-lg-12"> 
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#Id</th>
                      <th>Secci&oacute;n </th>  
                      <th>Consecutivo </th>  
                      <th>Pregunta </th>  
                      <th>Estado </th>  
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
 <?php 
 $iEncuestaPreguntaId = 0; 
$iPreguntaId=0;
$sGrupoBreve="";
$sGrupo		="";
$iEstadoId	=0;
$iOrden		=0;
$sPreguntaBreve	="";
$sInstruccion	="";
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
$iESeccion	=0;
 $sSql  = "";
 $sSql .= "SELECT ep.EncuestaPreguntaId, ep.PreguntaId,ep.EstadoId,ep.Seccion,ep.Consecutivo, p.PreguntaBreve,p.Instruccion,p.Pregunta,p.Respuesta01,p.Valor01 ,p.Respuesta02,p.Valor02, ";
 $sSql .= "p.Respuesta03,p.Valor03,p.Respuesta04,p.Valor04 ,p.Respuesta05,p.Valor05    FROM  ts_encuestapregunta  ep  ";
 $sSql .= "INNER JOIN ts_preguntas p ON p.PreguntaId = ep.PreguntaId  WHERE ep.EncuestaId = ?  ORDER BY ep.EstadoId DESC ,ep.Seccion,ep.Consecutivo ASC ";
 
if ($stmt = mysqli_prepare($link, $sSql))
  {
	mysqli_stmt_bind_param($stmt,'i',$iId);
  	 	  mysqli_stmt_execute($stmt);
		  mysqli_stmt_bind_result($stmt,$iEncuestaPreguntaId, $iPreguntaId,   $iEstadoId,$iESeccion,$iOrden, $sPreguntaBreve, $sInstruccion, $sPregunta, $sRespuesta01, $iValor01, $sRespuesta02, $iValor02 , $sRespuesta03, $iValor03 , $sRespuesta04, $iValor04 , $sRespuesta05, $iValor05  );
		  while (mysqli_stmt_fetch($stmt)) {
 ?>
                    <tr>
                      <td><?php echo $iEncuestaPreguntaId; ?></td> 
                      <td><?php echo $iESeccion; ?></td> 
                      <td><?php echo $iOrden; ?></td> 
                      <td><?php echo $sPregunta; ?></td> 
					  <td><?php if( $iEstadoId == 0) {echo '<div class="btn btn-danger btn-sm"><span class="text">Inactivo</span></div>'; }
					  			else {echo '<div class="btn btn-success btn-sm"><span class="text">Activo</span></div>'; } ?></td>
                      <td> <a   title="Ver informacion pregunta"   class="btn btn-primary btn-circle btn-sm"  href="#" data-toggle="modal" data-target="#verPregunta-<?php echo $iPreguntaId; ?>" ><i class="fas fa-search"></i></a> <a href="delencuestas.php?Id=<?php echo $iEncuestaPreguntaId;?>" class="btn btn-danger btn-circle btn-sm"  title="Eliminar pregunta" ><i class="fas fa-trash"></i></a>  </td>
                    	 <div class="modal fade" id="verPregunta-<?php echo $iPreguntaId; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content"  style="width:800px;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pregunta</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
		<?php echo trim($sInstruccion);?>
		<?php echo $sPregunta;?>
		<strong>
		<blockquote><p><?php echo trim($sRespuesta01);?></p></blockquote>
		<blockquote><p><?php echo trim($sRespuesta02);?></p></blockquote>
		<?php if( trim($sRespuesta03) != '') echo '<blockquote><p>'.trim($sRespuesta03).'</p></blockquote>';?> 
		<?php if( trim($sRespuesta04) != '') echo '<blockquote><p>'.trim($sRespuesta04).'</p></blockquote>';?>  
		<?php if( trim($sRespuesta05) != '') echo '<blockquote><p>'.trim($sRespuesta05).'</p></blockquote>';?>   
		</strong>
		</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">.:: OK ::.</button> 
        </div>
      </div>
    </div>
  </div></tr>
<?php
				}
	     mysqli_stmt_close($stmt);
   }
	?>             
				</tbody>
				</table></div></div>
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

<script>
       	   
	 function VamonosA() 
	 {
 		var iGrupo =  $("#GrupoId").val();  
	 	if (iGrupo > 0 ) {
  			$.post("ajx_pregunta.php",
			   { 
				 Id: iGrupo
			  },
		 	 function(data, status){
		  		$("#PreguntaId").html( data ); 
		  						   });
 	}
	else
		{
		 $("#iGrupo").html( '<select   id="PreguntaId"  name="PreguntaId"  onChange="VamonosA();"><option value="" > .: SELECCIONE UNA PREGUNTA :.</option></select>' );
		}
		 
}
 
	 function VamonosA2() 
	 {
 		var iGrupo =  $("#PreguntaId").val();  
	 	if (iGrupo > 0 ) {
  			$.post("ajx_verpregunta.php",
			   { 
				 Id: iGrupo
			  },
		 	 function(data, status){
		  		$("#VerPregunta").html( data ); 
		  						   });
 	}
	else
		{
		 $("#VerPregunta").html( '<a href="#" id="VerPregunta" name="VerPregunta" style="color:#666666" >Seleccione una Pregunta</a>' );
		}
		 
}

   </script>
</body>

</html>
<?php
require "./inc/desconectar.php";
?>