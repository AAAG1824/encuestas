<?php   
ob_start();
require "./inc/settings.php";
require "./inc/funciones.php"; 
require "./inc/validasession.php"; 
$iId= isset( $_GET['Id'] ) ?    ($_GET['Id']) : 0 ; 
header("Pragma: public");
header("Expires: 0");
$filename = "XLS$iId_$GblFechaHora.xls";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

// Declaraciones
 $iContestarId=0; $iNoNomina=0; $iEdad=0; $iGenero=0; $iEstudiosId=0;
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
?> 
<table width="4500" border="0" cellspacing="4" cellpadding="4">
  <tr>
    <td colspan="4" rowspan="3"><!-- <img src="encuestas/logos/<?php echo $sLogo;?>"><br>--><?php echo $sEmpresa;?></td>
    <td colspan="33">
      IDENTIFICACI&Oacute;N Y AN&Aacute;LISIS DE LOS FACTORES DE RIESGO PSICOSOCIAL
    </td>
    <td colspan="41">
      IDENTIFICACI&Oacute;N Y AN&Aacute;LISIS DE LOS FACTORES DE RIESGO PSICOSOCIAL Y EVALUACI&Oacute;N DEL 
        ENTORNO ORGANIZACIONAL EN LOS CENTROS DE TRABAJO
    </td>
    <td width="62" rowspan="4">
      GRAN TOTAL 
    </td>
  </tr>
  <tr>
    <td colspan="5">
      Ambiente de 
        trabajo
    </td>
    <td colspan="12">
      Factores propios de la actividad
    </td>
    <td colspan="6" >
      Organizaci&oacute;n del tiempo de trabajo
    </td>
    <td colspan="9" >
      Liderazgo y relaciones en el trabajo
    </td>
    <td width="100" rowspan="3"  >
      TOTAL
    </td>
    <td colspan="5">
      Ambiente de 
        trabajo
    </td>
    <td colspan="13">
      Factores propios de la actividad
    </td>
    <td colspan="6" >
      Organizaci&oacute;n del tiempo de trabajo
    </td>
    <td colspan="9" >
      Liderazgo y relaciones en el trabajo
    </td>
    <td colspan="7" >
      Entorno organizacional
    </td>
    <td width="96" rowspan="3"  >
      TOTAL
    </td>
  </tr>
  <tr>
    <td width="85" rowspan="2" >
      C1
    </td>
    <td colspan="4">
      Condiciones en el 
        ambiente de 
        trabajo
    </td>
    <td width="19" rowspan="2" >
      C2
    </td>
    <td colspan="7">
      Carga de trabajo
    </td>
    <td colspan="4">
      Falta de control 
        sobre el trabajo
    </td>
    <td width="25" rowspan="2" ><span >C3</span></td>
    <td colspan="2" >
      Jornada de trabajo 
    </td>
    <td colspan="3" >
      Interferencia en la relaci&oacute;n trabajo-familia
    </td>
    <td width="30" rowspan="2" ><span >C4</span></td>
    <td colspan="3"  >
      Liderazgo
    </td>
    <td colspan="3" >
      Relaciones en el trabajo
    </td>
    <td colspan="2" >
      Violencia
    </td>
    <td width="51" rowspan="2" >
      C1
    </td>
    <td colspan="4">
      Condiciones en el 
        ambiente de 
        trabajo
    </td>
    <td width="49" rowspan="2" >
      C2
    </td>
    <td colspan="7">
      Carga de trabajo
    </td>
    <td colspan="5">
      Falta de control 
        sobre el trabajo
    </td>
    <td width="51" rowspan="2" ><span >C3</span></td>
    <td colspan="2" >
      Jornada de trabajo 
    </td>
    <td colspan="3" >
      Interferencia en la relaci&oacute;n trabajo-familia
    </td>
    <td width="30" rowspan="2" ><span >C4</span></td>
    <td colspan="3"  >
      Liderazgo
    </td>
    <td colspan="3" >
      Relaciones en el trabajo
    </td>
    <td colspan="2" >
      Violencia
    </td>
    <td width="48" rowspan="2" ><span >C5</span></td>
    <td colspan="3" ><span >Reconocimiento del desempe&ntilde;o</span></td>
    <td colspan="3" ><span >Insuficiente sentido de pertenencia e, inestabilidad</span></td>
  </tr>
  <tr>
    <td ><span >No Nomina </span></td>
    <td ><span >Area </span></td>
    <td ><span >Departamento </span></td>
    <td ><span >Edad</span></td>
    <td ><span >Estado Civil</span></td>
    <td ><span >Alerta</span></td>
    <td width="50"><p  >D11</p></td>
    <td width="45">
      D1
    </td>
    <td width="45">
      D2
    </td>
    <td width="43">
      D3
    </td>
    <td width="41">
      D21
    </td>
    <td width="33">
      D1
    </td>
    <td width="33">
      D2
    </td>
    <td width="33">
      D3
    </td>
    <td width="33">
      D4
    </td>
    <td width="33">
      D5
    </td>
    <td width="19">
      D6
    </td>
    <td width="36">
      D22
    </td>
    <td width="37">
      D1
    </td>
    <td width="38">
      D2
    </td>
    <td width="35">
      D3
    </td>
    <td width="53" ><span >D31</span></td>
    <td width="49" ><span >D1</span></td>
    <td width="71" ><span >D32</span></td>
    <td width="70" ><span >D1</span></td>
    <td width="76" ><span >D2</span></td>
    <td width="35" ><span >D41</span></td>
    <td width="28" ><span >D1</span></td>
    <td width="24" ><span >D2</span></td>
    <td width="43" ><span >D42</span></td>
    <td width="38" ><span >D1</span></td>
    <td width="31" ><span >D2</span></td>
    <td width="38" ><span >D43</span></td>
    <td width="43" ><span >D1</span></td>
    <td width="44"><p  >D11</p></td>
    <td width="72">
      D1
    </td>
    <td width="52">
      D2
    </td>
    <td width="42">
      D3
    </td>
    <td width="41">
      D21
    </td>
    <td width="33">
      D1
    </td>
    <td width="33">
      D2
    </td>
    <td width="33">
      D3
    </td>
    <td width="33">
      D4
    </td>
    <td width="33">
      D5
    </td>
    <td width="28">
      D6
    </td>
    <td width="37">
      D22
    </td>
    <td width="23">
      D1
    </td>
    <td width="45">
      D2
    </td>
    <td width="49">
      D3
    </td>
    <td width="45" >
      D4
    </td>
    <td width="67" ><span >D31</span></td>
    <td width="44" ><span >D1</span></td>
    <td width="82" ><span >D32</span></td>
    <td width="41" ><span >D1</span></td>
    <td width="94" ><span >D2</span></td>
    <td width="35" ><span >D41</span></td>
    <td width="28" ><span >D1</span></td>
    <td width="24" ><span >D2</span></td>
    <td width="43" ><span >D42</span></td>
    <td width="38" ><span >D1</span></td>
    <td width="31" ><span >D2</span></td>
    <td width="38" ><span >D43</span></td>
    <td width="43" ><span >D1</span></td>
    <td width="50" ><span >D51</span></td>
    <td width="48" ><span >D1</span></td>
    <td width="30" ><span >D2</span></td>
    <td width="60" ><span >D52</span></td>
    <td width="64" ><span >D1</span></td>
    <td width="54" ><span >D2</span></td>
  </tr>
 <?php  
 $sDepartamento="";$sArea="";
$sSQL = " SELECT distinct ContestarId,NoNomina,Edad,Genero,EstudiosId,Departamento,Area FROM  ts_encuestausuarios  where EncuestaId = ? and EstadoId =2 order by NoNomina ";
$iCantidad= 0 ;
if ($stmt = mysqli_prepare($link, $sSQL))
  {
 		mysqli_stmt_bind_param($stmt,'i',$iId);
        mysqli_stmt_execute($stmt);
		  mysqli_stmt_bind_result($stmt, $iContestarId, $iNoNomina , $iEdad, $iGenero,$iEstudiosId,$sDepartamento,$sArea );
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
		  
 ?>
  <tr >
    <td><?php echo  $iNoNomina; ?></td>
    <td><?php echo  $sArea; ?></td>
    <td><?php echo  $sDepartamento; ?></td>
    <td><?php echo  $iEdad; ?></td>
    <td><?php if($iGenero == 1 ) {echo  "Masculino"; } else { echo "Femenino";} ?></td>
    <td><?php   echo  substr($sAlerta,1,1)."_".substr($sAlerta,2,1)."_".substr($sAlerta,3,1); ?></td>
    <td  ><?php echo  $iT1A; ?></td>
    <td  ><?php echo  $iT1A1; ?></td>
    <td  ><?php echo  $iT1A1_1; ?></td>
    <td  ><?php echo  $iT1A1_2; ?></td>
    <td  ><?php echo  $iT1A1_3; ?></td>
    <td  ><?php echo  $iT1B; ?></td>
    <td  ><?php echo  $iT1B1; ?></td> 
    <td  ><?php echo  $iT1B1_1; ?></td>
    <td  ><?php echo  $iT1B1_2; ?></td>
    <td  ><?php echo  $iT1B1_3; ?></td>
    <td  ><?php echo  $iT1B1_4; ?></td>
    <td  ><?php echo  $iT1B1_5; ?></td>
    <td  ><?php echo  $iT1B1_6; ?></td>
    <td  ><?php echo  $iT1B2; ?></td>
    <td  ><?php echo  $iT1B2_1; ?></td>
    <td  ><?php echo  $iT1B2_2; ?></td>
    <td  ><?php echo  $iT1B2_3; ?></td>
    <td  ><?php echo  $iT1C; ?></td>
    <td  ><?php echo  $iT1C1; ?></td>
    <td  ><?php echo  $iT1C1_1; ?></td>
    <td  ><?php echo  $iT1C2; ?></td>
    <td  ><?php echo  $iT1C2_1; ?></td>
    <td  ><?php echo  $iT1C2_2; ?></td>
    <td  ><?php echo  $iT1D; ?></td>
    <td  ><?php echo  $iT1D1; ?></td>
    <td  ><?php echo  $iT1D1_1; ?></td>
    <td  ><?php echo  $iT1D1_2; ?></td>
    <td  ><?php echo  $iT1D2; ?></td>
    <td  ><?php echo  $iT1D2_1; ?></td>
    <td  ><?php echo  $iT1D2_2; ?></td>
    <td  ><?php echo  $iT1D3; ?></td>
    <td  ><?php echo  $iT1D3_1; ?></td>
    <td  ><?php echo  $iT1; ?></td>
    <td  ><?php echo  $iT2A; ?></td>
    <td  ><?php echo  $iT2A1; ?></td>
    <td  ><?php echo  $iT2A1_1; ?></td>
    <td  ><?php echo  $iT2A1_2; ?></td>
    <td  ><?php echo  $iT2A1_3; ?></td>
    <td  ><?php echo  $iT2B; ?></td>
    <td  ><?php echo  $iT2B1; ?></td>
    <td  ><?php echo  $iT2B1_1; ?></td>
    <td  ><?php echo  $iT2B1_2; ?></td>
    <td  ><?php echo  $iT2B1_3; ?></td>
    <td  ><?php echo  $iT2B1_4; ?></td>
    <td  ><?php echo  $iT2B1_5; ?></td>
    <td  ><?php echo  $iT2B1_6; ?></td>
    <td  ><?php echo  $iT2B2; ?></td>
    <td  ><?php echo  $iT2B2_1; ?></td>
    <td  ><?php echo  $iT2B2_2; ?></td>
    <td  ><?php echo  $iT2B2_3; ?></td>
    <td  ><?php echo  $iT2B2_4; ?></td>
    <td  ><?php echo  $iT2C; ?></td>
    <td  ><?php echo  $iT2C1; ?></td>
    <td  ><?php echo  $iT2C1_1; ?></td>
    <td  ><?php echo  $iT2C2; ?></td>
    <td  ><?php echo  $iT2C2_1; ?></td>
    <td  ><?php echo  $iT2C2_2; ?></td>
    <td  ><?php echo  $iT2D; ?></td>
    <td  ><?php echo  $iT2D1; ?></td>
    <td  ><?php echo  $iT2D1_1; ?></td>
    <td  ><?php echo  $iT2D1_2; ?></td>
    <td  ><?php echo  $iT2D2; ?></td>
    <td  ><?php echo  $iT2D2_1; ?></td>
    <td  ><?php echo  $iT2D2_2; ?></td>
    <td  ><?php echo  $iT2D3; ?></td>
    <td  ><?php echo  $iT2D3_1; ?></td>
    <td  ><?php echo  $iT2E; ?></td>
    <td  ><?php echo  $iT2E1; ?></td>
    <td  ><?php echo  $iT2E1_1; ?></td>
    <td  ><?php echo  $iT2E1_2; ?></td>
    <td  ><?php echo  $iT2E2; ?></td>
    <td  ><?php echo  $iT2E2_1; ?></td>
    <td  ><?php echo  $iT2E2_2; ?></td>
    <td  ><?php echo  $iT2; ?></td>
    <td  ><?php echo  $iTT; ?></td>
  </tr>
  <?php 
  		$iCantidad = 1;
		  }
               // Cerrar la sentencia preparada de MySQL
        mysqli_stmt_close($stmt);
   }
   if($iCantidad == 0 )
   {
   ?>
  <tr >
    <td colspan="79">ES NECESARIO QUE REGISTRE INFORMACI&Oacute;N </td>
  </tr>
  <?php 
  }
   ?>
</table> 
<?php
require "./inc/desconectar.php";
ob_end_flush();
?>

