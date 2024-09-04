<?php 
ob_start(); 
require "./inc/settings.php";
require "./inc/funciones.php"; 
require "./inc/validasession.php"; 
$iCant=0;
$iId=isset( $_POST['Id'] ) ?  Limpieza($_POST['Id']) : 0 ;  
$sCadenaSelect =""; 
  
 
$iPreguntaId=0;
$sGrupoBreve="";
$sGrupo		="";
$iEstadoId	=0;
$iOrden		=0;
$sPreguntaBreve	="";
$sInstruccion	="";
$sPregunta	="";
$sRespuesta01	="";
$iValor01	=0;
$sRespuesta02	="";
$iValor02 	=0;
$sRespuesta03	="";
$iValor03	=0; 
$sRespuesta04	=""; 
$iValor04 	=0;
$sRespuesta05	="";
$iValor05	=0;
$sSQL  = " SELECT    g.GrupoBreve,g.Grupo, p.EstadoId, p.Orden, p.PreguntaBreve, p.Instruccion, p.Pregunta, p.Respuesta01,   ";
$sSQL .= " p.Valor01,  p.Respuesta02,  p.Valor02,  p.Respuesta03,  p.Valor03,  p.Respuesta04,  p.Valor04,  p.Respuesta05,  p.Valor05     ";
$sSQL .= " FROM ts_preguntas  p  INNER JOIN ts_grupos g ON g.GrupoId = p.GrupoId  WHERE p.PreguntaId = ?  ";
$sSQL .= " order by p.EstadoId DESC,g.GrupoBreve , p.PreguntaBreve ";
$iPreguntaId=$iId;

if ($stmt = mysqli_prepare($link, $sSQL))
  {
	mysqli_stmt_bind_param($stmt,'i',$iId);
  	 	  mysqli_stmt_execute($stmt);
		  mysqli_stmt_bind_result($stmt,  $sGrupoBreve, $sGrupo,  $iEstadoId,$iOrden, $sPreguntaBreve, $sInstruccion, $sPregunta, $sRespuesta01, $iValor01, $sRespuesta02, $iValor02 , $sRespuesta03, $iValor03 , $sRespuesta04, $iValor04 , $sRespuesta05, $iValor05  );
		  while (mysqli_stmt_fetch($stmt)) {
  
		$iCant=1; 
  
	}
	mysqli_stmt_close($stmt);
	
}	 
if($iCant>0) 
	{
?>
	<a class="btn btn-dark btn-circle btn-sm"  href="#" data-toggle="modal" data-target="#verPregunta-<?php echo $iPreguntaId; ?>"><i class="fas fa-search"></i></a>
		 <div class="modal fade" id="verPregunta-<?php echo $iPreguntaId; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content"  style="width:800px;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pregunta</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">x</span>
          </button>
        </div>
        <div class="modal-body">
		<?php echo trim($sInstruccion);?>
		<?php echo $sPregunta;?>
		<strong>
		<blockquote><p><?php echo trim($sRespuesta01);?></p></blockquote>
		<blockquote><p><?php echo trim($sRespuesta02);?></p></blockquote>
		<?php if( trim($sRespuesta03) != '') echo '<blockquote><p>'.trim($sRespuesta03).'</p></blockquote>';?> 
		<?php if( trim($sRespuesta04) != '') echo '<blockquote><p>'.trim($sRespuesta04).'</p></blockquote>';?>  
		<?php if( trim($sRespuesta05) != '') echo '<blockquote><p>'.trim($sRespuesta05).'</p></blockquote>';?>   
		</strong>
		</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">.:: OK ::.</button> 
        </div>
      </div>
    </div>
  </div>
<?php
	}
else {
	echo '<a href="#" id="VerPregunta" name="VerPregunta" style="color:#666666">Seleccione una Pregunta</a>';
	}
require "./inc/desconectar.php";
?>