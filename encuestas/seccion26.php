<?php   
require "../inc/settings.php";
require "../inc/funciones.php";  
$iIdE =0;
$iId = 0; 
$IdE=isset( $_GET['IdE'] ) ?    ($_GET['IdE']) : 0 ; 
$Id = isset( $_GET['Id'] ) ?    ($_GET['Id']) : 0 ;   
$iSecc = isset( $_GET['Sc'] ) ?    ($_GET['Sc']) : 0 ;  
$iIdE =  base64_decode($IdE);
$iId  =  base64_decode($Id);
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
.Estilo2 {	color: #FFFFFF;
	font-weight: bold;
	font-size:18px
}
.EstiloN1m1 {	color: #000;
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
	 	 
	 	 <td width="20%" align="right" valign="middle"><img src="logos/<?php echo $sLogo;?>" width="214" height="72" ></td></tr></table></h1>
        <div class="list-group"  style="height:600px; background:#28B5ED; background-image:url(img/fnd3.png); background-position:center; background-repeat:no-repeat ">
		 
           
<p>&nbsp;</p> 
                <div class="col-md-12">            
                    <p class="list-group-item-heading EstiloN1m">Las siguientes preguntas están relacionadas con las actitudes de los trabajadores que supervisa.</p>
                    <form action="regseccionfin.php?Is=<?php echo $iSecc;?>&IdE=<?php echo   $IdE;?>&Id=<?php echo   $Id;?>" method="post" enctype="multipart/form-data">
					<input name="ssec" type="hidden" value="<?php $iSecc = $iSecc +1; echo   $iSecc;?>">
					<input name="ss" type="hidden" value="<?php echo   session_id();?>">
					<input name="PgI" type="hidden" value="138">
					<input name="Pg" type="hidden" value="142">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table-bordered">
                        <tr>
                          <td height="50" colspan="2" align="left" valign="middle"><p>&nbsp;</p></td>
                          <td colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" class="EstiloN1m1"><div align="center">Si</div></td>
                          <td colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" class="EstiloN1m1"><div align="center">No</div></td>
                        </tr>
                        <tr>
                          <td width="4%" height="50" align="left" valign="top" class="Estilo2">138.-</td>
                          <td width="60%" align="left" valign="top" class="Estilo2">Soy jefe de otros trabajadores:</td>
                          <td colspan="3"><div align="center">
                              <input name="R138" type="radio" value="1" required onClick="Muestra(1)" >
                          </div>                            </td>
                          <td colspan="3"><div align="center">
                            <input name="R138" type="radio" value="2" required checked onClick="Muestra(0)"  >
                          </div></td>
                        </tr></table>
								<div id="Oculta" style="display:none">
						 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table-bordered">
			
                        <tr>
                          <td height="50" colspan="2" align="left" valign="middle"><p>&nbsp;</p></td>
                          <td width="7%" align="center" valign="middle" bgcolor="#FFFFFF" class="EstiloN1m1"><div align="center"><strong>Si</strong>empre</div></td>
                          <td width="7%" align="center" valign="middle" bgcolor="#FFFFFF" class="EstiloN1m1"><div align="center">Casi siempre </div></td>
                          <td colspan="2" align="center" valign="middle" bgcolor="#FFFFFF" class="EstiloN1m1"><div align="center">Algunas Veces </div></td>
                          <td width="7%" align="center" valign="middle" bgcolor="#FFFFFF" class="EstiloN1m1"><div align="center"><strong>Casi Nunca </strong></div></td>
                          <td width="7%" align="center" valign="middle" bgcolor="#FFFFFF" class="EstiloN1m1"><div align="center"><strong>Nunca</strong></div></td>
                        </tr>
                        <tr>
                          <td  width="4%" height="50" align="left" valign="top" class="Estilo2">139.-</td>
                          <td width="60%" align="left" valign="top" class="Estilo2">Comunican tarde los asuntos de trabajo</td>
                          <td><div align="center">
                              <input name="R139" type="radio" value="1" required>
                          </div></td>
                          <td><div align="center">
                              <input name="R139" type="radio" value="2" required>
                          </div></td>
                          <td colspan="2"><div align="center">
                              <input name="R139" type="radio" value="3" required>
                          </div></td>
                          <td><div align="center">
                              <input name="R139" type="radio" value="4" required>
                          </div></td>
                          <td><div align="center">
                              <input name="R139" type="radio" value="0" required checked="checked">
                          </div></td>
                        </tr>
                        <tr>
                          <td width="4%" height="50" align="left" valign="top" class="Estilo2">140.-</td>
                          <td width="60%" align="left" valign="top" class="Estilo2">Dificultan el logro de los resultados del trabajo </td>
                          <td><div align="center">
                              <input name="R140" type="radio" value="1" required>
                          </div></td>
                          <td><div align="center">
                              <input name="R140" type="radio" value="2" required>
                          </div></td>
                          <td colspan="2"><div align="center">
                              <input name="R140" type="radio" value="3" required>
                          </div></td>
                          <td><div align="center">
                              <input name="R140" type="radio" value="4" required>
                          </div></td>
                          <td><div align="center">
                              <input name="R140" type="radio" value="0" required checked="checked">
                          </div></td>
                        </tr>
                        <tr>
                          <td width="4%" height="50" align="left" valign="top" class="Estilo2">141.-</td>
                          <td width="60%" align="left" valign="top" class="Estilo2">Cooperan poco cuando se necesita</td>
                          <td><div align="center">
                              <input name="R141" type="radio" value="1" required>
                          </div></td>
                          <td><div align="center">
                              <input name="R141" type="radio" value="2" required>
                          </div></td>
                          <td colspan="2"><div align="center">
                              <input name="R141" type="radio" value="3" required>
                          </div></td>
                          <td><div align="center">
                              <input name="R141" type="radio" value="4" required>
                          </div></td>
                          <td><div align="center">
                              <input name="R141" type="radio" value="0" required checked="checked">
                          </div></td>
						  
                        </tr><tr>
                          <td width="4%" height="50" align="left" valign="top" class="Estilo2">142.-</td>
                          <td width="60%" align="left" valign="top" class="Estilo2">Ignoran las sugerencias para mejorar su trabajo</td>
                          <td><div align="center">
                              <input name="R142" type="radio" value="1" required>
                          </div></td>
                          <td><div align="center">
                              <input name="R142" type="radio" value="2" required>
                          </div></td>
                          <td colspan="2"><div align="center">
                              <input name="R142" type="radio" value="3" required>
                          </div></td>
                          <td><div align="center">
                              <input name="R142" type="radio" value="4" required>
                          </div></td>
                          <td><div align="center">
                              <input name="R142" type="radio" value="0" required checked="checked">
                          </div></td>
						  
                        </tr>
					
                      </table>
                      <br>
        </div>
<p>&nbsp;</p>
<p align="right"><button class="btn btn-success " type="submit"><i class="glyphicon glyphicon-arrow-right"></i>&nbsp;Siguiente</button></p>  </form>
          </p></div> <br>   </a>
         
         
	</div>
</div>
   <div class="row">
					  
  <div class="col-md-1"> &nbsp;</div>
    <div class="col-md-10"> 
 
		<div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Avance del 99%</div>
                        </div>
      
                      <div class="progress progress-sm mr-2">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 99%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                      </div></h6>
					  
<h6 align="center">Halzamedic Servicios M&eacute;xico SA de CV<br>www.halza.com.mx</h6>
    </div>
  <div class="col-md-1"> &nbsp;</div>
    </body>
	<script>
	function Muestra(Id)
	{
	
	if(Id==1)
		{
		$("#Oculta").show();

		}
	else
		{
		$("#Oculta").hide();
		
		}
	}
	</script>
</html><?php
require "../inc/desconectar.php";
?>