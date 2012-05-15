<?php	
	require_once ("../../lib/SPDO2.php");
	$oPdo=SPDO2::getInstancia();

	$id= $_REQUEST['id'];
	$nombre= $_REQUEST['nombre'];
	$modificar = "UPDATE profesion
				SET 
				descripcion = :nombre
				WHERE pfo_id = :id";
	$consulta=$oPdo->pdo->prepare($modificar);
	$consulta->bindParam(':id', $id);
	$consulta->bindParam(':nombre', $nombre);
//Investigar el manejo de errores exepciones
	$consulta->execute() or die("Error modificando la Profesion");		
	echo json_encode("Profesion modificada con Exito!!!");
?>
