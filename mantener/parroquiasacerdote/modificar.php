<?php	
	require_once ("../../lib/SPDO2.php");
	$oPdo=SPDO2::getInstancia();	
	$orig = explode('_',$_REQUEST['orig']);	
	$des  = explode('_',$_REQUEST['dest']);	
	$fecha_1= $_REQUEST['inicio'];
	$fecha_2= $_REQUEST['fin'];
	$modificar = "UPDATE parroquia_sacerdote
				SET pqa_id = :d_pqa, sce_id = :d_sce,fecha_ini = :inic,fecha_fin = :find
				WHERE pqa_id=:o_pqa and sce_id=:o_sce ";				
	$consulta=$oPdo->pdo->prepare($modificar);	
	$consulta->bindParam(':o_pqa', $orig[0]);
	$consulta->bindParam(':o_sce', $orig[1]);
	$consulta->bindParam(':d_pqa', $des[0]);
	$consulta->bindParam(':d_sce', $des[1]);
	$consulta->bindParam(':inic', $fecha_1);
	$consulta->bindParam(':find', $fecha_2);
//Investigar el manejo de errores exepciones
	$consulta->execute() or die("Error modificando la Asignacion");		
	echo json_encode("Asignacion modificada con Exito");
?>
