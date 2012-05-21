<?php	
	require_once ("../../lib/SPDO2.php");
	$oPdo=SPDO2::getInstancia();

	$id= $_REQUEST['id'];
	$nombre= $_REQUEST['nombre'];
	$modificar = "UPDATE estadocivil
				SET 
				nombre = :nombre
				WHERE edo_id = :id";
	$consulta=$oPdo->pdo->prepare($modificar);
	$consulta->bindParam(':id', $id);
	$consulta->bindParam(':nombre', $nombre);
//Investigar el manejo de errores exepciones
	$consulta->execute() or die("Error modificando el estado civil");		
	echo json_encode("Estado civil modificado con Exito!!!");
?>
