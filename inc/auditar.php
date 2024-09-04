<?php  

//Auditoria($GblAccion,$tmp_Usuario, $_POST["password"],$GblFechaHora,$GblMensaje,$strLatitud,$strLongitud,$strIpGral);


function Auditoria($link,$tpAccion,$tpId, $tpUsuario,$tpFechaHora,$tpMensaje,$tpLatitud,$tpLongitud,$tpIpGral)
{
	$StrSQL = "INSERT INTO auditoria (Id, Movimiento, UsuarioId, User, FechaHora, Descripcion, LatX, LatY, Ip) ";
	// TEST', '1', 'TEST', '12', 'ASASDASDAS', '12', '2', 'AS');";
	// , ,,$,$,$,$
	$StrSQL = $StrSQL . " VALUES (NULL, '" . $tpAccion; 
	$StrSQL = $StrSQL . "',". $tpId;  
	$StrSQL = $StrSQL . ",'" . $tpUsuario;  
	$StrSQL = $StrSQL . "','" . $tpFechaHora;  
	$StrSQL = $StrSQL . "','" . $tpMensaje;  
	$StrSQL = $StrSQL . "','" . $tpLatitud;  
	$StrSQL = $StrSQL . "','" . $tpLongitud;  
	$StrSQL = $StrSQL . "','"  . $tpIpGral . "')"; ; 
	//		die($StrSQL);			 		 
	$query = mysqli_query($link, $StrSQL) or die (mysqli_error($link));
	 
}

?>
