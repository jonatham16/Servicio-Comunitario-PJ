<?php	
	require_once ("../../lib/SPDO2.php");
	$oPdo=SPDO2::getInstancia();
	$v = explode('_',$_REQUEST['var']);	
	$eliminar = "UPDATE parroquia_sacerdote
				SET 
				activo = 0
				WHERE pqa_id = :r_id and sce_id =:p_id" ;
	$consulta=$oPdo->pdo->prepare($eliminar);
	$consulta->bindParam(':r_id', $v[0]);			
	$consulta->bindParam(':p_id', $v[1]);			
	$consulta->execute() or die("error eliminanda la asignacion de parroquia");
	echo json_encode("Asignacion de parroquia Eliminada con Exito");	
?>
