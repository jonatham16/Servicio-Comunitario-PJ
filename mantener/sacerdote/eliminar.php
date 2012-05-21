<?php	
	require_once ("../../lib/SPDO2.php");
	$oPdo=SPDO2::getInstancia();
	$id= $_REQUEST['id'];
	$eliminar = "UPDATE sacerdote 
				SET 
				activo = 0
			        WHERE sce_id = :id";
	$consulta=$oPdo->pdo->prepare($eliminar);
	$consulta->bindParam(':id', $id);			
//Investigar el manejo de errores exepciones
	$consulta->execute() or die("errorrrrrrrrr");
	echo json_encode("Sacerdote Eliminado con Exito");	



?>
