<?php     ob_start();  
require "../inc/settings.php";
require "../inc/funciones.php";  
$iIdE =0;
$iId = 0; 
$IdE=isset( $_GET['IdE'] ) ?    ($_GET['IdE']) : 0 ; 
$Id = isset( $_GET['Id'] ) ?    ($_GET['Id']) : 0 ;   
$iSecc = isset( $_GET['Sc'] ) ?    ($_GET['Sc']) : 0 ;  
$iIdE =  base64_decode($IdE);
$iId  =  base64_decode($Id);
$iNivelEncuesta = 0; 
$sLogo = "hecim.png";
$stEmpresa = "";
$sSqlCB  = " SELECT distinct  Empresa,Logotipo,NivelEncuesta FROM ts_encuestas e   WHERE e.EstadoId= 1 and EncuestaId = ? ";
if ($stmt = mysqli_prepare($link, $sSqlCB )) {
 							mysqli_stmt_bind_param($stmt,'i',$iIdE);
				            mysqli_stmt_execute($stmt);
						 	mysqli_stmt_bind_result($stmt,$stEmpresa,$sLogo,$iNivelEncuesta);
							while (mysqli_stmt_fetch($stmt)) 
												{ 
							
												}
        					mysqli_stmt_close($stmt);							
											}

 
if($iNivelEncuesta > 2)
	{
	$iSecc2 =13;
		header("location: ./regseccion2.php?Nv=2&Is=".$iSecc."&IdE=".$IdE."&Id=".$Id."&ssec=".$iSecc2. "&ss=" . session_id());
		
	 
		exit();
	}
?><!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Halza Encuesta</title><!-- <?php echo "IE = $iIdE , I = $iId";?> -->

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
	font-size:16px
}
.Estilo1m {
	color: #FFFFFF;
	font-weight: bold;
	font-size:16px
}
.EstiloN1m {
	color: #000;
	font-weight: bold;
	font-size:16px
}
.EstiloN1 {
	color: #000;
	font-weight: bold;
	font-size:15px
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
	 	 
	 	 <td width="20%" align="right" valign="middle"><img src="logos/<?php echo $sLogo;?>" width="214" height="72" ></td></tr></table></h1>
        <div class="list-group"  style="height:600px; background:#28B5ED; background-image:url(img/fnd3.png); background-position:center; background-repeat:no-repeat ">
		 
            
                <div class="col-md-12">            <p class="list-group-item-heading">&nbsp;</p>
                    <p class="list-group-item-heading EstiloN1m"><strong>IDENTIFICAR  LOS FACTORES DE RIESGO&nbsp;PSICOSOCIAL. </strong><br>Para responder las preguntas siguientes considere las condiciones de su centro de trabajo, así como la cantidad y ritmo detrabajo</p>
                  
                      <form action="regseccion.php?Is=<?php echo $iSecc;?>&IdE=<?php echo   $IdE;?>&Id=<?php echo   $Id;?>" method="post" enctype="multipart/form-data">
                         
                      <input name="ssec" type="hidden" value="<?php $iSecc = $iSecc +1; echo   $iSecc;?>">
					  <input name="ss" type="hidden" value="<?php echo   session_id();?>">
					  <input name="PgI" type="hidden" value="21">
					  <input name="Pg" type="hidden" value="29">
					 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table-bordered">
                          <tr>
                            <td height="40" colspan="2" align="left" valign="middle"   class="EstiloN1m"></td>
                            <td width="7%" align="center" valign="middle" bgcolor="#FFCC00" class="EstiloN1m"><div align="center"><strong>Si</strong>empre</div></td>
                            <td width="7%" align="center" valign="middle" bgcolor="#FFCC00" class="EstiloN1m"><div align="center">Casi siempre </div></td>
                            <td width="7%" align="center" valign="middle" bgcolor="#FFCC00" class="EstiloN1m"><div align="center">Algunas Veces </div></td>
                            <td width="7%" align="center" valign="middle" bgcolor="#FFCC00" class="EstiloN1m"><div align="center"><strong>Casi Nunca </strong></div></td>
                            <td width="7%" align="center" valign="middle" bgcolor="#FFCC00" class="EstiloN1m"><div align="center"><strong>Nunca</strong></div></td>
                          </tr>
                          <tr>
                            <td width="3%" height="40" align="left" valign="top" class="Estilo1m">21.-</td>
                            <td width="62%" align="left" valign="top" class="Estilo1m">Mi trabajo me exige hacer mucho esfuerzo físico</td>
                            <td><div align="center">
                                <input name="R21" type="radio" value="4" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R21" type="radio" value="3" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R21" type="radio" value="2" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R21" type="radio" value="1" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R21" type="radio" value="0" required >
                            </div></td>
                          </tr>
                          <tr>
                            <td  width="3%" height="40" align="left" valign="top" class="Estilo1m">22.-</td>
                            <td width="62%" align="left" valign="top" class="Estilo1m">Me preocupa sufrir un accidente en mi trabajo</td>
                            <td><div align="center">
                                <input name="R22" type="radio" value="4" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R22" type="radio" value="3" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R22" type="radio" value="2" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R22" type="radio" value="1" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R22" type="radio" value="0" required >
                            </div></td>
                          </tr>
                          <tr>
                            <td width="3%" height="40" align="left" valign="top" class="Estilo1m">23.-</td>
                            <td width="62%" align="left" valign="top" class="Estilo1m">Considero que las actividades que realizo son peligrosas</td>
                            <td><div align="center">
                                <input name="R23" type="radio" value="4" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R23" type="radio" value="3" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R23" type="radio" value="2" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R23" type="radio" value="1" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R23" type="radio" value="0" required >
                            </div></td>
                          </tr>
                          <tr>
                            <td width="3%" height="40" align="left" valign="top" class="Estilo1m">24.-</td>
                            <td width="62%" align="left" valign="top" class="Estilo1m">Por la cantidad de trabajo que tengo debo quedarmetiempo adicional a mi turno</td>
                            <td><div align="center">
                                <input name="R24" type="radio" value="4" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R24" type="radio" value="3" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R24" type="radio" value="2" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R24" type="radio" value="1" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R24" type="radio" value="0" required >
                            </div></td>
                          </tr>
                          <tr>
                            <td width="3%" height="40" align="left" valign="top" class="Estilo1m">25.-</td>
                            <td width="62%" align="left" valign="top" class="Estilo1m">Por la cantidad de trabajo que tengo debo trabajar sin parar</td>
                            <td><div align="center">
                                <input name="R25" type="radio" value="4" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R25" type="radio" value="3" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R25" type="radio" value="2" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R25" type="radio" value="1" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R25" type="radio" value="0" required >
                            </div></td>
                          </tr>
                          <tr>
                            <td width="3%" height="40" align="left" valign="top" class="Estilo1m">26.-</td>
                            <td width="62%" align="left" valign="top" class="Estilo1m">Considero que es necesario mantener un ritmo de trabajoacelerado</td>
                            <td><div align="center">
                                <input name="R26" type="radio" value="4" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R26" type="radio" value="3" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R26" type="radio" value="2" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R26" type="radio" value="1" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R26" type="radio" value="0" required >
                            </div></td>
                          </tr>
                          <tr>
                            <td height="40" align="left" valign="top" class="Estilo1m">27.-</td>
                            <td align="left" valign="top" class="Estilo1m">Mi trabajo exige que esté muy concentrado</td>
                            <td><div align="center">
                                <input name="R27" type="radio" value="4" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R27" type="radio" value="3" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R27" type="radio" value="2" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R27" type="radio" value="1" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R27" type="radio" value="0" required >
                            </div></td>
                          </tr>
                          <tr>
                            <td height="40" align="left" valign="top" class="Estilo1m">28.-</td>
                            <td align="left" valign="top" class="Estilo1m">Mi trabajo requiere que memorice mucha información</td>
                            <td><div align="center">
                                <input name="R28" type="radio" value="4" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R28" type="radio" value="3" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R28" type="radio" value="2" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R28" type="radio" value="1" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R28" type="radio" value="0" required >
                            </div></td>
                          </tr>
                          <tr>
                            <td height="40" align="left" valign="top" class="Estilo1m">29.-</td>
                            <td align="left" valign="top" class="Estilo1m">Mi trabajo exige que atienda varios asuntos al mismotiempo</td>
                            <td><div align="center">
                                <input name="R29" type="radio" value="4" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R29" type="radio" value="3" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R29" type="radio" value="2" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R29" type="radio" value="1" required>
                            </div></td>
                            <td><div align="center">
                                <input name="R29" type="radio" value="0" required >
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
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Avance del 17%</div>
                        </div>
      
                      <div class="progress progress-sm mr-2">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 17%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                      </div></h6>
					  
<h6 align="center">Halzamedic Servicios M&eacute;xico SA de CV<br>www.halza.com.mx</h6>
    </div>
  <div class="col-md-1"> &nbsp;</div>
    </body>

</html><?php
ob_end_flush();
require "../inc/desconectar.php";
?>