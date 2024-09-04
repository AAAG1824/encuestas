<?php   
require "../inc/settings.php";
require "../inc/funciones.php";  
$iIdE =0;
$iId = 0;
$IdE=isset( $_GET['IdE'] ) ?    ($_GET['IdE']) : 0 ; 
$Id = isset( $_GET['Id'] ) ?    ($_GET['Id']) : 0 ;  
$IdM = isset( $_GET['M'] ) ?    ($_GET['M']) : 0 ;  
$iIdE =  base64_decode($IdE);
$iId  =  base64_decode($Id);
$iSecc = 1;
$sLogo = "hecim.png";
$stEmpresa = "";
$sSqlCB  = " SELECT distinct  Empresa,Logotipo FROM ts_encuestas e   WHERE e.EstadoId= 1 and EncuestaId = ? ";
if ($stmt = mysqli_prepare($link, $sSqlCB )) {
 							mysqli_stmt_bind_param($stmt,'i',$iIdE);
				            mysqli_stmt_execute($stmt);
						 	mysqli_stmt_bind_result($stmt,$stEmpresa,$sLogo);
							while (mysqli_stmt_fetch($stmt)) 
												{ 
							
												}
        					mysqli_stmt_close($stmt);							
											}
$sEstiloB ="";
if($IdM == 1 ) 
	$sEstiloB =" style='width:30px;height:30px;' ";

?><!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Halza Encuesta</title><!-- <?php echo "IE = $iIdE , I = $iId , E=$stEmpresa" ;?> -->
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<style>
a.list-group-item {
    height:auto;
    min-height:220px;
}
a.list-group-item.active small {
    color:#fff;
}
.stars {
    margin:20px auto 1px;    
} 
.Estilo1 {
	color: #FFFFFF;
	font-weight: bold;
	font-size:18px
}
.Estilo1m {
	color: #FFFFFF;
	font-weight: bold;
	font-size:19px
}
.EstiloN1m {
	color: #000;
	font-weight: bold;
	font-size:19px
}
.EstiloN1 {
	color: #000;
	font-weight: bold;
	font-size:18px
}
</style>
    </head>
    <body> 
<div class="container">
    <div class="row">
		<div class="well">
        <h1 class="text-center">
		 <table width="100%">
	 <tr><td width="20%"  align="left" valign="middle" ><img src="img/logo.png"></td>
	 <td width="60%" align="center" valign="middle"><h3>Factores de riesgo psicosocial en el trabajo <BR>NOM-035-STPS-2018</h3></td>
	 <td width="20%" align="right" valign="middle"><img src="logos/<?php echo $sLogo;?>"  width="214" height="72"  ></td></tr></table></h1>
        <div class="list-group"  style=" width:100%; height:600px; background:#28B5ED; background-image:url(img/fnd3.png); background-position:center; background-repeat:no-repeat ">
		 
            
                <div class="col-md-12">            <p class="list-group-item-heading">&nbsp;</p>
                    <p class="list-group-item-heading EstiloN1m"> IDENTIFICAR A LOS TRABAJADORES QUE FUERON SUJETOS A ACONTECIMIENTOS TRAUMÁTICOS SEVEROS. </p>
                    <p class="list-group-item-heading EstiloN1m"><strong>I.-  Acontecimiento traum&aacute;tico severo</strong></p>
                    <form action="regseccion.php?Is=<?php echo $iSecc;?>&IdE=<?php echo   $IdE;?>&Id=<?php echo   $Id;?>" method="post" enctype="multipart/form-data">
					<input name="ssec" type="hidden" value="<?php $iSecc = $iSecc +1; echo   $iSecc;?>">
					<input name="ss" type="hidden" value="<?php echo   session_id();?>">
					<input name="PgI" type="hidden" value="1">
					<input name="Pg" type="hidden" value="6">
					<input name="M" type="hidden" value="6">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table-bordered">
  <tr>
    <td height="50" colspan="2" align="left" valign="middle">
	<span class="EstiloN1m">¿Ha  presenciado o sufrido alguna vez, durante o con motivo del trabajo un  acontecimiento como los siguientes:</span></td>
    <td width="12%" bgcolor="#FFFFFF" class="EstiloN1m"><div align="center"><strong>Si</strong></div></td>
    <td width="12%" bgcolor="#FFFFFF" class="EstiloN1m"><div align="center"><strong>No</strong></div></td> 
  </tr>
  <tr>
    <td width="2%"  height="50" align="left" valign="top" class="Estilo1">1.-</td>
    <td width="74%" align="left" valign="top" class="Estilo1">¿Accidente que tenga como consecuencia la muerte, la pérdida de un miembro o unalesión grave?</td>
    <td><div align="center">
      <input name="R1" type="radio" <?php echo $sEstiloB; ?> <?php echo $sEstiloB; ?> value="1" required>
    </div></td>
    <td><div align="center">
      <input name="R1" type="radio" <?php echo $sEstiloB; ?> <?php echo $sEstiloB; ?> value="2" required>
    </div></td> 
  </tr>
    <tr>
    <td  width="2%" height="50" align="left" valign="top" class="Estilo1">2.-</td>
    <td width="74%" align="left" valign="top" class="Estilo1">¿Asaltos?</td>
    <td><div align="center">
      <input name="R2" type="radio" <?php echo $sEstiloB; ?> value="1" required>
    </div></td>
    <td><div align="center">
      <input name="R2" type="radio" <?php echo $sEstiloB; ?> value="2" required>
    </div></td> 
  </tr>
    <tr>
    <td width="2%" height="50" align="left" valign="top" class="Estilo1">3.-</td>
    <td width="74%" align="left" valign="top" class="Estilo1">¿Actos violentos que derivaron en lesiones graves?</td>
    <td><div align="center">
      <input name="R3" type="radio" <?php echo $sEstiloB; ?> value="1" required>
    </div></td>
    <td><div align="center">
      <input name="R3" type="radio" <?php echo $sEstiloB; ?> value="2" required>
    </div></td> 
  </tr>
    <tr>
    <td width="2%" height="50" align="left" valign="top" class="Estilo1">4.-</td>
    <td width="74%" align="left" valign="top" class="Estilo1">¿Secuestro?</td>
    <td><div align="center">
      <input name="R4" type="radio" <?php echo $sEstiloB; ?> value="1" required>
    </div></td>
    <td><div align="center">
      <input name="R4" type="radio" <?php echo $sEstiloB; ?> value="2" required>
    </div></td> 
  </tr>  <tr>
    <td width="2%" height="50" align="left" valign="top" class="Estilo1">5.-</td>
    <td width="74%" align="left" valign="top" class="Estilo1">¿ Amenazas?, o </td>
    <td><div align="center">
      <input name="R5" type="radio" <?php echo $sEstiloB; ?> value="1" required>
    </div></td>
    <td><div align="center">
      <input name="R5" type="radio" <?php echo $sEstiloB; ?> value="2" required>
    </div></td> 
  </tr>  <tr>
    <td width="2%" height="50" align="left" valign="top" class="Estilo1">6.-</td>
    <td width="74%" align="left" valign="top" class="Estilo1">¿Cualquier otro que ponga en riesgo su vida o salud, y/o la de otras personas?</td>
    <td><div align="center">
      <input name="R6" type="radio" <?php echo $sEstiloB; ?> value="1" required>
    </div></td>
    <td><div align="center">
      <input name="R6" type="radio" <?php echo $sEstiloB; ?> value="2" required>
    </div></td> 
  </tr>
</table>
<br>
<p align="right"><button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-arrow-right"></i>&nbsp;Siguiente</button></p>  </form>
                    </p></div> <br>
				
		  
                </a>
         
        
        </div>
        </div>
	</div>
</div>
   <div class="row">
	  	<div class="col-md-1"> &nbsp;</div>
   		 <div class="col-md-10"> 
  			<div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Avance del 4%</div>
                        </div>
      
                      <div class="progress progress-sm mr-2">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 4%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
		 	  </div>
    	 </div>
  <div class="col-md-1"> &nbsp;</div></div>
   <div class="row"><div class="col-md-12"> 
<h6 align="center">Halzamedic Servicios M&eacute;xico SA de CV<br>www.halza.com.mx</h6></div></div>
    </body>
</html><?php
require "../inc/desconectar.php";
?>