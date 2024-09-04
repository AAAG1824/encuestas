<?php  
// Este archivo contiene la información para conectarse a la base de datos
ob_start();
session_start();
date_default_timezone_set("America/Monterrey");
// --- SITE
 
/*
$mysql_servidor = "localhost:3306"; 
$mysql_base_de_datos = "halzacom_encuesta"; 
$mysql_usuario = "halzacom_encuesta";
$mysql_password = "Halza.2023"; 
*/

$mysql_servidor = "localhost:3306"; 
$mysql_base_de_datos = "halzacom_encuesta"; 
$mysql_usuario = "halzacom_encuesta";
$mysql_password = "Halza.2023"; 
  

$sGFotoMaestro = "admin"; 
$sGFotoAlumno  = "user";  
// nIVELES DE PUESTOS
// aDMINOSTRACION,servoicio , taller

$GblLvlAdministracion	 = 1;
$GblLvlResponsable 		 = 2;
$GblLvlAdministrador	 = 3;
$GblLvlEmpleado			 = 4;

//


$GblLogotipo = " ";
$GblLogotipoCIA = " ";
$GblEmail = "ermartinezm@hotmail.com";
$GblPaginar = 500;
$PorcentajeRojo = 0;
$GblLlave ="TW1"; 
$GblCiudadId = 26;
$GblNomSistema= ".:: Halza - Encuestas ::.";
$GblAccion = "";
$GblMensaje = "";

$GblFecha =  date("Y")  .  date("m")  .date("d");
$GblFecha2 =  date("d")  .  date("m")  .date("y");
$GblHora =  date("H") . date("i") . date("s");
$GblFechaF =  date("d")  . "/" . date("m")  . "/" .date("Y");
$GblHoraF =  date("H") . ":" . date("i"). ":" . date("s");
$GblHoraAtual =   date("Y")  . "-" . date("m")  . "-" .date("d") . " ". date("H") . ":" . date("i"). ":" . date("s");
$GblFechaHoyInput =   date("Y")  . "-" . date("m")  . "-" .date("d");
$GblFechaHoyInputF=   (date("Y")+10)  . "-" . date("m")  . "-" .date("d");

$GblFechaHora =  date("Y")  .  date("m")  .date("d") . date("H") . date("i") . date("s"); 
$GblPrimerDiaMes = "01". "/" . date("m")  . "/" .date("Y");
$GblUltimoDiaMes = date("d",(mktime(0,0,0, date("m")+1,1,date("Y"))-1)) . "/" . date("m")  . "/" .date("Y");
// Funcion General Limpieza

function Limpieza($strValor)
{
$strRet ='';
$strRet = str_replace('"', '',strip_tags($strValor));
 return $strRet;
} 


function LimpiezaMayusculas($strValor)
{
$strRet ='';
$strRet = str_replace('"', '',strip_tags($strValor));
$strRet = strtoupper(str_replace('"', '',strip_tags($strValor)));
return $strRet;
} 


function FechaSistema($strFecha,$Op)
{
$diasS = array("domingo","lunes","martes","mi&eacute;rcoles","jueves","viernes","s&aacute;bado");
$mesS  = array("Nada","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$StrDD = '';
$StrMM = '';
$StrAA = '';
$from = '';
$Fecha='';
if( $Op == 1 ) // Con hora
	{
	$Fecha = substr( $strFecha,6,2).'/'.substr( $strFecha,4,2) .'/'.substr( $strFecha,0,4) . ' ' .  substr( $strFecha,8,2).':'.substr( $strFecha,10,2) .':'.substr( $strFecha,12,2);
	}
elseif( $Op == 2 ) // Con hora de MM/DD/YYYY  a YYYYMMDDHHMMSS
	{
	$Fecha = substr( $strFecha,6,4).substr( $strFecha,0,2). substr( $strFecha,3,2). date("H") . date("i") . date("s");
	 }
elseif( $Op == 3 ) // Con hora de DD/MM/YYYY  a YYYYMMDDHHMMSS
	{
	$Fecha = substr( $strFecha,6,4).substr( $strFecha,3,2). substr( $strFecha,0,2). date("H") . date("i") . date("s");
	 }
elseif( $Op == 4 ) // sin hora
	{
	$Fecha = substr( $strFecha,6,2).'/'.substr( $strFecha,4,2) .'/'.substr( $strFecha,0,4) ;
	}
	
elseif( $Op == 5 ) // Con hora de DD/MM/YYYY  a YYYYMMDDHHMMSS
	{
	$Fecha = substr( $strFecha,6,4).substr( $strFecha,3,2). substr( $strFecha,0,2) ;
	 }
	
elseif( $Op == 6 ) // Con hora de DD/MM/YYYY  a YYYYMMDDHHMMSS
	{
	$Fecha =  substr( $strFecha,8,2).':'.substr( $strFecha,10,2) ;
	 }
elseif( $Op == 10 ) // Con hora de DD/MM/YY  a YYYYMMDDHHMMSS
	{
	 $Fecha = substr( $strFecha,0,4).substr( $strFecha,5,2)  .substr( $strFecha,8,2).substr( $strFecha,11,2)  .substr( $strFecha,14,2).'00'  ;
	 }
elseif( $Op == 11 ) // Con hora de DD/MM/YY  a YYYYMMDDHHMMSS
	{
	 $Fecha = substr( $strFecha,8,2).'/'.substr( $strFecha,5,2) .'/' . substr( $strFecha,0,4) ;
	 }
elseif( $Op == 12 ) // Con hora de DD/MM/YY  a YYYYMMDDHHMMSS
	{
	 $Fecha =  substr( $strFecha,11,2) .":" .substr( $strFecha,14,2);
	 }
elseif( $Op == 20 ) // Con hora de DD/MM/YY  a YYYYMMDDHHMMSS
	{
	$Fecha = "20".substr( $strFecha,6,2).substr( $strFecha,3,2). substr( $strFecha,0,2). "000001";
	 }
elseif( $Op == 21 ) // Con hora de DD/MM/YY  a YYYYMMDDHHMMSS
	{
	 $Fecha = substr( $strFecha,0,4).substr( $strFecha,5,2)  .substr( $strFecha,8,2);
	 }
elseif( $Op == 30 ) // Con hora de DD/MM/YY  a YYYYMMDDHHMMSS
	{
	$Fecha = date("d")  . "-" . date("m")  . "-" .date("Y");
	}
elseif( $Op == 31 ) // Con hora de DD/MM/YY  a YYYYMMDDHHMMSS
	{
	$Fecha =  substr( $strFecha,6,2) . "-" . substr( $strFecha,4,2)  . "-"  .substr( $strFecha,0,4);
	}
elseif( $Op == 32 ) // Con hora de DD/MM/YY  a YYYYMMDDHHMMSS
	{
	$Fecha = date("Y")  . "-" . date("m")  . "-" .date("d");
	}
elseif( $Op == 33 ) // Con hora de DD/MM/YY  a YYYYMMDDHHMMSS
	{
	$Fecha =substr( $strFecha,0,4) . substr( $strFecha,5,2).substr( $strFecha,8	,2);
	}
elseif( $Op == 34 ) // Con hora de DD/MM/YY  a YYYYMMDDHHMMSS
	{
	$Fecha =  substr( $strFecha,0,4) . "-" . substr( $strFecha,4,2)  . "-"  .substr( $strFecha,6,2) . "T" .substr( $strFecha,8,2) . ":"  .substr( $strFecha,10,2) . ":"  .substr( $strFecha,12,2);
	}
elseif( $Op == 35 ) // Con hora de DD/MM/YY  a YYYYMMDDHHMMSS
	{
	$Fecha =  substr( $strFecha,0,4) . "-" . substr( $strFecha,4,2)  . "-"  .substr( $strFecha,6,2);
	}
elseif( $Op == 100 ) // Dia de la semana DD de MM  del AAAA
	{
	$Fecha = $diasS[intval(date("w"))] . " " . intval(date("d")) . " de " .  $mesS[intval(date("m"))]  . " del "  .date("Y"); 
	}
return $Fecha;
}

function get_extension($str) 
{
        return end(explode(".", $str));
}   

function LimpiaRaros($str)
{
$strCadenaL=trim($str);
$strCadenaL = str_replace("\""," ",$strCadenaL);
$strCadenaL=trim($strCadenaL);
 
$strCadenaL=trim($strCadenaL);
return $strCadenaL;
}

Function ConvertirMoneda($numero){  
 $final ="";
$longitud = strlen($numero);  
$punto = substr($numero, -1,1);  
$punto2 = substr($numero, 0,1);  
$separador = ".";  
if($punto == "."){  
$numero = substr($numero, 0,$longitud-1);  
$longitud = strlen($numero);  
}  
if($punto2 == "."){  
$numero = "0".$numero;  
$longitud = strlen($numero);  
}  
$num_entero = strpos ($numero, $separador);  
$centavos = substr ($numero, ($num_entero));  
$l_cent = strlen($centavos);  
if($l_cent == 2){$centavos = $centavos."0";}  
elseif($l_cent == 3){$centavos = $centavos;}  
elseif($l_cent > 3){$centavos = substr($centavos, 0,3);}  
$entero = substr($numero, -$longitud,$longitud-$l_cent);  
if(!$num_entero){  
    $num_entero = $longitud;  
    $centavos = ".00";  
    $entero = substr($numero, -$longitud,$longitud);  
}  
  
$start = floor($num_entero/3);  
$res = $num_entero-($start*3);  
if($res == 0){$coma = $start-1; $init = 0;}else{$coma = $start; $init = 3-$res;}  
$d= $init; $i = 0; $c = $coma;  
    while($i < $num_entero){  
        if($d == 3 && $c > 0){$d = 0; $sep = ","; $c = $c-1;}else{$sep = "";}  
        $final .=  $sep.$entero[$i];  
        $i = $i+1; // todos los digitos  
        $d = $d+1; // poner las comas  
    }   
    return  trim($final.$centavos);   
}  
?>