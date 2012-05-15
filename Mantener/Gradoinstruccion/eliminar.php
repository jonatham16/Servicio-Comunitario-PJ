<?php	
	require_once ("../../lib/SPDO2.php");
	$oPdo=SPDO2::getInstancia();
	$id= $_REQUEST['id'];
	$eliminar = "UPDATE grado_instruccion 
				SET 
				activo = 0
				WHERE gdo_ins_id = :id";
	$consulta=$oPdo->pdo->prepare($eliminar);
	$consulta->bindParam(':id', $id);			
//Investigar el manejo de errores exepciones
	$consulta->execute() or die("Error eliminado Grado de Instruccion");
	echo json_encode("Grado de Instruccion eliminado con Exito");	



?>
