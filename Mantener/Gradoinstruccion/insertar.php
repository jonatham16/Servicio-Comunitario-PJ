<?php	
	function __autoload($class_name) {
		require_once $class_name . '.php';
	}
	require_once ("../../lib/SPDO2.php");
	$oPdo=SPDO2::getInstancia();
	
	 
//estos resquest hay q cambairlos xq si no si nos envian por get un parametro trae problemas de seguridad	

	$nombre= $_REQUEST['nombre'];
	$insertar = "INSERT INTO 
				grado_instruccion(gdo_ins_id,descripcion, activo) 
				VALUES (null, :nombre, 1)";	
	$consulta=$oPdo->pdo->prepare($insertar);
	$consulta->bindParam(':nombre', $nombre);
//Investigar el manejo de errores exepciones
	$consulta->execute() or die("Error insertando grado de instruccion");
	echo json_encode("grado de instruccion registrado con Exito");
?>
