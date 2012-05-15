<?php	
	require_once ("../../lib/SPDO2.php");
	$oPdo=SPDO2::getInstancia();

	$id= $_REQUEST['id'];
	$nombre= $_REQUEST['nombre'];
	$descripcion= $_REQUEST['descripcion'];
	$modificar = "UPDATE privilegio
				SET 
				nombre = :nombre, 
				descripcion = :descripcion
				WHERE pvo_id = :id";
	$consulta=$oPdo->pdo->prepare($modificar);
	$consulta->bindParam(':id', $id);
	$consulta->bindParam(':nombre', $nombre);
	$consulta->bindParam(':descripcion', $descripcion);
//Investigar el manejo de errores exepciones
	$consulta->execute() or die("Error modificando el privilegio");		
	echo json_encode("Privilegio modificada con Exito!!!");
?>
