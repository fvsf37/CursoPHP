<?php

    class Coche{
        private int $ruedas;
        private string $color;
        private int $motor;

    public function __construct(){
        $this -> ruedas = 4;
        $this -> color = "";
        $this -> motor = 1600;
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

    function getRuedas(){
         echo $this -> ruedas . "<br>";
    }
    function getMotor(){
        echo $this -> motor . "<br>";
   }

   function establece_color($color_coche){
        $this -> color = $color_coche;
        echo "El color de este vehículo es: " . $this -> color . "<br>";
   }
}

    class Camion extends Coche{
        public function __construct(){
            $this -> ruedas = 8;
            $this -> color = "";
            $this -> motor = 6600;
        }
        
        function descargar(){
            echo "Descargando camion<br>";
        }
}

?>