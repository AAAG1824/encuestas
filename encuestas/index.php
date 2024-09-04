<?php    ob_start();   

require "../inc/settings.php";
require "../inc/funciones.php";  


$sClave=isset( $_GET['C'] ) ?  Limpieza($_GET['C']) : '' ; 

 $iEncuestaId= 0;
$sLogo = "hecim.png";
$sSql   = " SELECT EncuestaId,Logotipo FROM ts_encuestas  WHERE Clave = ? AND EstadoId = 1  AND  (  $GblFecha between FechaInicio AND FechaFin ) ORDER BY  EncuestaId  DESC LIMIT 0,1";
 if ($stmt = mysqli_prepare($link, $sSql )) {
 		mysqli_stmt_bind_param($stmt,'s',$sClave);
				            mysqli_stmt_execute($stmt);
						 	mysqli_stmt_bind_result($stmt,$iEncuestaId,$sLogo);
							while (mysqli_stmt_fetch($stmt)) 
												{ 
							
												}
      			  mysqli_stmt_close($stmt);
												
															}
 
$sSqlCB  = " SELECT distinct EncuestaId ,Empresa FROM ts_encuestas e ";
$sSqlCB .= " WHERE e.EstadoId= 1 AND  (  $GblFecha between FechaInicio AND FechaFin ) Order by Empresa ";
if($iEncuestaId==0)
	{
	 header("location: perror.php?IdRpt=1");
				 exit();
	}  

?><!DOCTYPE html>
<html lang="es">
    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        
        <title>Halza Encuesta </title>
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> 
 <script>
if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
   location.href = "./indexm.php?C=<?php echo $sClave;?>";
}
</script>
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
	font-size:17px
}
.EstiloN1m {
	color: #000;
	font-weight: bold;
	font-size:17px
}
.EstiloN1 {
	color: #000; 
	font-size:16px
}

.EstiloHd {
	color: #fff;
	font-weight: bold;
	font-size:28px
}
 .MsgOrg1 {
	 display: block;
}
 .cssFondo {
 height:700px; 
 background:#28B5ED; 
 background-image:url(img/fnd3.png); 
 background-position:center;
  background-repeat:no-repeat;
 }
 .hdText {
  font-size:24px;
 }
 .TdTitle {
 display: none; 
 }
.MInstr{
 display: none; 
}
.MInstrT{
 display: none; 
  font-size:10px;
}
@media screen and (max-width: 980px) {

.ImgP   {
	 display: none;
} 
.MInstr{
 display: block; 
}
.MInstrT{
 display: block; 
  font-size:12px;
}
.MsgOrg1 {
	 display: none;
}
.MsgOrg2{
	 display: block;
}
 .hdText1 {
  font-size:16px; 
 }
 .hdText  { 
 display: none;
 }
 .TdTitle {
  display: block; 
 }
 .cssFondo {
 height:800px; 
 background:#28B5ED; 
 background-image:url(img/fnd3.png); 
 background-position:center;
  background-repeat:no-repeat;
 }
}
</style>
    </head>
    <body> 
<div class="container">
    <div class="row">
		<div class="well">
        <span class="text-center">
		 <table width="100%">
		 <tr>
		 	<td width="20%"  align="left" valign="middle" ><img src="img/logo.png"></td>
			 <td width="60%" align="center" valign="middle" class="hdText"> Factores de riesgo psicosocial en el trabajo <BR>NOM-035-STPS-2018 </td>
	 		 <td width="20%" align="right" valign="middle"><img src="logos/<?php echo $sLogo;?>" width="214" height="72" ></td>
		 </tr> 
		 </table></span>
		 <span class="TdTitle hdText1" ><center>Factores de riesgo psicosocial en el trabajo<BR><b>NOM-035-STPS-2018</b></center></span>
        <div class="list-group cssFondo"  >
		 
            
                <div class="col-md-12">            
                          <p class="list-group-item-heading">&nbsp;</p>
                      <table width="100%" border="0" cellspacing="5" cellpadding="5">
                        <tr>
                          <td width="56%">&nbsp;</td>
                          <td width="44%">&nbsp;</td>
                        </tr>
                        <tr>
                          <td rowspan="2" align="left" valign="top" class="EstiloN1">  <form class="FrmPreguntas" action="valida.php" enctype="multipart/form-data" method="post"> 
					 	 <input name="Acc" type="hidden" value="A">
						   <input name="EmpresaId" type="hidden" value="<?php echo $iEncuestaId; ?>"> <select name="EmpresaId2"  style="display: none;" required disabled   class="form-control" >
					  <option value="">--  SELECCIONE UNA EMPRESA --</option>
					  <?php
					  $intTId=0;
					  $strTName ='';
					   $seleccionado = '';
					  
				if ($stmt = mysqli_prepare($link, $sSqlCB )) {
				            mysqli_stmt_execute($stmt);
						 	mysqli_stmt_bind_result($stmt,$intTId,$strTName);
							while (mysqli_stmt_fetch($stmt)) 
												{
												$strTName = LimpiezaMayusculas($strTName);
					                 $seleccionado = '';
												if($iEncuestaId == $intTId )  { $seleccionado = " Selected ";}
							      echo "<option value=$intTId $seleccionado >$strTName</option>";
							
												}
      			  mysqli_stmt_close($stmt);
												
															}
					  ?> 
                      </select>   
						  	 
						  <div class="form-group row">
								<div class="col-sm-1">&nbsp;</div>
								<div class="col-sm-6"><label>No. Nomina</label> 
                  				<input type="number" class="form-control " id="Nomina" name="Nomina"   required>
								</div>
								<div class="col-sm-5"><label>Edad</label> 
               				   <input type="number" class="form-control " id="Edad" name="Edad"   required>
								</div>
						</div>
						
						  <div class="form-group row">
								<div class="col-sm-1">&nbsp;</div>
								<div class="col-sm-11"><label>Grado Estudio</label> 
                  					 <select name="GradoId"  required   class="form-control" >
					  <option value="">--  SELECCIONE EL GRADO DE ESTUDIO  --</option>
					  <?php
					  $intTId=0;
					  $strTName ='';
					   
$sSqlCB  = " SELECT distinct GradoId ,GradoEstudio FROM ts_gradoestudio     WHERE  EstadoId= 1   Order by GradoEstudio  ";  
				if ($stmt = mysqli_prepare($link, $sSqlCB )) {
				            mysqli_stmt_execute($stmt);
						 	mysqli_stmt_bind_result($stmt,$intTId,$strTName);
							while (mysqli_stmt_fetch($stmt)) 
												{
												$strTName = LimpiezaMayusculas($strTName);
							      echo "<option value=$intTId>$strTName</option>";
							
												}
      			  mysqli_stmt_close($stmt);
												
															}
					  ?> 
                      </select> 
								</div>
								 
						</div>
							
							  <div class="form-group row">
								<div class="col-sm-1">&nbsp;</div>
								<div class="col-sm-6"><label>Area</label> 
                  				<input type="text" class="form-control " id="Area" name="Area"   required>
								</div>
								<div class="col-sm-5"><label>Departamento</label> 
               				   <input type="text" class="form-control " id="Departamento" name="Departamento"   required>
								</div>
						</div>
						<div class="form-group row">
								<div class="col-sm-1">&nbsp;</div>
								<div class="col-sm-11"><label>Genero</label> <div class="custom-control custom-checkbox"><input type="radio" class="custom-control-input" id="Genero" name="Genero" required value="1">
                        <label class="text-left" for="customCheck">Masculino</label>&nbsp;&nbsp;<input type="radio" class="custom-control-input" id="Genero" name="Genero" checked  required value="2">
                        <label class="text-left" for="customCheck">Femenino</label>
                      </div></div>
								</div>
							</div>  
							<div class="form-group row MsgOrg1">
								<div class="col-sm-1">&nbsp;</div>
								<div class="col-sm-11">
								 <ul  >
								    <li class="text-left">Encuesta Personal</li> 
								    <li class="text-left">La informaci&oacute;n proporcionada es confidencial y solamente se utiliza con fines estadisticos</li> 
								    <li class="text-left">Conteste con honestidad, no hay respuestas correctas e incorrectas</li> 
								    <li class="text-left">Tomar en cuenta los &uacute;ltimos dos meses</li>
							      </ul>
							</div>
							 </div> 
							 <div class="form-group row">
								<div class="col-sm-4">&nbsp;</div>
								<div class="col-sm-4"><center> 	<strong>	 <input name="submit" type="submit" value="Ingresar"  class="btn btn-primary btn-user btn-block Estilo1m"></strong></center></div>
						    <div class="col-sm-4">&nbsp;</div></div>
						   </form>
						  </td>
                          <td><img  class="ImgP"  src="img/login_im.png" >
						  <span class="MInstr">
						   <ul >
								    <li class="text-left MInstrT">- Encuesta Personal<br><br></li> 
								    <li class="text-left MInstrT">- La informaci&oacute;n proporcionada es confidencial y solamente se utiliza con fines estadisticos<br><br></li> 
								    <li class="text-left MInstrT">- Conteste con honestidad, no hay respuestas correctas e incorrectas<br><br></li> 
								    <li class="text-left MInstrT">- Tomar en cuenta los &uacute;ltimos dos meses<br><br></li>
							      </ul>
						  </span></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                        </tr>
                      </table>
                      <br> 
                    </p></div> <br>
				
		  
                </a>
         
        
        </div>
        </div>
	</div>
</div>
   <div class="row">
					  
  <div class="col-md-1"> &nbsp;</div>
    <div class="col-md-10"> 
 
		   
<h6 align="center">Halzamedic Servicios M&eacute;xico SA de CV<br>www.halza.com.mx</h6>
    </div>
  <div class="col-md-1"> &nbsp;</div>
    </div></body>
</html><?php
ob_end_flush();
require "../inc/desconectar.php";
?>