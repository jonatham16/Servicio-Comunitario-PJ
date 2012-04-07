<?php

require_once ("SPDO2.php");


function listadoSacerdotes(){
    	
        $oPdo=SPDO2::getInstancia();
        $consulta=$oPdo->pdo->prepare("select * from sacerdote WHERE activo=1");
    	$consulta->execute() or die("Error Buscando los sacerdotes");
        return $consulta->fetchAll();    
} 
function listadoResponsabilidad(){
    	
        $oPdo=SPDO2::getInstancia();
        $consulta=$oPdo->pdo->prepare("select * from responsabilidad WHERE activo=1");
    	$consulta->execute() or die("Error Buscando las Responsabilidades");
        return $consulta->fetchAll();    
} 

function listadoEstadoCivil(){
    	
        $oPdo=SPDO2::getInstancia();
        $consulta=$oPdo->pdo->prepare("select * from estadocivil WHERE activo=1");
    	$consulta->execute() or die("Error Buscando los estados civiles");
        return $consulta->fetchAll();    
}
function listadoVicaria(){
    	
        $oPdo=SPDO2::getInstancia();
        $consulta=$oPdo->pdo->prepare("select * from vicaria WHERE activo=1");
    	$consulta->execute() or die("Error Buscando las vicarias");
        return $consulta->fetchAll();    
}

function listadoParroquia(){
    	
        $oPdo=SPDO2::getInstancia();
        $consulta=$oPdo->pdo->prepare("select * from parroquia WHERE activo=1");
    	$consulta->execute() or die("Error Buscando las parroquias");
        return $consulta->fetchAll();    
}

?>
