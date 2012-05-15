<?php	
	function __autoload($class_name) {
		require_once $class_name . '.php';
	}
	require_once ("../../lib/SPDO2.php");
	$oPdo=SPDO2::getInstancia();
	
	 
//estos resquest hay q cambairlos xq si no si nos envian por get un parametro trae problemas de seguridad	

	$rol= $_REQUEST['sel_rol'];
	$pri= $_REQUEST['sel_privilegio'];
	echo $pri;
	$insertar = "INSERT INTO 
				rol_privilegio(pvo_id, rol_id, activo) 
				VALUES ( :s_rol, :s_privilegio, 1)";	
	$consulta=$oPdo->pdo->prepare($insertar);
	$consulta->bindParam(':s_rol', $rol);
	$consulta->bindParam(':s_privilegio', $pri);
	
	$actualizar=" UPDATE rol_privilegio set activo = 1 WHERE rol_id = :s_rol and pvo_id = :s_privilegio";
	$actualizar=$oPdo->pdo->prepare($actualizar);
	$actualizar->bindParam(':s_rol', $rol);
	$actualizar->bindParam(':s_privilegio', $pri);

//Investigar el manejo de errores exepciones
	$consulta->execute() or $actualizar->execute() or die("algo paso."); 
	echo json_encode("relacion rol-privilegio registrada con Exito");
?>
