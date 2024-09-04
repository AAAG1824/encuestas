<?php
/*
//---------------------------------------------------------------------
Fecha		:	24/03/2015
Nombre	    :	Eduardo Martinez
Descripcion : 	Archivo de Funciones y Variables comunes
//---------------------------------------------------------------------
*/

//---------------------------------------------------------------------
// Conexiones
//---------------------------------------------------------------------
 
$GbliIVA = 0.16;  
// Conectarse a la base de datos 1
$link = mysqli_connect($mysql_servidor, $mysql_usuario, $mysql_password, $mysql_base_de_datos);
if (!$link) {
    die("No se puede conectar a la base de datos: " . mysqli_connect_error());
} 

// Cambiar el set de caracteres a utf8
if (!mysqli_set_charset($link, "utf8")) {
    die("Error al cargar el set de caracteres utf8: %s\n" . mysqli_error($link));
}



$link2 = mysqli_connect($mysql_servidor, $mysql_usuario, $mysql_password, $mysql_base_de_datos);
if (!$link2) {
    die("No se puede conectar a la base de datos: " . mysqli_connect_error());
} 

// Cambiar el set de caracteres a utf8
if (!mysqli_set_charset($link2, "utf8")) {
    die("Error al cargar el set de caracteres utf8: %s\n" . mysqli_error($link2));
}



//---------------------------------------------------------------------
// Funciones
//---------------------------------------------------------------------

function Codificacion($Codigo,$Op)
{


if( $Op == 1 )
	{
		// Encriptar
		$strClave = str_rot13($Codigo);
		$strClave = base64_encode($strClave);
		
	}
	else
	{
		// Desencriptar
		$strClave = base64_decode($Codigo);
		$strClave = str_rot13($strClave);
	}

return $strClave;
}

function FechaJuliana($strFecha,$Op)
{
//      Fecha DD/MM/AAAA

$strFechaJul = '';
$StrDD = '';
$StrMM = '';
$StrAA = '';
$from = '';
if( $Op == 1 ) 
	{
		// Convertir Fecha Juliana 
		   $from = explode('/', $strFecha);
		   $strFechaJul=juliantojd($from[1],$from[0],$from[2]);
			 
	}
	else
	{
		// Convertir Fecha Normal
		 $strFechaJul=jdtojulian($strFecha);
		 
		  $from = explode('/', $strFechaJul);
		  
		  if($from[0] <=9)
		  	$from[0]  = '0'.$from[0] ;
		  if($from[1] <=9)
		  	$from[1]  = '0'.$from[1] ;
		 $strFechaJul= $from[1] . '/' . $from[0] . '/' . $from[2];
		  
 	}

return $strFechaJul;

}




function RetornaChkList($ChkLst,$ChkLstSts,$Indice)
{
$sCh 	= substr($ChkLst,$Indice , 1 );
$sChSts = substr($ChkLstSts,$Indice , 1 );
 
if($sCh == '0' )
	{ return ""; }
elseif($sCh == '1' )
	{ 
		if($sChSts == '0' )
				{ return ""; }
		elseif($sChSts == '1' )
				{ return "L"; }
		elseif($sChSts == '2' )
				{ return "M"; }
		elseif($sChSts == '3' )
				{ return "G"; }
	}
		

}


function RetornaDocList($ChkLst,$ChkLstSts,$Indice,$link2)
{
$sCh 	= substr($ChkLst,$Indice , 1 );
$sChSts = substr($ChkLstSts,$Indice , 1 );
 
if($sCh == '1' )  // SI
	{ return "S"; }
if($sCh == '2' )  // NO
	{ return "N"; }
elseif($sCh == '3' )  //  INC
	{ 
	/*
		 $sTexto="";
		 $stmt2 ="";
		 $strSQL  = "SELECT   `TipoFaltante` FROM `tipofaltante` WHERE `EstadoId`=1  AND TipoFaltanteId =? ";										 
		if ($stmt2 = mysqli_prepare($link2, $strSQL ))
		{ 
  						mysqli_stmt_bind_param($stmt2,'i',$sChSts);
			mysqli_stmt_execute($stmt2); 
			mysqli_stmt_bind_result($stmt2, $sTexto); 
			while (mysqli_stmt_fetch($stmt2)) { 
			
					   } 
					 
			
						
			mysqli_stmt_close($stmt2);
			return trim("INC: ".$sTexto);
		 }  

*/
return "I";
	}
		

}






function FunHojalateriaConcepto($ChkLst,$ChkLstSts,$sTpo,array $Concepto,$Indice)
{

 	$sTextoParteDanio = "";
$sCh 	= substr($ChkLst,$Indice , 1 );
$sChSts = substr($ChkLstSts,$Indice , 1 );
 
if($sCh == '0' )
	{ $sTextoParteDanio = ""; }
elseif($sCh == '1' )
	{ 
		if($sChSts == '0' )
				{ $sTextoParteDanio = ""; }
		elseif($sChSts == '1' )
				{   $sTextoParteDanio = "REPARACION DE " . $Concepto[$Indice];
				 }
		elseif($sChSts == '2' )
				{   $sTextoParteDanio = "REPARACION DE " . $Concepto[$Indice];
				 }
		elseif($sChSts == '3' )
				{   $sTextoParteDanio = "SUSTITUCION DE " . $Concepto[$Indice];
				}
	}
return $sTextoParteDanio;		

}

 
function FunHojalateriaPrecio ( $ChkLst , $ChkLstSts, $sTipo,array $sConceptoValoresSL,array $sConceptoValoresSM,array $sConceptoValoresSG,array $sConceptoValoresPL, array $sConceptoValoresPM, array $sConceptoValoresPG, $Indice)
{
 
 	$sTextoParteDanio = "";
$sCh 	= substr($ChkLst,$Indice , 1 );
$sChSts = substr($ChkLstSts,$Indice , 1 );
 
if($sCh == '0' )
	{ $sTextoParteDanio = ""; }
elseif($sCh == '1' )
	{ 
		if($sChSts == '0' )
				{ $sTextoParteDanio = ""; }
		elseif($sChSts == '1' )
				{  
				if(trim($sTipo) == "SEDAN" ) { $sTextoParteDanio =  $sConceptoValoresSL[$Indice]; }  
				else if(trim($sTipo) == "PICK UP"  || trim($sTipo) == "PICKUP"  ) { $sTextoParteDanio =  $sConceptoValoresPL[$Indice]; }
			 	else { $sTextoParteDanio =  0; }
 				 }
		elseif($sChSts == '2' )
				{   
				if(trim($sTipo) == "SEDAN" ) { $sTextoParteDanio =  $sConceptoValoresSM[$Indice]; }  
				else if(trim($sTipo) == "PICK UP"  || trim($sTipo) == "PICKUP"  ) { $sTextoParteDanio =  $sConceptoValoresPM[$Indice]; }
			 	else { $sTextoParteDanio =  0; }
				}
		elseif($sChSts == '3' )
				{  
				if(trim($sTipo) == "SEDAN" ) { $sTextoParteDanio =  $sConceptoValoresSG[$Indice]; }  
				else if(trim($sTipo) == "PICK UP"  || trim($sTipo) == "PICKUP"  ) { $sTextoParteDanio =  $sConceptoValoresPG[$Indice]; }
			 	else { $sTextoParteDanio =  0; }
				}
	} 
if($sTextoParteDanio !="") {	return  $sTextoParteDanio;		 }
else	 { return "";}

}


function w_currency($number) { 
   if ($number < 0) { 
     $print_number = "($ " . str_replace('-', '', number_format ($number, 2, ".", ",")) . ")"; 
    } else { 
     $print_number = "$ " .  number_format ($number, 2, ".", ",") ; 
   } 
   return $print_number; 
}



function url_exists( $url = NULL ) {
 
    if( empty( $url ) ){
        return 0;
    }
 
    $options['http'] = array(
        'method' => "HEAD",
        'ignore_errors' => 1,
        'max_redirects' => 0
    );
    $body = @file_get_contents( $url, NULL, stream_context_create( $options ) );
    
    // Ver http://php.net/manual/es/reserved.variables.httpresponseheader.php
    if( isset( $http_response_header ) ) {
        sscanf( $http_response_header[0], 'HTTP/%*d.%*d %d', $httpcode );
 
        // Aceptar solo respuesta 200 (Ok), 301 (redirección permanente) o 302 (redirección temporal)
        $accepted_response = array( 200, 301, 302 );
        if( in_array( $httpcode, $accepted_response ) ) {
            return 1;
        } else {
            return 0;
        }
     } else {
         return 0;
     }
}
 

?>