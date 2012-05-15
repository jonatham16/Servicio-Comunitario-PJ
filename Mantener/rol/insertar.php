<?php	
	function __autoload($class_name) {
		require_once $class_name . '.php';
	}
	require_once ("../../lib/SPDO2.php");
	$oPdo=SPDO2::getInstancia();
	
	 
//estos resquest hay q cambairlos xq si no si nos envian por get un parametro trae problemas de seguridad	

	$nombre= $_REQUEST['nombre'];
	$descripcion= $_REQUEST['descripcion'];
	$insertar = "INSERT INTO 
				rol(rol_id, nombre, descripcion, activo) 
				VALUES (null, :nombre, :descripcion, 1)";	
	$consulta=$oPdo->pdo->prepare($insertar);
	$consulta->bindParam(':nombre', $nombre);
	$consulta->bindParam(':descripcion', $descripcion);
//Investigar el manejo de errores exepciones
	$consulta->execute() or die("Error insertando rol");
	echo json_encode("Rol registrado con Exito");
?>
