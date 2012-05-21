<?php	
	function __autoload($class_name) {
		require_once $class_name . '.php';
	}
	require_once ("../../lib/SPDO2.php");
	$oPdo=SPDO2::getInstancia();
	
	 
//estos resquest hay q cambairlos xq si no si nos envian por get un parametro trae problemas de seguridad	

	$nombre= $_REQUEST['nombre'];
	$telefono= $_REQUEST['telefono'];
	$selectparroquia= $_REQUEST['selectparroquia'];
	$fecha= $_REQUEST['fecha'];
	$lema= $_REQUEST['lema'];
	$insertar = "INSERT INTO grupojuvenil(`gjuv_id`, `pqa_id`, `lema`, `fecha_fundacion`, `grupo_juvenil`, `telefono`, `nombre`, `activo`) 
				VALUES 
				(NULL, :selectparroquia, :lema, :fecha, '1', :telefono, :nombre, '1')";	
	$consulta=$oPdo->pdo->prepare($insertar);
	$consulta->bindParam(':nombre', $nombre);
	$consulta->bindParam(':telefono', $telefono);
	$consulta->bindParam(':selectparroquia', $selectparroquia);
	$consulta->bindParam(':fecha', $fecha);
	$consulta->bindParam(':lema', $lema);
//Investigar el manejo de errores exepciones
	$consulta->execute() or die("Error al registrar un nuevo grupo juvenil");
//'04\/10\/2012'"
	echo json_encode("Grupo juvenil registrado con Exito ".$fecha);
?>
