<?php	
	require_once ("../../lib/SPDO2.php");
	$oPdo=SPDO2::getInstancia();

	$id= $_REQUEST['id'];
	$nombre= $_REQUEST['nombre'];
	$descripcion= $_REQUEST['descripcion'];
	$modificar = "UPDATE responsabilidad
				SET 
				nombre = :nombre, 
				descripcion = :descripcion
				WHERE resp_id = :id";
	$consulta=$oPdo->pdo->prepare($modificar);
	$consulta->bindParam(':id', $id);
	$consulta->bindParam(':nombre', $nombre);
	$consulta->bindParam(':descripcion', $descripcion);
//Investigar el manejo de errores exepciones
	$consulta->execute() or die("Error modificando la responsabilidad");		
	echo json_encode("Responsabilidad modificada con Exito!!!");
?>
