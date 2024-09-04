<?php    ob_start();  
require "../inc/settings.php";
require "../inc/funciones.php";  
 $iEncuestaId =0;
 $sEmpresa ='';
 $iFechaInicio =0;
 $iFechaFin =0;
 $sNombreEncuesta ='';
 $sDescripcion ='';
 $sMensajeBienvenida ='';
 $sMensajeFinal ='';

$iIdE =0;
$iId = 0;
$IdE=isset( $_GET['IdE'] ) ?    ($_GET['IdE']) : 0 ; 
$Id = isset( $_GET['Id'] ) ?    ($_GET['Id']) : 0 ;  
$iSeccActual = isset( $_GET['Is'] ) ?    ($_GET['Is']) : 0 ;  
$iIdE =  base64_decode($IdE);
$iId  =  base64_decode($Id);
$iAcc = isset( $_POST['Acc'] ) ?    ($_POST['Acc']) : 0 ;
$iPreguntas = isset( $_POST['Pg'] ) ?    ($_POST['Pg']) : 0 ;
$iPreguntaInicial = isset( $_POST['PgI'] ) ?    ($_POST['PgI']) : 1 ;
$sSession = isset( $_POST['ss'] ) ?    ($_POST['ss']) : '' ;
$iSecc = isset( $_POST['ssec'] ) ?    ($_POST['ssec']) : 0 ;
$iNoNomina = 0 ;
$i=1;
/*
echo "<pre>";
print_r($_GET);
echo "</pre>";

echo "<pre>";
print_r($_POST);
echo "</pre>";*/
//die("<br>");
// Extraemos el # Nomina
$iNoNomina = 0 ; 
$EsNo = 0;

$sSql  = " ";
$sSql .= "  SELECT DISTINCT NoNomina FROM ts_encuestausuarios WHERE ContestarId = ?  ";
 if ($stmt = mysqli_prepare($link, $sSql))
  {
	mysqli_stmt_bind_param($stmt,'i',$iId);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,$iNoNomina);
		  while (mysqli_stmt_fetch($stmt)) {
		  }
		  
	     mysqli_stmt_close($stmt);
 }
 
 $sSql  = " ";
$sSql .= " SELECT EncuestaId, Empresa, FechaInicio, FechaFin, NombreEncuesta, Descripcion, MensajeBienvenida, MensajeFinal FROM ts_encuestas e ";
$sSql .= " WHERE e.EstadoId= 1 AND  EncuestaId = ? AND (  $GblFecha between FechaInicio AND FechaFin ) ";
 if ($stmt = mysqli_prepare($link, $sSql))
  {
	mysqli_stmt_bind_param($stmt,'i',$iIdE);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,$iEncuestaId, $sEmpresa, $iFechaInicio, $iFechaFin, $sNombreEncuesta, $sDescripcion, $sMensajeBienvenida, $sMensajeFinal);
		  while (mysqli_stmt_fetch($stmt)) {
		  }
		  
	     mysqli_stmt_close($stmt);
 }
  
// ---- barremos las preguntas ini
 $V=0;
  
 for ($i= $iPreguntaInicial;  $i <= $iPreguntas; $i++)	
  	{
	 $Nm ='R'.$i;
	 $iRespuesta =	isset( $_POST[$Nm] ) ?  Limpieza($_POST[$Nm]) : -1 ;  
	 
	 // Eliminamos
	 $sSQL  = " DELETE  FROM ts_encuestarespuesta   where EncuestaId  = ?  and ContestarId = ?  and PreguntaId  = ? "; 
	 if ($stmt = mysqli_prepare($link, $sSQL))
		 {
		    mysqli_stmt_bind_param($stmt, 'iii',$iIdE,$iId,$i  ); 
			mysqli_stmt_execute($stmt); 
			mysqli_stmt_close($stmt);  
		  }	
	 // Insertamos
	 $iUltimoId = 0 ;
	 
	 if( $iRespuesta == 1)
	 	$EsNo = 1;
	 
 	$sSQL  = " INSERT INTO ts_encuestarespuesta(EncuestaId,  ContestarId ,PreguntaId, RespuestaId, UsuarioContestoId, FechaAlta, UsuarioId)  ";
 	$sSQL .= " VALUES ( ?,?,?,?,?,$GblFechaHora,66699)";
	//  die("- $sSQL -<br>---,$iId---$iProductoId---".$iExistenciaActual."--");
	 if ($stmt = mysqli_prepare($link, $sSQL))
		 {
		    mysqli_stmt_bind_param($stmt, 'iiiii',$iIdE,$iId,$i , $iRespuesta,$iNoNomina  ); 
	 		mysqli_stmt_execute($stmt);
			// Obtener la última ID insertada 
		    // Cerrar la sentencia preparada de MySQL
        	mysqli_stmt_close($stmt);
		 }
	
	 
	}

//Avanzar a la pagina siguiente:
$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}"."/halzaenc/encuestas/seccion$iSecc.php" ;
  
$urlexists = url_exists( $url );

	  
    if($EsNo == 0 && $iSeccActual==1 )
		{ $iSecc=5;
		}
 
		
 // Antes de Finalizar Iniciamos Calculos violentos..
 
$iA1_1=0;$iA1_2=0;$iA1_3=0;$iB1_1=0;$iB1_2=0;$iB1_3=0;$iB1_4=0;$iB1_5=0;$iB1_6=0;$iB2_1=0;$iB2_2=0;$iB2_3=0;$iB2_4=0;
$iC1_1=0;$iC2_1=0;$iC2_2=0;$iD1_1=0;$iD1_2=0;$iD2_1=0;$iD2_2=0;$iD3_1=0;$iE1_1=0;$iE1_2=0;$iE2_1=0;$iE2_2=0;

 echo "<b> Inicia Proceso de Actualizacion de Calculos</b><br>";
 $iRespuesta = 0;
 $sAlerta = "0";
 // Nivel de Alerta Inicio 
 // Alerta 1
 $iSiNo=0;
$sSql  = "  SELECT   RespuestaId FROM ts_encuestarespuesta WHERE ContestarId = ? AND PreguntaId <=6  ";
 if ($stmt = mysqli_prepare($link, $sSql))
  {
	mysqli_stmt_bind_param($stmt,'i',$iId);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,$iRespuesta);
		  while (mysqli_stmt_fetch($stmt)) {
		  if($iRespuesta == 1 ) 
		  		{ $sAlerta = "1"; $iSiNo++; }
		  
		  }
		  
	     mysqli_stmt_close($stmt);
 }
 
 if($iSiNo >=1 ) 
 {
	 $iSiNo=0;
	 // Alerta 2
	$sSql  = "  SELECT   RespuestaId FROM ts_encuestarespuesta WHERE ContestarId = ? AND PreguntaId between 7 and 8  ";
	 if ($stmt = mysqli_prepare($link, $sSql))
	  {
		mysqli_stmt_bind_param($stmt,'i',$iId);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt,$iRespuesta);
			  while (mysqli_stmt_fetch($stmt)) {
			  if($iRespuesta == 1 ) 
					{ $iSiNo++; }
			  
			  }
			  
			 mysqli_stmt_close($stmt);
	 }
	 if($iSiNo >=1 ) { $sAlerta .= "1";} else { $sAlerta .= "0";}
	  $iSiNo=0;
	 // Alerta 3
	$sSql  = "  SELECT   RespuestaId FROM ts_encuestarespuesta WHERE ContestarId = ? AND PreguntaId between 9 and 15  ";
	 if ($stmt = mysqli_prepare($link, $sSql))
	  {
		mysqli_stmt_bind_param($stmt,'i',$iId);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt,$iRespuesta);
			  while (mysqli_stmt_fetch($stmt)) {
			  if($iRespuesta == 1 ) 
					{ $iSiNo++; }
			  
			  }
			  
			 mysqli_stmt_close($stmt);
	 }
	 if($iSiNo >=3 ) { $sAlerta .= "1";} else { $sAlerta .= "0";}
	  $iSiNo=0;
	 // Alerta 4
	$sSql  = "  SELECT   RespuestaId FROM ts_encuestarespuesta WHERE ContestarId = ? AND PreguntaId between 16 and 20  ";
	 if ($stmt = mysqli_prepare($link, $sSql))
	  {
		mysqli_stmt_bind_param($stmt,'i',$iId);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt,$iRespuesta);
			  while (mysqli_stmt_fetch($stmt)) {
			  if($iRespuesta == 1 ) 
					{ $iSiNo++; }
			  
			  }
			  
			 mysqli_stmt_close($stmt);
	 }
	 if($iSiNo >=2 ) { $sAlerta .= "1";} else { $sAlerta .= "0";}
 }
 else
 {
 $sAlerta = "0000";
 }
 echo "Nivel de Alerta:  $sAlerta<br>";
 // Nivel de Alerta Fin
 // Grupo 2 Inicio
 
 $iPreguntaId = 0;
 $i=1;$T=0;
 $sSql  = "  SELECT   PreguntaId,RespuestaId FROM ts_encuestarespuesta WHERE ContestarId = ? AND PreguntaId between 21 and 68  ";
	 if ($stmt = mysqli_prepare($link, $sSql))
	  {
		mysqli_stmt_bind_param($stmt,'i',$iId);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt,$iPreguntaId,$iRespuesta);
			  while (mysqli_stmt_fetch($stmt)) {
		   
		   		if($i==1) 								{	$iA1_2 += $iRespuesta;	 }
		   		else if($i==2) 							{	$iA1_1 += $iRespuesta;	 }  
		   		else if($i==3) 							{	$iA1_3 += $iRespuesta;	 }  
		   		else if($i==4 || $i==9) 				{	$iB1_1 += $iRespuesta;	 }  
		   		else if($i==5 || $i==6) 				{	$iB1_2 += $iRespuesta;	 } 
		   		else if($i==7 || $i==8) 				{	$iB1_3 += $iRespuesta;	 } 
		   		else if($i==41 || $i==42 || $i==43) 	{	$iB1_4 += $iRespuesta;	 } 
		   		else if($i==10 || $i==11) 				{	$iB1_5 += $iRespuesta;	 } 
		   		else if($i==12 || $i==13) 				{	$iB1_6 += $iRespuesta;	 } 
		   		else if($i==20 || $i==21 || $i==22) 	{	$iB2_1 += $iRespuesta;	 } 
		   		else if($i==18 || $i==19) 				{	$iB2_2 += $iRespuesta;	 } 
		   		else if($i==26 || $i==27) 				{	$iB2_3 += $iRespuesta;	 } 
		   		else if($i==14 || $i==15) 				{	$iC1_1 += $iRespuesta;	 } 
		   		else if($i==16) 						{	$iC2_1 += $iRespuesta;	 }  
		   		else if($i==17) 						{	$iC2_2 += $iRespuesta;	 } 
		   		else if($i==23 || $i==24 || $i==25) 	{	$iD1_1 += $iRespuesta;	 } 
		   		else if($i==28 || $i==29) 				{	$iD1_2 += $iRespuesta;	 } 
		   		else if($i==30 || $i==31 || $i==32) 	{	$iD2_1 += $iRespuesta;	 } 
		   		else if($i==44 || $i==45 || $i==46) 	{	$iD2_2 += $iRespuesta;	 } 
		   		else if($i==33 || $i==34 || $i==35 || $i==36 || $i==37 || $i==38 || $i==39 || $i==40) 	{	$iD3_1 += $iRespuesta; $T.=",".$iPreguntaId;	 } 
			  
 				$i++;
			  }
			  
			 mysqli_stmt_close($stmt);
	 }
 
 // iNSERTAMOS EL  Grupo 2
 
 // eliminamos
  $sSQL  = " DELETE  FROM ts_encuestascalculodet   where    EncuestaId  = ?  and EmpresaId = ?  and NoNomina  = ?  "; 
	 if ($stmt = mysqli_prepare($link, $sSQL))
		 {
		    mysqli_stmt_bind_param($stmt, 'iii',$iId,$iIdE,$iNoNomina  ); 
			mysqli_stmt_execute($stmt); 
			mysqli_stmt_close($stmt);  
		  }	
		  
  $sSQL  = " DELETE  FROM ts_encuestascalculoenc   where    EncuestaId  = ?  and EmpresaId = ?  and NoNomina  = ?  "; 
	 if ($stmt = mysqli_prepare($link, $sSQL))
		 {
		    mysqli_stmt_bind_param($stmt, 'iii',$iId,$iIdE,$iNoNomina  ); 
			mysqli_stmt_execute($stmt); 
			mysqli_stmt_close($stmt);  
		  }			  
		  
		  
$sSql  = "  INSERT INTO ts_encuestascalculodet(EncuestaId, EmpresaId, NoNomina, EstadoId, Grupo, Alerta, A1_1, A1_2, A1_3, B1_1, B1_2, B1_3, B1_4, B1_5, B1_6,";
$sSql .= "  B2_1, B2_2, B2_3, B2_4, C1_1, C2_1, C2_2, D1_1, D1_2, D2_1, D2_2, D3_1, E1_1, E1_2, E2_1, E2_2, Fecha, UsuarioId)  " ;
$sSql .= " VALUES ( ?,?,?,1,1,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,$GblFechaHora,66699)"; 
	 if ($stmt = mysqli_prepare($link, $sSql))
		 {
		 
		    mysqli_stmt_bind_param($stmt, 'iiisiiiiiiiiiiiiiiiiiiiiiiiii',$iId,$iIdE,$iNoNomina ,$sAlerta, $iA1_1,$iA1_2,$iA1_3,$iB1_1,$iB1_2,$iB1_3,$iB1_4,$iB1_5,$iB1_6,$iB2_1,$iB2_2,$iB2_3,$iB2_4,$iC1_1,$iC2_1,$iC2_2,$iD1_1,$iD1_2,$iD2_1,$iD2_2,$iD3_1,$iE1_1,$iE1_2,$iE2_1,$iE2_2   ); 
	 		mysqli_stmt_execute($stmt);
			// Obtener la última ID insertada 
		    // Cerrar la sentencia preparada de MySQL
        	mysqli_stmt_close($stmt);
		 }
 
 echo "<br>Grupo 2 <br>";
 echo "Grupo 2.A :  $iA1_1,$iA1_2,$iA1_3 <br>";
 echo "Grupo 2.B :  $iB1_1,$iB1_2,$iB1_3,$iB1_4,$iB1_5,$iB1_6 <----> $iB2_1,$iB2_2,$iB2_3,$iB2_4<br>";
 echo "Grupo 2.C :  $iC1_1 <----> $iC2_1,$iC2_2<br>";
 echo "Grupo 2.D :  $iD1_1,$iD1_2 <----> $iD2_1,$iD2_2 <----> $iD3_1 <br><br>"; 

// Insertar HEADER Principanl FIN
$iA=0;$iA1=0;$iB=0;$iB1=0;$iB2=0;$iC=0;$iC1=0;$iC2=0;$iD=0;$iD1=0;$iD2=0;$iD3=0;$iE=0;$iE1=0;$iE2=0;
$iA1= $iA1_1+$iA1_2+$iA1_3;
$iA=$iA1;
$iB1=$iB1_1+$iB1_2+$iB1_3+$iB1_4+$iB1_5+$iB1_6;
$iB2=$iB2_1+$iB2_2+$iB2_3+$iB2_4;
$iB=$iB1+$iB2;
$iC1=$iC1_1;
$iC2=$iC2_1+$iC2_2;
$iC=$iC1+$iC2; 
$iD1=$iD1_1;
$iD2=$iD2_1+$iD2_2;
$iD3=$iD3_1;
$iD=$iD1+$iD2+$iD3; 
$iE1=$iE1_1+$iE1_2  ;
$iE2= $iE2_1+$iE2_2 ;
$iE=$iE1+$iE2; 
	$sSql  = " INSERT INTO ts_encuestascalculoenc(EncuestaId, EmpresaId, NoNominda, EstadoId, Grupo, Alerta, A, A1, B, B1, B2, C, C1, C2, D, D1, D2, D3, E, E1, E2, Fecha, UsuarioId)";
//  
  $sSql .= " VALUES ( ?,?,?,1,1,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,$GblFechaHora,66699)"; 
	 if ($stmt = mysqli_prepare($link, $sSql))
		 {
		 
		    mysqli_stmt_bind_param($stmt, 'iiisiiiiiiiiiiiiiii',$iId,$iIdE,$iNoNomina ,$sAlerta,$iA, $iA1, $iB, $iB1, $iB2, $iC, $iC1, $iC2, $iD, $iD1, $iD2, $iD3, $iE, $iE1, $iE2); 
	 		mysqli_stmt_execute($stmt);
			// Obtener la última ID insertada 
		    // Cerrar la sentencia preparada de MySQL
        	mysqli_stmt_close($stmt);
		 }





 // GRupo 2 Fin
 
 
 // limpiamos variables 
$iA1_1=0;$iA1_2=0;$iA1_3=0;$iB1_1=0;$iB1_2=0;$iB1_3=0;$iB1_4=0;$iB1_5=0;$iB1_6=0;$iB2_1=0;$iB2_2=0;$iB2_3=0;$iB2_4=0;
$iC1_1=0;$iC2_1=0;$iC2_2=0;$iD1_1=0;$iD1_2=0;$iD2_1=0;$iD2_2=0;$iD3_1=0;$iE1_1=0;$iE1_2=0;$iE2_1=0;$iE2_2=0;

 $iPreguntaId = 0;
 $i=1;$T=0;
 $sSql  = "  SELECT   PreguntaId,RespuestaId FROM ts_encuestarespuesta WHERE ContestarId = ? AND PreguntaId between 69 and 142  ";
	 if ($stmt = mysqli_prepare($link, $sSql))
	  {
		mysqli_stmt_bind_param($stmt,'i',$iId);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt,$iPreguntaId,$iRespuesta);
			  while (mysqli_stmt_fetch($stmt)) {
		   
		   		if($i==1 || $i==3) 									{	$iA1_1 += $iRespuesta;	 }  
		   		else if($i==2 || $i==4) 							{	$iA1_2 += $iRespuesta;	 }  
		   		else if($i==5) 										{	$iA1_3 += $iRespuesta;	 }  
		   		else if($i==6 || $i==12) 							{	$iB1_1 += $iRespuesta;	 }  
		   		else if($i==7 || $i==8) 							{	$iB1_2 += $iRespuesta;	 } 
		   		else if($i==9 || $i==10 || $i==11)	 				{	$iB1_3 += $iRespuesta;	 } 
		   		else if($i==66 || $i==67 || $i==68 || $i==69) 		{	$iB1_4 += $iRespuesta;	 } 
		   		else if($i==13 || $i==14) 							{	$iB1_5 += $iRespuesta;	 } 
		   		else if($i==15 || $i==16) 							{	$iB1_6 += $iRespuesta;	 } 
		   		else if($i==25 || $i==26 || $i==27 || $i==28)	 	{	$iB2_1 += $iRespuesta;	 } 
		   		else if($i==23 || $i==24) 							{	$iB2_2 += $iRespuesta;	 } 
		   		else if($i==29 || $i==30) 							{	$iB2_3 += $iRespuesta;	 } 
		   		else if($i==35 || $i==36) 							{	$iB2_4 += $iRespuesta;	 } 
		   		else if($i==17 || $i==18) 							{	$iC1_1 += $iRespuesta;	 } 
		   		else if($i==19 || $i==20)							{	$iC2_1 += $iRespuesta;	 }  
		   		else if($i==21 || $i==22)							{	$iC2_2 += $iRespuesta;	 } 
		   		else if($i==31 || $i==32 || $i==33 || $i==34)	 	{	$iD1_1 += $iRespuesta;	 } 
		   		else if($i==37 || $i==38 || $i==39 || $i==40 || $i==41)	 	{	$iD1_2 += $iRespuesta;	 } 
		   		else if($i==42 || $i==43 || $i==44 || $i==45 || $i==46)	 	{	$iD2_1 += $iRespuesta;	 } 
		   		else if($i==71 || $i==72 || $i==73 || $i==74 )				{	$iD2_2 += $iRespuesta;	 }
		   		else if($i==57 || $i==58 || $i==59 || $i==60 || $i==61 || $i==62 || $i==63 || $i==64)	{	$iD3_1 += $iRespuesta;	 }   
		   		else if($i==47 || $i==48) 									{	$iE1_1 += $iRespuesta;	 } 
		   		else if($i==49 || $i==50 || $i==51 || $i==52)			 	{	$iE1_2 += $iRespuesta;	 } 
		   		else if($i==55 || $i==56) 									{	$iE2_1 += $iRespuesta;	 } 
		   		else if($i==53 || $i==54) 									{	$iE2_2 += $iRespuesta;	 } 
			  
 				$i++;
			  }
			  
			 mysqli_stmt_close($stmt);
	 }


 
  echo "Grupo 3 <br>";
 echo "Grupo 3.A :  $iA1_1,$iA1_2,$iA1_3 <br>";
 echo "Grupo 3.B :  $iB1_1,$iB1_2,$iB1_3,$iB1_4,$iB1_5,$iB1_6 <----> $iB2_1,$iB2_2,$iB2_3,$iB2_4<br>";
 echo "Grupo 3.C :  $iC1_1 <----> $iC2_1,$iC2_2<br>";
 echo "Grupo 3.D :  $iD1_1,$iD1_2 <----> $iD2_1,$iD2_2 <----> $iD3_1<br>";
 echo "Grupo 3.E :  $iE1_1,$iE1_2 <----> $iE2_1,$iE2_2<br>";
 	  
$sSql  = "  INSERT INTO ts_encuestascalculodet(EncuestaId, EmpresaId, NoNomina, EstadoId, Grupo, Alerta, A1_1, A1_2, A1_3, B1_1, B1_2, B1_3, B1_4, B1_5, B1_6,";
$sSql .= "  B2_1, B2_2, B2_3, B2_4, C1_1, C2_1, C2_2, D1_1, D1_2, D2_1, D2_2, D3_1, E1_1, E1_2, E2_1, E2_2, Fecha, UsuarioId)  " ;
$sSql .= " VALUES ( ?,?,?,1,2,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,$GblFechaHora,66699)"; 
	 if ($stmt = mysqli_prepare($link, $sSql))
		 {
		 
		    mysqli_stmt_bind_param($stmt, 'iiisiiiiiiiiiiiiiiiiiiiiiiiii',$iId,$iIdE,$iNoNomina ,$sAlerta, $iA1_1,$iA1_2,$iA1_3,$iB1_1,$iB1_2,$iB1_3,$iB1_4,$iB1_5,$iB1_6,$iB2_1,$iB2_2,$iB2_3,$iB2_4,$iC1_1,$iC2_1,$iC2_2,$iD1_1,$iD1_2,$iD2_1,$iD2_2,$iD3_1,$iE1_1,$iE1_2,$iE2_1,$iE2_2   ); 
	 		mysqli_stmt_execute($stmt);
			// Obtener la última ID insertada 
		    // Cerrar la sentencia preparada de MySQL
        	mysqli_stmt_close($stmt);
		 }
 

// Insertar HEADER Principanl FIN
$iA=0;$iA1=0;$iB=0;$iB1=0;$iB2=0;$iC=0;$iC1=0;$iC2=0;$iD=0;$iD1=0;$iD2=0;$iD3=0;$iE=0;$iE1=0;$iE2=0;
$iA1= $iA1_1+$iA1_2+$iA1_3;
$iA=$iA1;
$iB1=$iB1_1+$iB1_2+$iB1_3+$iB1_4+$iB1_5+$iB1_6;
$iB2=$iB2_1+$iB2_2+$iB2_3+$iB2_4;
$iB=$iB1+$iB2;
$iC1=$iC1_1;
$iC2=$iC2_1+$iC2_2;
$iC=$iC1+$iC2; 
$iD1=$iD1_1;
$iD2=$iD2_1+$iD2_2;
$iD3=$iD3_1;
$iD=$iD1+$iD2+$iD3; 
$iE1=$iE1_1+$iE1_2  ;
$iE2= $iE2_1+$iE2_2 ;
$iE=$iE1+$iE2; 
	$sSql  = " INSERT INTO ts_encuestascalculoenc(EncuestaId, EmpresaId, NoNominda, EstadoId, Grupo, Alerta, A, A1, B, B1, B2, C, C1, C2, D, D1, D2, D3, E, E1, E2, Fecha, UsuarioId)";
//  
  $sSql .= " VALUES ( ?,?,?,1,2,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,$GblFechaHora,66699)"; 
	 if ($stmt = mysqli_prepare($link, $sSql))
		 {
		 
		    mysqli_stmt_bind_param($stmt, 'iiisiiiiiiiiiiiiiii',$iId,$iIdE,$iNoNomina ,$sAlerta,$iA, $iA1, $iB, $iB1, $iB2, $iC, $iC1, $iC2, $iD, $iD1, $iD2, $iD3, $iE, $iE1, $iE2); 
	 		mysqli_stmt_execute($stmt);
			// Obtener la última ID insertada 
		    // Cerrar la sentencia preparada de MySQL
        	mysqli_stmt_close($stmt);
		 }


  echo ("<br>Fin");
 
 
 // Acutalizamos
	$sSQL  = " UPDATE ts_encuestausuarios SET EstadoId=2,Avance =  $iSecc  , Fecha= $GblFechaHora , UsuarioId = 66699   where ContestarId = ? ";
	 if ($stmt = mysqli_prepare($link, $sSQL))
		 {
		    mysqli_stmt_bind_param($stmt, 'i',$iId  ); 
			mysqli_stmt_execute($stmt); 
			mysqli_stmt_close($stmt);  
		  }
		  
		 
  
					 header("location: Despedida.php?IdE=$IdE&Id=$Id");
					exit();
 
// ---- barremos las preguntas fin
 
ob_end_flush();
require "../inc/desconectar.php";
?>