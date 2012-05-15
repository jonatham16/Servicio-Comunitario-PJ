<?php

require_once ("SPDO2.php");

//----Funciones de jonathan----------------------------------------
function listadoSacerdotes(){
    	
        $oPdo=SPDO2::getInstancia();// crea un objeto de la clase SPDO2
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
//------------------------------------------------

//----Funciones de Ewin----------------------------------------
function listadoTipo(){
    	
        $oPdo=SPDO2::getInstancia();
        $consulta=$oPdo->pdo->prepare("select * from tipo WHERE activo=1");
    	$consulta->execute() or die("Error Buscando las los tipos");
        return $consulta->fetchAll();    
}
function listadoTarea(){
    	
        $oPdo=SPDO2::getInstancia();
        $consulta=$oPdo->pdo->prepare("select * from tarea WHERE activo=1");
    	$consulta->execute() or die("Error Buscando las tareas");
        return $consulta->fetchAll();    
}
function listadoCategoria_evento(){
    	
        $oPdo=SPDO2::getInstancia();
        $consulta=$oPdo->pdo->prepare("select * from categoria_evento WHERE activo=1");
    	$consulta->execute() or die("Error Buscando las categorias");
        return $consulta->fetchAll();    
}
function listadoGrupojuvenil(){
    	
        $oPdo=SPDO2::getInstancia();
        $consulta=$oPdo->pdo->prepare("select * from grupojuvenil WHERE activo=1");
    	$consulta->execute() or die("Error Buscando las categorias");
        return $consulta->fetchAll();  
  
}
//------------------------------------------------

//----Funciones de dixon
function listadoRol(){
    	
        $oPdo=SPDO2::getInstancia();
        $consulta=$oPdo->pdo->prepare("select * from rol WHERE activo=1");
    	$consulta->execute() or die("Error listando los roles");
        return $consulta->fetchAll();    
} 
function listadoPrivilegio(){
    	
        $oPdo=SPDO2::getInstancia();
        $consulta=$oPdo->pdo->prepare("select * from privilegio");
    	$consulta->execute() or die("Error listando los privilegios");
        return $consulta->fetchAll();    
} 
function listadoRol_Privilegio(){    	
        $oPdo=SPDO2::getInstancia();
        $consulta=$oPdo->pdo->prepare("select rol_privilegio.rol_id, rol.descripcion, rol_privilegio.pvo_id, privilegio.descripcion from rol, privilegio, rol_privilegio WHERE rol.rol_id = rol_privilegio.rol_id and rol_privilegio.pvo_id = privilegio.pvo_id and rol_privilegio.activo=1");
    	$consulta->execute() or die("Error listando las relacionas");
        return $consulta->fetchAll();    
} 

function listadoVicaria_Sacerdote(){    	
        $oPdo=SPDO2::getInstancia();
        $consulta=$oPdo->pdo->prepare("SELECT vica_sace.vca_id, vicaria.nombre, vica_sace.sce_id, sacerdote.nombre, vica_sace.fecha_ini FROM  vica_sace, sacerdote,vicaria where vica_sace.sce_id = sacerdote.sce_id and 	vica_sace.vca_id = vicaria.vca_id and vica_sace.activo=1");
    	$consulta->execute() or die("Error listando las relacionas");
        return $consulta->fetchAll();    
} 
//----------------------------------------------

//----Funciones de Samuel------------------------

function listadoProfesion(){
	$oPdo=SPDO2::getInstancia();
        $consulta=$oPdo->pdo->prepare("select * from profesion WHERE activo=1");
    	$consulta->execute() or die("Error Buscando las Profesiones");
        return $consulta->fetchAll();   
}
function listadoGInstruccion()
{
	$oPdo=SPDO2::getInstancia();
        $consulta=$oPdo->pdo->prepare("select * from grado_instruccion WHERE activo=1");
    	$consulta->execute() or die("Error Buscando los grados de instruccion");
        return $consulta->fetchAll();   
}
function listadodeAreas()
{
	$oPdo=SPDO2::getInstancia();
        $consulta=$oPdo->pdo->prepare("select * from area WHERE activo=1");
    	$consulta->execute() or die("Error Buscando las Areas");
        return $consulta->fetchAll();   
}
function listadoparroquia_sacerdore()
{
	$oPdo=SPDO2::getInstancia();
        $consulta=$oPdo->pdo->prepare("SELECT a.nombre,b.nombre,c.fecha_ini,c.fecha_fin,c.sce_id,c.pqa_id FROM sacerdote as a,parroquia as b,parroquia_sacerdote as c WHERE c.sce_id=a.sce_id AND c.pqa_id=b.pqa_id  AND c.activo=1");
    	$consulta->execute() or die("Error Buscando sacerdotes asignados a parroquias");
        return $consulta->fetchAll();   
}
function listadodeEventos()
{
	$oPdo=SPDO2::getInstancia();
        $consulta=$oPdo->pdo->prepare("select * from evento"); // los eventos deberian tener tambien el campo activo 
    	$consulta->execute() or die("Error Buscando las Areas");
        return $consulta->fetchAll();   
}

//----------------------------------------
?>
