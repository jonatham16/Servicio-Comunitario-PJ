<?php	
	require_once ("../../lib/SPDO2.php");
	$oPdo=SPDO2::getInstancia();
	$id= $_REQUEST['id'];
	$eliminar = "UPDATE estadocivil
				SET 
				activo = 0
				WHERE edo_id = :id";
	$consulta=$oPdo->pdo->prepare($eliminar);
	$consulta->bindParam(':id', $id);			
//Investigar el manejo de errores exepciones
	$consulta->execute() or die("Error eliminado estado civil");
	echo json_encode("Estado civil eliminado con Exito");	



?>
