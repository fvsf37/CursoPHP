<?php
    class Coche{

    private $ruedas;
    private $color;
    private $motor;

    public function __construct(){
        $this->ruedas=4;
        $this->color="rojo";
        $this->motor=1600;
    }
    function arrancar(){
        echo "Estoy arrancando<br>";
    }
    function girar(){
        echo "Estoy girando<br>";
    }
    function frenar(){
        echo "Estoy frenando<br>";
    }
    function getruedas(){
        echo $this->ruedas;
    }
    function setruedas($num){
        $this->ruedas=$num;
    }
    }

$renault=new Coche();
$mazda=new Coche();
$seat=new Coche();

$mazda-> arrancar();
$mazda-> girar();
$mazda-> frenar();
 

//echo $mazda->ruedas;
//echo $mazda->motor;
$renault->getruedas();
echo"<br>";
$renault->setruedas(6);
$renault->getruedas();
?>