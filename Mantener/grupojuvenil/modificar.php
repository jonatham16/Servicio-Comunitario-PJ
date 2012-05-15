<?php	
	require_once ("../../lib/SPDO2.php");
	$oPdo=SPDO2::getInstancia();

	$id= $_REQUEST['id'];
	$nombre= $_REQUEST['nombre'];
	$telefono= $_REQUEST['telefono'];
	$fecha= $_REQUEST['fecha'];
	$lema= $_REQUEST['lema'];


	$modificar = "UPDATE grupojuvenil
				SET 
				nombre = :nombre, 
				telefono = :telefono,
				fecha_fundacion = :fecha,
				lema = :lema
				WHERE gjuv_id =:id";
	$consulta=$oPdo->pdo->prepare($modificar);
	$consulta->bindParam(':id', $id);
	$consulta->bindParam(':nombre', $nombre);
	$consulta->bindParam(':telefono', $telefono);
	$consulta->bindParam(':fecha', $fecha);
	$consulta->bindParam(':lema', $lema);
//Investigar el manejo de errores exepciones
	$consulta->execute() or die("Error al modificar el grupo Juvenila");		
	echo json_encode("Grupo juvenila modificado con Exito!!!");
?>
