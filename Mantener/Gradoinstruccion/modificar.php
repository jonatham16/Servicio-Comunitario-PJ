<?php	
	require_once ("../../lib/SPDO2.php");
	$oPdo=SPDO2::getInstancia();

	$id= $_REQUEST['id'];
	$nombre= $_REQUEST['nombre'];
	$modificar = "UPDATE grado_instruccion
				SET 
				descripcion = :nombre
				WHERE gdo_ins_id = :id";
	$consulta=$oPdo->pdo->prepare($modificar);
	$consulta->bindParam(':id', $id);
	$consulta->bindParam(':nombre', $nombre);
//Investigar el manejo de errores exepciones
	$consulta->execute() or die("Error modificando el Grado de Instrccion");		
	echo json_encode("Grado de Instruccion modificado con Exito!!!");
?>
