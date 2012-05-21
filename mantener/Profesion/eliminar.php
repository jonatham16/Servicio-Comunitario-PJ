<?php	
	require_once ("../../lib/SPDO2.php");
	$oPdo=SPDO2::getInstancia();
	$id= $_REQUEST['id'];
	$eliminar = "UPDATE profesion
				SET 
				activo = 0
				WHERE pfo_id = :id";
	$consulta=$oPdo->pdo->prepare($eliminar);
	$consulta->bindParam(':id', $id);			
//Investigar el manejo de errores exepciones
	$consulta->execute() or die("Error eliminado Profesion");
	echo json_encode("Profesion eliminado con Exito");	



?>
