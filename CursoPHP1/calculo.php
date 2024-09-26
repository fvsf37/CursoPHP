<style>
    body {
     display: flex;
     align-items: center;
     justify-content: center;
     margin: 0 auto;
     height: 100vh;
     background-color: #f1f1f1;
   }

input {
     display: flex;
     align-items: center;
     justify-content: center;
     margin: 0 auto;
   }
</style>

<?php
if (isset($_POST["boton"])) {
    $num1 = $_POST["caja1"];
    $num2 = $_POST["caja2"];
    $operacion = $_POST["operacion"];

    function suma($num1, $num2){
        echo "El resultado es:  " . ($num1 + $num2);
    }

    function resta($num1, $num2){
        echo "El resultado es:  " . ($num1 - $num2);
    }

    function multiplicacion($num1, $num2){
        echo "El resultado es:  " . ($num1 * $num2);
    }

    function division($num1, $num2){
        echo "El resultado es:  " . ($num1 / $num2);
    }

    function modulo($num1, $num2){
        echo "El resultado es:  " . ($num1 % $num2);
    }
    
    function calcular($num1, $num2, $operacion){
        if (!strcmp("suma", $operacion)){

            suma($num1, $num2);

        }

        if (!strcmp("resta", $operacion)){

            resta($num1, $num2);

        }

        if (!strcmp("multiplicacion", $operacion)){

            multiplicacion($num1, $num2);

        }

        if (!strcmp("division", $operacion)){

            division($num1, $num2);

        }

        if (!strcmp("modulo", $operacion)){

            modulo($num1, $num2);

        }
    }
    calcular($num1, $num2, $operacion);
}

?>