<?php   
require "./inc/settings.php";
require "./inc/funciones.php"; 
require "./inc/validasession.php";  
$iId= isset( $_GET['Id'] ) ?    ($_GET['Id']) : 0 ;  
$iIdE= isset( $_GET['IdE'] ) ?    ($_GET['IdE']) : 0 ;  
$arrSiNo = array("--","Si","No");
$arrLiker = array("Siempre","Casi siempre","Algunas Veces","Casi Nunca","Nunca");

$iSecc = 1;
$sLogo = "hecim.png";
$stEmpresa = "";$sNivel="";	
$sSqlCB  = " SELECT distinct  Empresa,Logotipo, NivelEncuesta FROM ts_encuestas     WHERE  EstadoId= 1 and EncuestaId = ? ";
if ($stmt = mysqli_prepare($link, $sSqlCB )) {
 							mysqli_stmt_bind_param($stmt,'i',$iId);
				            mysqli_stmt_execute($stmt);
						 	mysqli_stmt_bind_result($stmt,$stEmpresa,$sLogo,$sNivel);
							while (mysqli_stmt_fetch($stmt)) 
												{ 
							
												}
        					mysqli_stmt_close($stmt);							
											}
$sContestarId="";   $sNoNomina=""; $sEdad=""; $iGenero="";$sGenero=""; $sGradoEstudio=""; $sArea=""; $sDepartamento=""; $sFecha	="";	
$ssCad = "";						
if($iIdE>0)
	{  $ssCad= " and e.ContestarId  = $iIdE ";	}						
								
$arrDatos[] ="NADA";											
$sSql  = "SELECT e.ContestarId,   e.NoNomina, e.Edad, e.Genero,s.Genero, g.GradoEstudio, e.Area, e.Departamento, e.Fecha ";
$sSql .= " FROM ts_encuestausuarios  e INNER JOIN  ts_gradoestudio g  on g.GradoId  = e.EstudiosId INNER JOIN ts_genero s ";
$sSql .= " ON s.GeneroId = e.Genero WHERE  e.EncuestaId = ?  and e.EstadoId = 2  $ssCad   ORDER BY e.ContestarId  DESC	 ";
if ($stmt = mysqli_prepare($link, $sSql )) {
 mysqli_stmt_bind_param($stmt,'i',$iId);
 mysqli_stmt_execute($stmt);
 mysqli_stmt_bind_result($stmt,$sContestarId,   $sNoNomina, $sEdad, $iGenero,$sGenero, $sGradoEstudio, $sArea, $sDepartamento,  $sFecha	);
 while (mysqli_stmt_fetch($stmt)) 
	 { 
 $arrDatos[] = $sContestarId."|".$sNoNomina."|".$sEdad."|".$iGenero."|".$sGenero."|".$sGradoEstudio."|".$sArea."|".$sDepartamento."|".$sFecha;					
 	}
        					mysqli_stmt_close($stmt);							
											}								

											
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Impresion de Respuetas </title>
<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #000000;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.Estilo1 {font-size: 14px}
-->
</style></head>

<body>

<?php
$sSaltoL = "<div style='page-break-before:always;'></div> ";
$iRen = 0; 
$count = count($arrDatos);


function BuscaArr($arrBusq,$valor)
{
$found = -1;
 $cont = count( $arrBusq);
 for($i=1; $i<$cont; $i++)
 	{
	if($valor == $arrBusq[$i][0])
		{
		return $arrBusq[$i][1];
		}
	
	}
 return $found;

}
 //$count = 2;
for ($i = 1; $i < $count; $i++) 
{
$sCadena =  $arrDatos[$i] ;
$ArrCad  =  explode	("|", $sCadena);
$NoEncuestaC = $ArrCad[0]; 

 

	 	$arrRespuestas[]	 = array(0,999); 
$PreguntaId=0;
$RespuestaId=0;
$sSql  = " SELECT PreguntaId,RespuestaId FROM  ts_encuestarespuesta  WHERE  ContestarId   = ?";
 if ($stmt = mysqli_prepare($link, $sSql )) {
 mysqli_stmt_bind_param($stmt,'i',$NoEncuestaC);
 mysqli_stmt_execute($stmt);
 mysqli_stmt_bind_result($stmt,$PreguntaId, $RespuestaId );
 while (mysqli_stmt_fetch($stmt)) 
	 {  
	 	$arrRespuestas[]	 = array( $PreguntaId, $RespuestaId); 
 	}
        					mysqli_stmt_close($stmt);
			//		 	  print_r( $arrRespuestas);
								  
 }
 
$iTipoE = BuscaArr($arrRespuestas,60);  

  if($iRen >0 ) { echo $sSaltoL ;} 

if( $iTipoE  > 0  ) {
   ?>
 
<table width="838" border="0" cellspacing="0" cellpadding="0"  >
  <tr>
    <td colspan="2"><img src="encuestas/logos/<?php echo $sLogo;?>" width="214" height="65" /></td>
    <td colspan="3"><h3 align="center" class="Estilo1">Factores de riesgo psicosocial en el trabajo<br />
    NOM-035-STPS-2018<br />Nivel Encuesta  <?php echo $sNivel  ;?> 
    </h3></td>
    <td colspan="2"><img src="encuestas/logos/logo halza_lgt.jpg" width="237" height="85" /></td>
  </tr>
  <tr >
    <td width="120" height="25" style="border-bottom:solid 2px" ><div align="center">No. Nomina</div></td>
    <td width="94"  style="border-bottom:solid 2px; border-left: solid 2px; border-left-color:#FFFFFF"><div align="center">Edad</div></td>
    <td width="31"  style="border-bottom:solid 2px; border-left: solid 2px; border-left-color:#FFFFFF"><div align="center">Sexo</div></td>
    <td width="192" style="border-bottom:solid 2px; border-left: solid 2px; border-left-color:#FFFFFF"><div align="center">Grado Estudio</div></td>
    <td width="228" style="border-bottom:solid 2px; border-left: solid 2px; border-left-color:#FFFFFF"><div align="center">Area</div></td>
    <td width="82" style="border-bottom:solid 2px; border-left: solid 2px; border-left-color:#FFFFFF"><div align="center">Departamento</div></td>
    <td width="91" style="border-bottom:solid 2px; border-left: solid 2px; border-left-color:#FFFFFF"><div align="center">Fecha</div></td>
  </tr>
  <tr >
    <td height="25"  style="border-bottom: #999999 solid 1px" align="center" valign="top"><?php echo $ArrCad[1];?></td>
    <td style="border-bottom: #999999 solid 1px; border-left: solid 2px; border-left-color:#FFFFFF" align="center" valign="top"><?php echo $ArrCad[2];?></td>
    <td style="border-bottom: #999999 solid 1px; border-left: solid 2px; border-left-color:#FFFFFF" align="center" valign="top"><?php echo substr($ArrCad[4],0,1);?></td>
    <td style="border-bottom: #999999 solid 1px; border-left: solid 2px; border-left-color:#FFFFFF" align="center" valign="top"><?php echo $ArrCad[5];?></td>
    <td style="border-bottom: #999999 solid 1px; border-left: solid 2px; border-left-color:#FFFFFF"  align="center" valign="top"><?php echo $ArrCad[6];?></td>
    <td style="border-bottom: #999999 solid 1px; border-left: solid 2px; border-left-color:#FFFFFF"  align="center" valign="top"><?php echo $ArrCad[7];?></td>
    <td style="border-bottom: #999999 solid 1px; border-left: solid 2px; border-left-color:#FFFFFF"  align="center" valign="top"><?php 
	echo FechaSistema($ArrCad[8],4);?></td>
  </tr>
  <tr >
    <td height="25" colspan="7" align="left" valign="top"  style=" border:#999999 solid 1px"  >
    <table width="838" border="0" cellspacing="5" cellpadding="5">
      <tr>
        <td width="402" align="left" valign="top">
 <!-- Ini - SEccion A -->      <table width="402" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="3" align="left" valign="top"> <strong>I.- Acontecimiento traumático severo </strong><br />
Ha presenciado o sufrido alguna vez, durante o con motivo del trabajo un acontecimiento como los siguientes:</td>
            </tr>
             <tr>
            <td width="326" align="left" valign="top">¿Accidente que tenga como consecuencia la muerte, la pérdida de un miembro o unalesión grave?</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,1) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,1)];} ?></strong></td>
          </tr>
          
             <tr>
            <td width="326" align="left" valign="top">¿Asaltos?</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,2) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,2)];} ?></strong></td>
          </tr>
          
             <tr>
            <td width="326" align="left" valign="top">¿Actos violentos que derivaron en lesiones graves?</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,3) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,3)];} ?></strong></td>
          </tr>
          
             <tr>
            <td width="326" align="left" valign="top">¿Secuestro? </td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,4) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,4)];} ?></strong></td>
          </tr>
          
             <tr>
            <td width="326" align="left" valign="top">¿Amenazas?, o </td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,5) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,5)];} ?></strong></td>
          </tr>
          
             <tr>
            <td width="326" align="left" valign="top">¿Cualquier otro que ponga en riesgo su vida o salud, y/o la de otras personas?</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,6) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,6)];} ?></strong></td>
          </tr> 
         <tr>
            <td colspan="3" align="left" valign="top"><img src="img/blank.png" width="115" height="5" /></td>
            </tr>
         <tr>
            <td colspan="3" align="left" valign="top"><strong> II.- Recuerdos persistentes sobre el acontecimiento (durante el último mes):</strong></td>
            </tr> <tr>
            <td width="326" align="left" valign="top">¿Ha tenido recuerdos recurrentes sobre el acontecimiento que le provocan malestares? </td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,7) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,7)];} ?></strong></td>
          </tr>
          
          <tr>
            <td width="326" align="left" valign="top">¿Ha tenido sueños de carácter recurrente sobre el acontecimiento, que le producenmalestar?</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,8) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,8)];} ?></strong></td>
          </tr> 
         <tr>
<td colspan="3" align="left" valign="top"><img src="img/blank.png" width="115" height="5" /></td>
            </tr> 
         <tr>
            <td colspan="3" align="left" valign="top"><strong>III.- Esfuerzo por evitar circunstancias parecidas o asociadas al acontecimiento (durante el último mes):</strong></td>
            </tr> <tr>
            <td width="326" align="left" valign="top">¿Se ha esforzado por evitar todo tipo de sentimientos, conversaciones o situaciones que le puedan recordar el acontecimiento? </td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,9) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,9)];} ?></strong></td>
          </tr>
          
          <tr>
            <td width="326" align="left" valign="top">¿Se ha esforzado por evitar todo tipo de actividades, lugares o personas que motivan recuerdos del acontecimiento? </td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,10) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,10)];} ?></strong></td>
          </tr>
           
          <tr>
            <td width="326" align="left" valign="top">¿Ha tenido dificultad para recordar alguna parte importante del evento? </td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,11) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,11)];} ?></strong></td>
          </tr>
           
          <tr>
            <td width="326" align="left" valign="top">¿Ha disminuido su interés en sus actividades cotidianas?</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,12) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,12)];} ?></strong></td>
          </tr>
           
          <tr>
            <td width="326" align="left" valign="top">¿Se ha sentido usted alejado o distante de los demás? </td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,13) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,13)];} ?></strong></td>
          </tr>
           
          <tr>
            <td width="326" align="left" valign="top">¿Ha notado que tiene dificultad para expresar sus sentimientos? </td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,14) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,14)];} ?></strong></td>
          </tr>
           
          <tr>
            <td width="326" align="left" valign="top">¿Ha tenido la impresión de que su vida se va a acortar, que va a morir antes que otras personas o que tiene un futuro limitado?</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,15) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,15)];} ?></strong></td>
          </tr> 
         <tr>
<td colspan="3" align="left" valign="top"><img src="img/blank.png" width="115" height="5" /></td>
            </tr> 
          <tr>
            <td colspan="3" align="left" valign="top"><strong>IV.- Afectación (durante el último mes):</strong></td>
            </tr>  <tr>
            <td width="326" align="left" valign="top">¿Ha tenido usted dificultades para dormir?</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,16) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,16)];} ?></strong></td>
          </tr>
          
          <tr>
            <td width="326" align="left" valign="top">¿Ha estado particularmente irritable o le han dado arranques de coraje? </td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,17) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,17)];} ?></strong></td>          </tr>
          
          <tr>
            <td width="326" align="left" valign="top">¿Ha tenido dificultad para concentrarse?</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,18) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,18)];} ?></strong></td>
          </tr>
          
          <tr>
            <td width="326" align="left" valign="top">¿Ha estado nervioso o constantemente en alerta? </td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,19) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,19)];} ?></strong></td>
          </tr>
          
          <tr>
            <td width="326" align="left" valign="top">¿Se ha sobresaltado fácilmente por cualquier cosa?</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,20) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,20)];} ?></strong></td>
          </tr>

         <tr>
<td colspan="3" align="left" valign="top"><img src="img/blank.png" width="115" height="15" /></td>
            </tr> 
              <tr>
<td colspan="3" align="left" valign="top" bgcolor="#CCCCCC"><strong>IDENTIFICAR LOS FACTORES DE RIESGO PSICOSOCIAL.</strong></td>
            </tr>   
         <tr>
<td colspan="3" align="left" valign="top"><img src="img/blank.png" width="115" height="5" /></td>
            </tr>    <tr>
<td colspan="3" align="left" valign="top"  ><strong>Para responder las preguntas siguientes considere las condiciones de su centro de trabajo, así como la cantidad y ritmo detrabajo.</strong></td>
            </tr> 
             <tr>
            <td width="326" align="left" valign="top">Mi trabajo me exige hacer mucho esfuerzo físico </td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,21) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,21)];} ?></strong></td>
          </tr>
          <tr>
            <td width="326" align="left" valign="top">Me preocupa sufrir un accidente en mi trabajo </td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,22) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,22)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Considero que las actividades que realizo son peligrosas</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
         <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,23) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,23)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Por la cantidad de trabajo que tengo debo quedarme tiempo adicional a mi turno</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,24) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,24)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Por la cantidad de trabajo que tengo debo trabajar sin parar</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
           <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,25) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,25)];} ?></strong></td>
          </tr><tr>
            <td align="left" valign="top">Considero que es necesario mantener un ritmo de trabajoacelerado</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,26) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,26)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Mi trabajo exige que esté muy concentrado</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
       <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,27) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,27)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Mi trabajo requiere que memorice mucha información</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
           <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,28) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,28)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Mi trabajo exige que atienda varios asuntos al mismotiempo</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,29) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,29)];} ?></strong></td>
          </tr>
            
         <tr>
<td colspan="3" align="left" valign="top"><img src="img/blank.png" width="115" height="5" /></td>
            </tr> 
            <tr>
            <td colspan="3" align="left" valign="top"><strong>Las preguntas siguientes están relacionadas con las actividades que realiza en su trabajo y las responsabilidades que tiene.</strong></td>
          </tr>  
         <tr>
<td colspan="3" align="left" valign="top"><img src="img/blank.png" width="115" height="5" /></td>
            </tr> 
          <tr>
            <td align="left" valign="top">En mi trabajo soy responsable de cosas de mucho valor</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,30) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,30)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Respondo ante mi jefe por los resultados de toda mi áreade trabajo</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,31) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,31)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">En mi trabajo me dan órdenes contradictorias</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,32) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,32)];} ?></strong></td>
          </tr>
             <tr>
            <td align="left" valign="top">Considero que en mi trabajo me piden hacer cosasinnecesarias</td>	
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,33) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,33)];} ?></strong></td>
          </tr>
</table>
 <!-- Fin - Seccion A -->    
     </td>
        <td width="401" rowspan="11" align="left" valign="top">
 <!-- Ini - SEccion B -->   <table width="402" border="0" cellspacing="0" cellpadding="0">

         
<tr>
            <td colspan="3" align="left" valign="top"><strong>Las preguntas siguientes están relacionadas con el tiempo destinado a su trabajo y sus responsabilidades familiares.</strong></td>
            </tr>
            <tr>
            <td width="326" align="left" valign="top">Trabajo horas extras más de tres veces a la semana</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td>
            <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,34) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,34)];} ?></strong></td>
          </tr> <tr>
            <td align="left" valign="top">Mi trabajo me exige laborar en días de descanso, festivos o fines de semana</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,35) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,35)];} ?></strong></td>
          </tr> <tr>
            <td align="left" valign="top">Considero que el tiempo en el trabajo es mucho y perjudica mis actividades familiares o personales</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,36) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,36)];} ?></strong></td>
          </tr> <tr>
            <td align="left" valign="top">Pienso en las actividades familiares o personales cuando estoy en mi trabajo</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,37) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,37)];} ?></strong></td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top"><strong>Las preguntas siguientes están relacionadas con las decisiones que puede tomar en su trabajo.</strong></td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top"><img src="img/blank.png" width="105" height="5" /></td>
          </tr>
          <tr>
            <td align="left" valign="top">Mi trabajo permite que desarrolle nuevas habilidades</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,38) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,38)];} ?></strong></td>
            </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">En mi trabajo puedo aspirar a un mejor puesto</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,39) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,39)];} ?></strong></td>
            </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Durante mi jornada de trabajo puedo tomar pausas cuandolas necesito </td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,40) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,40)];} ?></strong></td>
            </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Puedo decidir la velocidad a la que realizo mis actividades en mi trabajo</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,41) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,41)];} ?></strong></td>
            </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Puedo cambiar el orden de las actividades que realizo en mi trabajo</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,42) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,42)];} ?></strong></td>
            </strong></td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top"><strong>Las preguntas siguientes están relacionadas con la capacitación e información que recibe sobre su trabajo.</strong></td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top"><img src="img/blank.png" width="105" height="5" /></td>
          </tr>
          <tr>
            <td align="left" valign="top">Me informan con claridad cuáles son mis funciones</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,43) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,43)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Me explican claramente los resultados que debo obteneren mi trabajo</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,44) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,44)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Me informan con quién puedo resolver problemas oasuntos de trabajo</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,45) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,45)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Me permiten asistir a capacitaciones relacionadas con mi trabajo</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,46) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,46)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Recibo capacitación útil para hacer mi trabajo</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,47) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,47)];} ?></strong></td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top"><strong>Las preguntas siguientes se refieren a las relaciones con sus compañeros de trabajo y su jefe.</strong></td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top"><img src="img/blank.png" width="105" height="5" /></td>
          </tr>
          <tr>
            <td align="left" valign="top">Mi jefe tiene en cuenta mis puntos de vista y opiniones</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,48) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,48)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Mi jefe ayuda a solucionar los problemas que se presentan en el trabajo </td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,49) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,49)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Puedo confiar en mis compañeros de trabajo </td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,50) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,50)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Cuando tenemos que realizar trabajo de equipo los compañeros colaboran</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,51) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,51)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Mis compañeros de trabajo me ayudan cuando tengo dificultades</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,52) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,52)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">En mi trabajo puedo expresarme libremente sin interrupciones</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,53) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,53)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Recibo críticas constantes a mi persona y/o trabajo </td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,54) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,54)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Recibo burlas, calumnias, difamaciones, humillaciones o ridiculizaciones</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,55) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,55)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Se ignora mi presencia o se me excluye de las reuniones de trabajo y en la toma de decisiones</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,56) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,56)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Se manipulan las situaciones de trabajo para hacermeparecer un mal trabajador</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,57) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,57)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Se ignoran mis éxitos laborales y se atribuyen a otrostrabajadores</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,58) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,58)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Me bloquean o impiden las oportunidades que tengo para obtener ascenso o mejora en mi trabajo</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,59) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,59)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">He presenciado actos de violencia en mi centro de trabajo</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,60) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,60)];} ?></strong></td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top"><strong>Las preguntas siguientes están relacionadas con la atención a clientes y usuarios.</strong></td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top"><img src="img/blank.png" width="105" height="5" /></td>
          </tr>
          <tr>
            <td align="left" valign="top">En mi trabajo debo brindar servicio a clientes o usuarios:</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,61) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,61)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Atiendo clientes o usuarios muy enojados</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,62) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,62)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Mi trabajo me exige atender personas muy necesitadas de ayuda o enfermas</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,63) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,63)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Para hacer mi trabajo debo demostrar sentimientos distintos a los míos</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,64) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,64)];} ?></strong></td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top"><strong>Las siguientes preguntas están relacionadas con las actitudes de los trabajadores que supervisa.</strong></td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top"><img src="img/blank.png" width="105" height="5" /></td>
          </tr>
          <tr>
            <td align="left" valign="top">Soy jefe de otros trabajadores:</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,65) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,65)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Dificultan el logro de los resultados del trabajo</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,66) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,66)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Ignoran las sugerencias para mejorar su trabajo</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,67) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,67)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Comunican tarde los asuntos de trabajo</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,68) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,68)];} ?></strong></td>
          </tr>
        </table>
           
 <!-- Fin - Seccion B -->   
 	 </td></tr>
     
</table>
      </tr>
     
</table>

<?php 
			}
else
	{	?>

<table width="838" border="0" cellspacing="0" cellpadding="0"  >
  <tr>
    <td colspan="2"><img src="encuestas/logos/<?php echo $sLogo;?>" width="214" height="65" /></td>
    <td colspan="3"><h3 align="center" class="Estilo1">Factores de riesgo psicosocial en el trabajo<br />
    NOM-035-STPS-2018<br />Nivel Encuesta  <?php echo $sNivel  ;?> 
    </h3></td>
    <td colspan="2"><img src="encuestas/logos/logo halza_lgt.jpg" width="237" height="85" /></td>
  </tr>
  <tr >
    <td width="120" height="25" style="border-bottom:solid 2px" ><div align="center">No. Nomina</div></td>
    <td width="94"  style="border-bottom:solid 2px; border-left: solid 2px; border-left-color:#FFFFFF"><div align="center">Edad</div></td>
    <td width="31"  style="border-bottom:solid 2px; border-left: solid 2px; border-left-color:#FFFFFF"><div align="center">Sexo</div></td>
    <td width="192" style="border-bottom:solid 2px; border-left: solid 2px; border-left-color:#FFFFFF"><div align="center">Grado Estudio</div></td>
    <td width="228" style="border-bottom:solid 2px; border-left: solid 2px; border-left-color:#FFFFFF"><div align="center">Area</div></td>
    <td width="82" style="border-bottom:solid 2px; border-left: solid 2px; border-left-color:#FFFFFF"><div align="center">Departamento</div></td>
    <td width="91" style="border-bottom:solid 2px; border-left: solid 2px; border-left-color:#FFFFFF"><div align="center">Fecha</div></td>
  </tr>
  <tr >
    <td height="25"  style="border-bottom: #999999 solid 1px" align="center" valign="top"><?php echo $ArrCad[1];?></td>
    <td style="border-bottom: #999999 solid 1px; border-left: solid 2px; border-left-color:#FFFFFF" align="center" valign="top"><?php echo $ArrCad[2];?></td>
    <td style="border-bottom: #999999 solid 1px; border-left: solid 2px; border-left-color:#FFFFFF" align="center" valign="top"><?php echo substr($ArrCad[4],0,1);?></td>
    <td style="border-bottom: #999999 solid 1px; border-left: solid 2px; border-left-color:#FFFFFF" align="center" valign="top"><?php echo $ArrCad[5];?></td>
    <td style="border-bottom: #999999 solid 1px; border-left: solid 2px; border-left-color:#FFFFFF"  align="center" valign="top"><?php echo $ArrCad[6];?></td>
    <td style="border-bottom: #999999 solid 1px; border-left: solid 2px; border-left-color:#FFFFFF"  align="center" valign="top"><?php echo $ArrCad[7];?></td>
    <td style="border-bottom: #999999 solid 1px; border-left: solid 2px; border-left-color:#FFFFFF"  align="center" valign="top"><?php 
	echo FechaSistema($ArrCad[8],4);?></td>
  </tr>
  <tr >
    <td height="25" colspan="7" align="left" valign="top"  style=" border:#999999 solid 1px"  >
    <table width="838" border="0" cellspacing="5" cellpadding="5">
      <tr>
        <td width="402" align="left" valign="top">
 <!-- Ini - SEccion A2 -->      <table width="402" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="3" align="left" valign="top"> <strong>I.- Acontecimiento traumático severo </strong><br />
Ha presenciado o sufrido alguna vez, durante o con motivo del trabajo un acontecimiento como los siguientes:</td>
            </tr>
             <tr>
            <td width="326" align="left" valign="top">¿Accidente que tenga como consecuencia la muerte, la pérdida de un miembro o unalesión grave?</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,1) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,1)];} ?></strong></td>
          </tr>
          
             <tr>
            <td width="326" align="left" valign="top">¿Asaltos?</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,2) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,2)];} ?></strong></td>
          </tr>
          
             <tr>
            <td width="326" align="left" valign="top">¿Actos violentos que derivaron en lesiones graves?</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,3) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,3)];} ?></strong></td>
          </tr>
          
             <tr>
            <td width="326" align="left" valign="top">¿Secuestro? </td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,4) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,4)];} ?></strong></td>
          </tr>
          
             <tr>
            <td width="326" align="left" valign="top">¿Amenazas?, o </td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,5) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,5)];} ?></strong></td>
          </tr>
          
             <tr>
            <td width="326" align="left" valign="top">¿Cualquier otro que ponga en riesgo su vida o salud, y/o la de otras personas?</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,6) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,6)];} ?></strong></td>
          </tr> 
         <tr>
            <td colspan="3" align="left" valign="top"><img src="img/blank.png" width="115" height="5" /></td>
            </tr>
         <tr>
            <td colspan="3" align="left" valign="top"><strong> II.- Recuerdos persistentes sobre el acontecimiento (durante el último mes):</strong></td>
            </tr> <tr>
            <td width="326" align="left" valign="top">¿Ha tenido recuerdos recurrentes sobre el acontecimiento que le provocan malestares? </td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,7) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,7)];} ?></strong></td>
          </tr>
          
          <tr>
            <td width="326" align="left" valign="top">¿Ha tenido sueños de carácter recurrente sobre el acontecimiento, que le producenmalestar?</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,8) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,8)];} ?></strong></td>
          </tr> 
         <tr>
<td colspan="3" align="left" valign="top"><img src="img/blank.png" width="115" height="5" /></td>
            </tr> 
         <tr>
            <td colspan="3" align="left" valign="top"><strong>III.- Esfuerzo por evitar circunstancias parecidas o asociadas al acontecimiento (durante el último mes):</strong></td>
            </tr> <tr>
            <td width="326" align="left" valign="top">¿Se ha esforzado por evitar todo tipo de sentimientos, conversaciones o situaciones que le puedan recordar el acontecimiento? </td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,9) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,9)];} ?></strong></td>
          </tr>
          
          <tr>
            <td width="326" align="left" valign="top">¿Se ha esforzado por evitar todo tipo de actividades, lugares o personas que motivan recuerdos del acontecimiento? </td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,10) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,10)];} ?></strong></td>
          </tr>
           
          <tr>
            <td width="326" align="left" valign="top">¿Ha tenido dificultad para recordar alguna parte importante del evento? </td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,11) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,11)];} ?></strong></td>
          </tr>
           
          <tr>
            <td width="326" align="left" valign="top">¿Ha disminuido su interés en sus actividades cotidianas?</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,12) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,12)];} ?></strong></td>
          </tr>
           
          <tr>
            <td width="326" align="left" valign="top">¿Se ha sentido usted alejado o distante de los demás? </td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,13) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,13)];} ?></strong></td>
          </tr>
           
          <tr>
            <td width="326" align="left" valign="top">¿Ha notado que tiene dificultad para expresar sus sentimientos? </td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,14) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,14)];} ?></strong></td>
          </tr>
           
          <tr>
            <td width="326" align="left" valign="top">¿Ha tenido la impresión de que su vida se va a acortar, que va a morir antes que otras personas o que tiene un futuro limitado?</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,15) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,15)];} ?></strong></td>
          </tr> 
         <tr>
<td colspan="3" align="left" valign="top"><img src="img/blank.png" width="115" height="5" /></td>
            </tr> 
          <tr>
            <td colspan="3" align="left" valign="top"><strong>IV.- Afectación (durante el último mes):</strong></td>
            </tr>  <tr>
            <td width="326" align="left" valign="top">¿Ha tenido usted dificultades para dormir?</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,16) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,16)];} ?></strong></td>
          </tr>
          
          <tr>
            <td width="326" align="left" valign="top">¿Ha estado particularmente irritable o le han dado arranques de coraje? </td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,17) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,17)];} ?></strong></td>          </tr>
          
          <tr>
            <td width="326" align="left" valign="top">¿Ha tenido dificultad para concentrarse?</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,18) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,18)];} ?></strong></td>
          </tr>
          
          <tr>
            <td width="326" align="left" valign="top">¿Ha estado nervioso o constantemente en alerta? </td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,19) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,19)];} ?></strong></td>
          </tr>
          
          <tr>
            <td width="326" align="left" valign="top">¿Se ha sobresaltado fácilmente por cualquier cosa?</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,20) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,20)];} ?></strong></td>
          </tr>

         <tr>
<td colspan="3" align="left" valign="top"><img src="img/blank.png" width="115" height="15" /></td>
            </tr> 
              <tr>
<td colspan="3" align="left" valign="middle" height="35" bgcolor="#CCCCCC"><strong>IDENTIFICAR LOS FACTORES DE RIESGO PSICOSOCIAL Y EVALUAR EL ENTORNO ORGANIZACIONAL EN LOS CENTROS DE TRABAJO.</strong></td>
            </tr>   
         <tr>
<td colspan="3" align="left" valign="top"><img src="img/blank.png" width="115" height="5" /></td>
            </tr>    <tr>
<td colspan="3" align="left" valign="top"  ><strong>Para responder las preguntas siguientes considere las condiciones ambientales de su centro de trabajo.</strong></td>
            </tr> 
             <tr>
            <td width="326" align="left" valign="top">El espacio donde trabajo me permite realizar mis actividades de manera segura e higiénica </td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,69) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,69)];} ?></strong></td>
          </tr>
             <tr>
            <td width="326" align="left" valign="top">Mi trabajo me exige hacer mucho esfuerzo físico </td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,70) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,70)];} ?></strong></td>
          </tr>
          <tr>
            <td width="326" align="left" valign="top">Me preocupa sufrir un accidente en mi trabajo </td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,71) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,71)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Considero que en mi trabajo se aplican las normas de seguridad y salud en el trabajo </td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
         <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,72) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,72)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Considero que las actividades que realizo son peligrosas </td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,73) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,73)];} ?></strong></td>
          </tr> <tr>
<td colspan="3" align="left" valign="top"><img src="img/blank.png" width="115" height="5" /></td>
            </tr>    <tr>
<td colspan="3" align="left" valign="top"  ><strong>Para responder a las preguntas siguientes piense en la cantidad y ritmo de trabajo que tiene.</strong></td>
            </tr> <tr>
            <td align="left" valign="top">Por la cantidad de trabajo que tengo debo quedarme tiempo adicional a mi turno </td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,74) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,74)];} ?></strong></td>
          </tr> 
          <tr>
            <td align="left" valign="top">Por la cantidad de trabajo que tengo debo trabajar sin parar</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
           <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,75) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,75)];} ?></strong></td>
          </tr><tr>
            <td align="left" valign="top">Considero que es necesario mantener un ritmo de trabajo acelerado</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,76) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,76)];} ?></strong></td>
          </tr><tr>
<td colspan="3" align="left" valign="top"><img src="img/blank.png" width="115" height="5" /></td>
            </tr>    <tr>
<td colspan="3" align="left" valign="top"  ><strong>Las preguntas siguientes están relacionadas con el esfuerzo mental que le exige su trabajo.</strong></td>
            </tr> 
          <tr>
            <td align="left" valign="top">Mi trabajo exige que esté muy concentrado</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
       <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,77) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,77)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Mi trabajo requiere que memorice mucha información</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
           <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,78) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,78)];} ?></strong></td>
          </tr>
         
            
         <tr>
<td colspan="3" align="left" valign="top"><img src="img/blank.png" width="115" height="5" /></td>
            </tr> 
           
</table>
 <!-- Fin - Seccion A2 -->    
     </td>
        <td width="401" rowspan="11" align="left" valign="top">
 <!-- Ini - SEccion B2 -->   
 <table width="402" border="0" cellspacing="0" cellpadding="0">      
    <tr>
            <td align="left" valign="top">En mi trabajo tengo que tomar decisiones difíciles muy rápido</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,79) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,79)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Mi trabajo exige que atienda varios asuntos al mismo tiempo</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,80) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,80)];} ?></strong></td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top"><img src="img/blank.png" width="105" height="5" /></td>
          </tr>
           <tr>
            <td colspan="3" align="left" valign="top"><strong> Las preguntas siguientes están relacionadas con las actividades que realiza en su trabajo y las responsabilidades que tiene.</strong></td>
          </tr>  
           <tr>
            <td width="326" align="left" valign="top">En mi trabajo soy responsable de cosas de mucho valor</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,81) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,81)];} ?></strong></td>
          </tr> 
          <tr>
            <td align="left" valign="top">Respondo ante mi jefe por los resultados de toda mi áreade trabajo</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,82) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,82)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">En mi trabajo me dan órdenes contradictorias</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,83) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,83)];} ?></strong></td>
          </tr>
             <tr>
            <td align="left" valign="top">Considero que en mi trabajo me piden hacer cosasinnecesarias</td>	
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,84) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,84)];} ?></strong></td>
          </tr>
          <tr>
            <td colspan="3" align="left" valign="top"><img src="img/blank.png" width="105" height="5" /></td>
          </tr>
<tr>
            <td colspan="3" align="left" valign="top"><strong>Las preguntas siguientes están relacionadas con su jornada de trabajo.</strong></td>
            </tr>
            <tr>
            <td width="326" align="left" valign="top">Trabajo horas extras más de tres veces a la semana</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td>
            <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,85) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,85)];} ?></strong></td>
          </tr> <tr>
            <td align="left" valign="top">Mi trabajo me exige laborar en días de descanso, festivos o fines de semana</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,86) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,86)];} ?></strong></td>
          </tr> <tr>
            <td align="left" valign="top">Considero que el tiempo en el trabajo es mucho y perjudica mis actividades familiares o personales</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,87) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,87)];} ?></strong></td>
          </tr> <tr>
            <td align="left" valign="top">Debo atender asuntos de trabajo cuando estoy en casa</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,88) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,88)];} ?></strong></td>
          </tr>  
           <tr>
            <td align="left" valign="top">Pienso en las actividades familiares o personales cuando estoy en mi trabajo</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,89) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,89)];} ?></strong></td>
          </tr>  <tr>
            <td align="left" valign="top">Pienso que mis responsabilidades familiares afectan mi trabajo</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,90) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,90)];} ?></strong></td>
          </tr> 
          <tr>
            <td colspan="3" align="left" valign="top"><img src="img/blank.png" width="105" height="5" /></td>
          </tr>
           <tr>
            <td colspan="3" align="left" valign="top"><strong>Las preguntas siguientes están relacionadas con las decisiones que puede tomar en su trabajo.</strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Mi trabajo permite que desarrolle nuevas habilidades</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,91) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,91)];} ?></strong></td>
            </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">En mi trabajo puedo aspirar a un mejor puesto</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,92) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,92)];} ?></strong></td>
            </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Durante mi jornada de trabajo puedo tomar pausas cuandolas necesito </td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,93) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,93)];} ?></strong></td>
            </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Puedo decidir cuánto trabajo realizo durante la jornada laboral	</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,94) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,94)];} ?></strong></td>
            </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Puedo decidir la velocidad a la que realizo mis actividades en mi trabajo</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,95) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,95)];} ?></strong></td>
            </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Puedo cambiar el orden de las actividades que realizo en mi trabajo</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,96) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,96)];} ?></strong></td>
            </strong></td>
          </tr>
           <tr>
            <td colspan="3" align="left" valign="top"><img src="img/blank.png" width="105" height="5" /></td>
          </tr>
           <tr>
            <td colspan="3" align="left" valign="top"><strong>Las preguntas siguientes están relacionadas con cualquier tipo de cambio que ocurra en su trabajo (considere los últimos cambios realizados).</strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Los cambios que se presentan en mi trabajo dificultan mi labor</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,97) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,97)];} ?></strong></td>
            </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Cuando se presentan cambios en mi trabajo se tienen en cuenta mis ideas o aportaciones</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,98) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,98)];} ?></strong></td>
            </strong></td>
          </tr>
          
           <tr>
            <td colspan="3" align="left" valign="top"><img src="img/blank.png" width="105" height="5" /></td>
          </tr>
           <tr>
            <td colspan="3" align="left" valign="top"><strong>Las preguntas siguientes están relacionadas con la capacitación e información que recibe sobre su trabajo.</strong></td>
          </tr>
           <tr>
            <td align="left" valign="top">Me informan con claridad cuáles son mis funciones</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,99) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,99)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Me explican claramente los resultados que debo obteneren mi trabajo</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,100) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,100)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Me explican claramente los objetivos de mi trabajo</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,101) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,101)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Me informan con quién puedo resolver problemas o asuntos de trabajo</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,102) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,102)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Me permiten asistir a capacitaciones relacionadas con mi trabajo</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,103) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,103)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Recibo capacitación útil para hacer mi trabajo</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,104) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,104)];} ?></strong></td>
          </tr>
          
           <tr>
            <td colspan="3" align="left" valign="top"><img src="img/blank.png" width="105" height="5" /></td>
          </tr>
           <tr>
            <td colspan="3" align="left" valign="top"><strong>Las preguntas siguientes están relacionadas con el o los jefes con quien tiene contacto.</strong></td>
          </tr>
           <tr>
            <td align="left" valign="top">Mi jefe ayuda a organizar mejor el trabajo</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,105) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,105)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">Mi jefe tiene en cuenta mis puntos de vista y opiniones </td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,106) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,106)];} ?></strong></td>
          </tr> <tr>
            <td align="left" valign="top">Mi jefe me comunica a tiempo la información relacionada con el trabajo</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,107) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,107)];} ?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">La orientación que me da mi jefe me ayuda a realizar mejor mi trabajo </td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,108) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,108)];} ?></strong></td>
          </tr> <tr>
            <td align="left" valign="top">Mi jefe ayuda a solucionar los problemas que se presentan en el trabajo</td>
            <td><img src="img/blank.png" width="5" height="20" /></td>
            <td align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong>
<?php if(BuscaArr($arrRespuestas,109) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,109)];} ?></strong></td>
          </tr> 
         </table>
           
        
 <!-- Fin - Seccion B2 -->   
 	 </td></tr>
     
</table>
      </tr>
     
</table>
<div style='page-break-before:always;'></div>         
<table width="838" border="0" cellspacing="0" cellpadding="0"  >
  <tr>
    <td colspan="2"><img src="encuestas/logos/<?php echo $sLogo;?>" width="214" height="65" /></td>
    <td colspan="3"><h3 align="center" class="Estilo1">Factores de riesgo psicosocial en el trabajo<br />
    NOM-035-STPS-2018<br />Nivel Encuesta  <?php echo $sNivel  ;?> 
    </h3></td>
    <td colspan="2"><img src="encuestas/logos/logo halza_lgt.jpg" width="237" height="85" /></td>
  </tr>
  <tr><td colspan="7"><img src="img/blank.png" width="105" height="5" /></td>
   </tr>
  <tr >
    <td height="25" colspan="7" align="left" valign="top"    >
    <table width="838" border="0" cellspacing="5" cellpadding="5">
      <tr>
        <td width="402" align="left" valign="top">
 <!-- Ini - SEccion A2 -->      <table width="402" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="3" align="left" valign="top"><strong>Las preguntas siguientes se refieren a las relaciones con sus compañeros.</strong></td>
            </tr>
             <tr>
            <td width="326" align="left" valign="top">Puedo confiar en mis compañeros de trabajo</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,110) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,110)];}?></strong></td>
          </tr>
          <tr>
            <td width="326" align="left" valign="top">Entre compañeros solucionamos los problemas de trabajo de forma respetuosa</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,111) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,111)];}?></strong></td>
          </tr><tr>
            <td width="326" align="left" valign="top">En mi trabajo me hacen sentir parte del grupo</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,112) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,112)];}?></strong></td>
          </tr><tr>
            <td width="326" align="left" valign="top">Cuando tenemos que realizar trabajo de equipo los compañeros colaboran</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,113) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,113)];}?></strong></td>
          </tr><tr>
            <td width="326" align="left" valign="top">Mis compañeros de trabajo me ayudan cuando tengo dificultades</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,114) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,114)];}?></strong></td>
          </tr>
           <tr>
            <td colspan="3" align="left" valign="top"><img src="img/blank.png" width="105" height="5" /></td>
          </tr>
           <tr>
            <td colspan="3" align="left" valign="top"><strong>Las preguntas siguientes están relacionadas con la información que recibe sobre su rendimiento en el trabajo, el reconocimiento, el sentido de pertenencia y la estabilidad que le ofrece su trabajo.</strong></td>
          </tr><tr>
            <td width="326" align="left" valign="top">Me informan sobre lo que hago bien en mi trabajo	</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,115) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,115)];}?></strong></td>
          </tr><tr>
            <td width="326" align="left" valign="top">La forma como evalúan mi trabajo en mi centro de trabajo me ayuda a mejorar mi desempeño</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,116) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,116)];}?></strong></td>
          </tr><tr>
            <td width="326" align="left" valign="top">En mi centro de trabajo me pagan a tiempo mi salario</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,117) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,117)];}?></strong></td>
          </tr><tr>
            <td width="326" align="left" valign="top">El pago que recibo es el que merezco por el trabajo que realizo</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,118) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,118)];}?></strong></td>
          </tr><tr>
            <td width="326" align="left" valign="top">Si obtengo los resultados esperados en mi trabajo me recompensan o reconocen</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,119) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,119)];}?></strong></td>
          </tr><tr>
            <td width="326" align="left" valign="top">Las personas que hacen bien el trabajo pueden crecer laboralmente</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,120) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,120)];}?></strong></td>
          </tr><tr>
            <td width="326" align="left" valign="top">Considero que mi trabajo es estable</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,121) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,121)];}?></strong></td>
          </tr><tr>
            <td width="326" align="left" valign="top">En mi trabajo existe continua rotación de personal</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,122) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,122)];}?></strong></td>
          </tr><tr>
            <td width="326" align="left" valign="top">Siento orgullo de laborar en este centro de trabajo</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,123) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,123)];}?></strong></td>
          </tr><tr>
            <td width="326" align="left" valign="top">Me siento comprometido con mi trabajo</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,124) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,124)];}?></strong></td>
          </tr>
           <tr>
            <td colspan="3" align="left" valign="top"><img src="img/blank.png" width="105" height="5" /></td>
          </tr>
           <tr>
            <td colspan="3" align="left" valign="top"><strong>Las preguntas siguientes están relacionadas con actos de violencia laboral (malos tratos, acoso, hostigamiento, acoso psicológico).</strong></td>
          </tr><tr>
            <td width="326" align="left" valign="top">En mi trabajo puedo expresarme libremente sin interrupciones</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,125) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,125)];}?></strong></td>
          </tr><tr>
            <td width="326" align="left" valign="top">Recibo críticas constantes a mi persona y/o trabajo</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,126) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,126)];}?></strong></td>
          </tr><tr>
            <td width="326" align="left" valign="top">Recibo burlas, calumnias, difamaciones, humillaciones o ridiculizaciones</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,127) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,127)];}?></strong></td>
          </tr><tr>
            <td width="326" align="left" valign="top">Se ignora mi presencia o se me excluye de las reuniones de trabajo y en la toma de decisiones</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,128) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,128)];}?></strong></td>
          </tr><tr>
            <td width="326" align="left" valign="top">Se manipulan las situaciones de trabajo para hacerme parecer un mal trabajador</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,129) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,129)];}?></strong></td>
          </tr><tr>
            <td width="326" align="left" valign="top">Se ignoran mis éxitos laborales y se atribuyen a otros trabajadores</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,130) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,130)];}?></strong></td>
          </tr><tr>
            <td width="326" align="left" valign="top">Me bloquean o impiden las oportunidades que tengo para obtener ascenso o mejora en mi trabajo</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,131) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,131)];}?></strong></td>
          </tr><tr>
            <td width="326" align="left" valign="top">He presenciado actos de violencia en mi centro de trabajo</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,132) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,132)];}?></strong></td>
          </tr> <tr>
            <td colspan="3" align="left" valign="top"><img src="img/blank.png" width="105" height="5" /></td>
          </tr>
           <tr>
            <td colspan="3" align="left" valign="top"><strong>Las preguntas siguientes están relacionadas con la atención a clientes y usuarios.</strong></td>
          </tr> <tr>
            <td width="326" align="left" valign="top">En mi trabajo debo brindar servicio a clientes o usuarios:</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,133) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,133)];} ?></strong></td>
          </tr><tr>
            <td width="326" align="left" valign="top">Atiendo clientes o usuarios muy enojados</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,134) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,134)];}?></strong></td>
          </tr><tr>
            <td width="326" align="left" valign="top">Mi trabajo me exige atender personas muy necesitadasde ayuda o enfermas	</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,135) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,135)];}?></strong></td>
          </tr><tr>
            <td width="326" align="left" valign="top">Para hacer mi trabajo debo demostrar sentimientos distintos a los míos</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,136) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,136)];}?></strong></td>
          </tr><tr>
            <td width="326" align="left" valign="top">Mi trabajo me exige atender situaciones de violencia</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,137) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,137)];}?></strong></td>
          </tr> <tr>
            <td colspan="3" align="left" valign="top"><img src="img/blank.png" width="105" height="5" /></td>
          </tr>
           <tr>
            <td colspan="3" align="left" valign="top"><strong>Las siguientes preguntas están relacionadas con las actitudes de los trabajadores que supervisa.</strong></td>
          </tr> <tr>
            <td width="326" align="left" valign="top">Soy jefe de otros trabajadores:</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,138) >= 0 ) { echo $arrSiNo[BuscaArr($arrRespuestas,138)];} ?></strong></td>
          </tr><tr>
            <td width="326" align="left" valign="top">Comunican tarde los asuntos de trabajo</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,139) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,139)];}?></strong></td>
          </tr><tr>
            <td width="326" align="left" valign="top">Dificultan el logro de los resultados del trabajo </td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,140) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,140)];}?></strong></td>
          </tr><tr>
            <td width="326" align="left" valign="top">Cooperan poco cuando se necesita</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,141) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,141)];}?></strong></td>
          </tr><tr>
            <td width="326" align="left" valign="top">Ignoran las sugerencias para mejorar su trabajo</td>
            <td width="10"><img src="img/blank.png" width="5" height="20" /></td> <td width="66" align="center" valign="top"  style="border-bottom: #999999 solid 1px;"><strong><?php if(BuscaArr($arrRespuestas,142) >= 0 ) { echo $arrLiker[BuscaArr($arrRespuestas,142)];}?></strong></td>
          </tr>
         </table>
        </td>    
        <td width="402" align="left" valign="top">
 <!-- Ini - SEccion A2 -->      <table width="402" border="0" cellspacing="0" cellpadding="0">
          <tr> <td>&nbsp;</td></tr></table></td>
        </tr>
        </table>
 <!-- Fin - Seccion B2 -->   
 	 </td></tr>
     
</table>
      </tr>
     
</table>
<?php	}

unset($arrRespuestas);
$iRen++;
}?><script>
window.print();
</script>
</body>
</html>
