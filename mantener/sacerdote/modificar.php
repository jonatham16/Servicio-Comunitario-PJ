<?php	
	require_once ("../../lib/SPDO2.php");
	$oPdo=SPDO2::getInstancia();

	$id= $_REQUEST['id'];
	$nombre= $_REQUEST['nombre'];
	$apellido= $_REQUEST['apellido'];
	$cedula= $_REQUEST['cedula'];
	$correo= $_REQUEST['correo'];


	$modificar = "UPDATE sacerdote
				SET 
				nombre = :nombre, 
				apellido = :apellido,
				cedula = :cedula,
				correo = :correo
				WHERE sce_id =:id";
	$consulta=$oPdo->pdo->prepare($modificar);
	$consulta->bindParam(':id', $id);
	$consulta->bindParam(':nombre', $nombre);
	$consulta->bindParam(':apellido', $apellido);
	$consulta->bindParam(':cedula', $cedula);
	$consulta->bindParam(':correo', $correo);
//Investigar el manejo de errores exepciones
	$consulta->execute() or die("errorrrrrrrrr");		
	echo json_encode("Sacerdote modificado con Exito!!!");
?>
