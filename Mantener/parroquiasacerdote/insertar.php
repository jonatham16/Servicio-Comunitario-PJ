<?php	
	function __autoload($class_name) {
		require_once $class_name . '.php';
	}
	require_once ("../../lib/SPDO2.php");
	$oPdo=SPDO2::getInstancia();
	
	 
//estos resquest hay q cambairlos xq si no si nos envian por get un parametro trae problemas de seguridad	


	$idsar=$_REQUEST['selectsacerdote'];
	$idpar= $_REQUEST['selectparro'];
	$fechainic= $_REQUEST['fechaini'];
	$fechafinn= $_REQUEST['fechafin'];
	$insertar = "INSERT INTO 
				parroquia_sacerdote(pqa_id,sce_id,fecha_ini, fecha_fin,activo) 
				VALUES (:idp, :ids, :fechai, :fechaf, 1)";	
	$consulta=$oPdo->pdo->prepare($insertar);
	$consulta->bindParam(':ids',$idsar);
	$consulta->bindParam(':idp', $idpar);
	$consulta->bindParam(':fechai', $fechainic);
	$consulta->bindParam(':fechaf', $fechafinn);
//Investigar el manejo de errores exepciones
	$consulta->execute() or die("Error al Asignar Parroquia");
	echo json_encode("Parroquia asignada  con Exito");
?>
