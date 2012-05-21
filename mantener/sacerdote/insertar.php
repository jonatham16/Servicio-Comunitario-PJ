<?php	
	function __autoload($class_name) {
		require_once $class_name . '.php';
	}
	require_once ("../../lib/SPDO2.php");
	$oPdo=SPDO2::getInstancia();
	
	 
//estos resquest hay q cambairlos xq si no si nos envian por get un parametro trae problemas de seguridad	

	$nombre= $_REQUEST['nombre'];
	$apellido= $_REQUEST['apellido'];
	$cedula= $_REQUEST['cedula'];
	$correo= $_REQUEST['correo'];
	$insertar = "INSERT INTO 
				sacerdote(sce_id, nombre, apellido, cedula, correo, activo) 
				VALUES (null, :nombre, :apellido, :cedula, :correo, 1)";	
	$consulta=$oPdo->pdo->prepare($insertar);
	$consulta->bindParam(':nombre', $nombre);
	$consulta->bindParam(':apellido', $apellido);
	$consulta->bindParam(':cedula', $cedula);
	$consulta->bindParam(':correo', $correo);
//Investigar el manejo de errores exepciones
	$consulta->execute() or die("errorrrrrrrrr");
	echo json_encode("Sacerdote Registrado con Exito");
?>
