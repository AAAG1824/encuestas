<?php   
require "../inc/settings.php";
require "../inc/funciones.php";  
$iIdE =0;
$iId = 0; 
$IdE=isset( $_GET['IdE'] ) ?    ($_GET['IdE']) : 0 ; 
$Id = isset( $_GET['Id'] ) ?    ($_GET['Id']) : 0 ;    	
$iIdE =  base64_decode($IdE);
$iId  =  base64_decode($Id);
 

$sLogo = "hecim.png";
$stEmpresa = "";
 $Clave="";
$sSqlCB  = " SELECT distinct    Clave,Empresa,Logotipo FROM ts_encuestas e   WHERE e.EstadoId= 1 and EncuestaId = ? ";
if ($stmt = mysqli_prepare($link, $sSqlCB )) {
 							mysqli_stmt_bind_param($stmt,'i',$iIdE);
				            mysqli_stmt_execute($stmt);
						 	mysqli_stmt_bind_result($stmt, $Clave,$stEmpresa,$sLogo);
							while (mysqli_stmt_fetch($stmt)) 
												{ 
							
												}
        					mysqli_stmt_close($stmt);							
											}

 

?><!DOCTYPE html>
<html lang="es">
    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        
        <title>Halza Encuesta</title><!-- <?php echo "IE = $iIdE , I = $iId , L=$sLogo";?> -->
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

.EstiloHd {
	color: #fff;
	font-weight: bold;
	font-size:28px
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
                          <p class="list-group-item-heading">&nbsp;</p>
                      <table width="100%" border="0" cellspacing="5" cellpadding="5">
                        <tr>
                          <td width="56%">&nbsp;</td>
                          <td width="44%">&nbsp;</td>
                        </tr>
                        <tr>
                          <td rowspan="2" align="center" valign="middle" class="EstiloHd"><p>¡ Gracias ! </p>
                            <p>&nbsp;</p>
                            <p>Agradecemos su 
                            participación                            </p>
                            <p><br>
                              </p>
                          <div align="center"><a href="index.php?C=<?php echo $Clave; ?>"><button class="btn-danger btn  EstiloHd" type="submit">Finalizar</button></p> </a></div></td>
                          <td><img src="img/login_im.png" ></td>
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
require "../inc/desconectar.php";
?>