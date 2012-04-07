<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SPDO2
 *
 * @author jonathan
 */
class SPDO2 {
    private static $singleInstancia=null;
    public $pdo;
    private $driver;
    private $host;
    private $nombreBD;
    private $usuario;
    private $clave;
    private function __construct() {
        require_once ("config.php");
/*
	$driver='mysql';
	$host='localhost';
	$nombreBD='SC2';
	$usuario='root';
	$clave='';
*/
        $this->driver= $driver;
        $this->host=$host;
        $this->nombreBD=$nombreBD;
        $this->usuario=$usuario;
        $this->clave=$clave;
        $this->pdo=new PDO($driver.':host=' . $host . ';dbname=' . $nombreBD,
                        $usuario,$clave);
   /* parent::__construct($driver.':host=' . $host . ';dbname=' . $nombreBD,
                        $usuario,$clave);
*/
        
    }
    public static function getInstancia(){
        if (!self::$singleInstancia) {
            self::$singleInstancia=new self();
        }
        return self::$singleInstancia;
        
    }
    public function metodo(){
        
        var_dump(self::$singleInstancia);
        
    }
    private function __clone(){ }
}

?>
