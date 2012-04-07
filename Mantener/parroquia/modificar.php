<?php	
	require_once ("../../lib/SPDO2.php");
	$oPdo=SPDO2::getInstancia();

	$id= $_REQUEST['id'];
	$nombre= $_REQUEST['nombre'];
	$telefono= $_REQUEST['telefono'];
	$correo= $_REQUEST['correo'];


	$modificar = "UPDATE parroquia
				SET 
				nombre = :nombre, 
				telefono = :telefono,
				correo = :correo
				WHERE pqa_id =:id";
	$consulta=$oPdo->pdo->prepare($modificar);
	$consulta->bindParam(':id', $id);
	$consulta->bindParam(':nombre', $nombre);
	$consulta->bindParam(':telefono', $telefono);
	$consulta->bindParam(':correo', $correo);
//Investigar el manejo de errores exepciones
	$consulta->execute() or die("Error al modificar la parroquia");		
	echo json_encode("Parroquia modificada con Exito!!!");
?>
