<?php	
	require_once ("../../lib/SPDO2.php");
	$oPdo=SPDO2::getInstancia();

	$descripcion= $_REQUEST['descripcion'];
	$nombre= $_REQUEST['nombre'];
	$id= $_REQUEST['id'];

	$modificar = "UPDATE area
				SET 
				nombre = :nombre, 
				descripcion = :descripcion
				WHERE area_id =:id";
	$consulta=$oPdo->pdo->prepare($modificar);
	$consulta->bindParam(':id', $id);
	$consulta->bindParam(':nombre', $nombre);
	$consulta->bindParam(':descripcion', $descripcion);
//Investigar el manejo de errores exepciones
	$consulta->execute() or die("Error al modificar la Area");		
	echo json_encode("Area modificada con Exito!!!");
?>
