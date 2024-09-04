<?php
/*
//---------------------------------------------------------------------
Fecha		:	24/03/2015
Nombre	    :	Eduardo Martinez
Descripcion : 	Desconectar
//---------------------------------------------------------------------
*/
mysqli_close($link);
mysqli_close($link2);
 
ob_end_flush();

// Cerrar la conexi