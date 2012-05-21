<?php	
	function __autoload($class_name) {
		require_once $class_name . '.php';
	}
	require_once ("../../lib/SPDO2.php");
	$oPdo=SPDO2::getInstancia();
	
	 
	

	$sar= $_REQUEST['sel_sar'];
	$par= $_REQUEST['sel_par'];
	$fein= $_REQUEST['fechaini'];
	$fefi= $_REQUEST['fechafin'];
	$insertar = "INSERT INTO 
				parroquia_sacerdote(pqa_id, sce_id,fecha_ini,fecha_fin, activo) 
				VALUES (:s_par, :s_sar,:s_f1,:s_f2, 1)";	
	$consulta=$oPdo->pdo->prepare($insertar);
	$consulta->bindParam(':s_sar', $sar);
	$consulta->bindParam(':s_par', $par);
	$consulta->bindParam(':s_f1', $fein);
	$consulta->bindParam(':s_f2', $fefi);

	$consulta->execute() or $actualizar->execute() or die("Error en la Asignacion"); 
	echo json_encode("Asignacion realizada  con Exito");
?>
