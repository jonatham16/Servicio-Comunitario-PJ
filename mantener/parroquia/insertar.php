<?php	
	function __autoload($class_name) {
		require_once $class_name . '.php';
	}
	require_once ("../../lib/SPDO2.php");
	$oPdo=SPDO2::getInstancia();
	
	 
//estos resquest hay q cambairlos xq si no si nos envian por get un parametro trae problemas de seguridad	

	$nombre= $_REQUEST['nombre'];
	$telefono= $_REQUEST['telefono'];
	$selectvicaria= $_REQUEST['selectvicaria'];
	$correo= $_REQUEST['correo'];
	$insertar = "INSERT INTO 
				parroquia(pqa_id, telefono, nombre, correo, vca_id, activo) 
				VALUES (null, :telefono, :nombre, :correo, :selectvicaria, 1)";	
	$consulta=$oPdo->pdo->prepare($insertar);
	$consulta->bindParam(':nombre', $nombre);
	$consulta->bindParam(':telefono', $telefono);
	$consulta->bindParam(':selectvicaria', $selectvicaria);
	$consulta->bindParam(':correo', $correo);
//Investigar el manejo de errores exepciones
	$consulta->execute() or die("Error al registrar una nueva parroquia");
	echo json_encode("Parroquia registrada con Exito");
?>
