<?php	
	function __autoload($class_name) {
		require_once $class_name . '.php';
	}
	require_once ("../../lib/SPDO2.php");
	$oPdo=SPDO2::getInstancia();
	
	 
//estos resquest hay q cambairlos xq si no si nos envian por get un parametro trae problemas de seguridad	

	$vic= $_REQUEST['sel_vica'];
	$sac= $_REQUEST['sel_sace'];
	
	$insertar = "INSERT INTO 
				vica_sace(sce_id, vca_id,fecha_ini, activo) 
				VALUES ( :s_sce, :s_vca, current_date, 1)";	
	$consulta=$oPdo->pdo->prepare($insertar);
	$consulta->bindParam(':s_sce', $sac);
	$consulta->bindParam(':s_vca', $vic);
	
	$actualizar=" UPDATE vica_sace set activo = 1 WHERE sce_id = :s_sce and vca_id = :s_vca";
	$actualizar=$oPdo->pdo->prepare($actualizar);
	$actualizar->bindParam(':s_sce', $sac);
	$actualizar->bindParam(':s_vca', $vic);

//Investigar el manejo de errores exepciones
	$consulta->execute() or $actualizar->execute() or die("algo paso."); 
	echo json_encode("relacion vicaria_sacerdote registrada con Exito");
?>
