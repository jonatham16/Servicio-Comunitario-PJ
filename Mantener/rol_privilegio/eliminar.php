<?php	
	require_once ("../../lib/SPDO2.php");
	$oPdo=SPDO2::getInstancia();
	echo "cdlm".$_REQUEST['var'];
	$v = explode('_',$_REQUEST['var']);
	
	
	
	$eliminar = "UPDATE rol_privilegio
				SET 
				activo = 0
				WHERE rol_id = :r_id and pvo_id =:p_id" ;
	$consulta=$oPdo->pdo->prepare($eliminar);
	$consulta->bindParam(':r_id', $v[0]);			
	$consulta->bindParam(':p_id', $v[1]);			
	$consulta->execute() or die("error eliminando la relacion rol-privilegio.");
	echo json_encode("Relacion rol-prigilegio Eliminado con Exito");	
?>
