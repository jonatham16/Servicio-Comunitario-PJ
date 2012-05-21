<?php	
	require_once ("../../lib/SPDO2.php");
	$oPdo=SPDO2::getInstancia();
	$id= $_REQUEST['id'];
	$eliminar = "UPDATE grupojuvenil 
				SET 
				activo = 0
			        WHERE gjuv_id = :id";
	$consulta=$oPdo->pdo->prepare($eliminar);
	$consulta->bindParam(':id', $id);			
//Investigar el manejo de errores exepciones
	$consulta->execute() or die("Error al eliminar el grupo juvenil");
	echo json_encode("Grupo juvenil eliminado con exito");	



?>
