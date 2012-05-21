<?php	
	function __autoload($class_name) {
		require_once $class_name . '.php';
	}
	require_once ("../../lib/SPDO2.php");
	$oPdo=SPDO2::getInstancia();
	
	 
//estos resquest hay q cambairlos xq si no si nos envian por get un parametro trae problemas de seguridad	

	$nombre= $_REQUEST['nombre'];
	$insertar = "INSERT INTO 
				tipo(tpo_id, nombre, activo) 
				VALUES (null, :nombre, 1)";	
	$consulta=$oPdo->pdo->prepare($insertar);
	$consulta->bindParam(':nombre', $nombre);
//Investigar el manejo de errores exepciones
	$consulta->execute() or die("Error insertando tipo de noticia");
	echo json_encode("Tipo de noticia registrado con Exito");
?>
