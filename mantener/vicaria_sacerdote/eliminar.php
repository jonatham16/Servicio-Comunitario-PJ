<?php	
	require_once ("../../lib/SPDO2.php");
	$oPdo=SPDO2::getInstancia();
	$v = explode('_',$_REQUEST['var']);
	$eliminar = "UPDATE vica_sace
				SET 
				activo = 0
				WHERE sce_id = :sce and vca_id =:vca" ;
	$consulta=$oPdo->pdo->prepare($eliminar);
	$consulta->bindParam(':sce', $v[1]);			
	$consulta->bindParam(':vca', $v[0]);			
	$consulta->execute() or die("error eliminando la relacion vica_sace");
	echo json_encode("Relacion vica_sace Eliminado con Exito");	
?>
