<?php	
	require_once ("../../lib/SPDO2.php");
	$oPdo=SPDO2::getInstancia();	
	$orig = explode('_',$_REQUEST['orig']);	
	$des  = explode('_',$_REQUEST['dest']);	
	
	$modificar = "UPDATE rol_privilegio
				SET rol_id = :d_rol, pvo_id = :d_privilegio
				WHERE rol_id=:o_rol and pvo_id=:o_privilegio ";				
	$consulta=$oPdo->pdo->prepare($modificar);	
	$consulta->bindParam(':o_rol', $orig[0]);
	$consulta->bindParam(':o_privilegio', $orig[1]);
	$consulta->bindParam(':d_rol', $des[0]);
	$consulta->bindParam(':d_privilegio', $des[1]);
//Investigar el manejo de errores exepciones
	$consulta->execute() or die("Error modificando el rol");		
	echo json_encode("Rol modificado con Exito");
?>
