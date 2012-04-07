<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<?php
//con esta funcion se autocargan todas las clases si no han sido incluido
function __autoload($class_name) {
    require_once $class_name . '.php';
}
?> 
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php        
        $oPdo2=SPDO2::getInstancia();
/*
 * El auto conmit viene por defecto activado en el POO ya que algunas BD no soportan las transacciones
 */        
        $oPdo2->pdo->beginTransaction();
/*Esto es solo una prueba, recuerdo que para ejecutar consultas y que la clase POO optimice y evite la inyeccion de SQL debemos usar el metodo PREPARE  y no QUERY.
*/
        $oPdo2->pdo->query('insert into usuarios(nombre) values("jonathan5")');
	$oPdo2->pdo->commit();
        $u=new SPDO2();
        ?>
    </body>
</html>
