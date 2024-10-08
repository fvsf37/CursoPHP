<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero1 = $_POST['numero1'];
    $numero2 = isset($_POST['numero2']) ? $_POST['numero2'] : null;
    $operacion = $_POST['operacion'];

    // Función que realiza las operaciones matemáticas
    function calculadora($operacion, $a, $b = null)
    {
        switch ($operacion) {
            case 'suma':
                return suma($a, $b);
            case 'resta':
                return resta($a, $b);
            case 'multiplicacion':
                return multiplicacion($a, $b);
            case 'division':
                return division($a, $b);
            case 'modulo':
                return modulo($a, $b);
            case 'potencia':
                return potencia($a, $b);
            case 'factorial':
                return factorial($a);
            case 'aleatorio':
                return numeroAleatorio($a, $b);
            default:
                return "Operación no válida.";
        }
    }

    // Funciones para cada operación
    function suma($a, $b)
    {
        return $a + $b;
    }

    function resta($a, $b)
    {
        return $a - $b;
    }

    function multiplicacion($a, $b)
    {
        return $a * $b;
    }

    function division($a, $b)
    {
        if ($b == 0) {
            return "Error: División por cero no permitida.";
        } else {
            return $a / $b;
        }
    }

    function modulo($a, $b)
    {
        if ($b == 0) {
            return "Error: División por cero no permitida.";
        } else {
            return $a % $b;
        }
    }

    function potencia($a, $b)
    {
        return pow($a, $b);
    }

    function factorial($n)
    {
        if ($n < 0) {
            return "Error: No se puede calcular el factorial de un número negativo.";
        }
        $factorial = 1;
        for ($i = $n; $i > 1; $i--) {
            $factorial *= $i;
        }
        return $factorial;
    }

    function numeroAleatorio($min, $max)
    {
        return rand($min, $max);
    }

    // Llamar a la calculadora
    $resultado = calculadora($operacion, $numero1, $numero2);

    // Mostrar el resultado
    echo "<h2>Resultado: $resultado</h2>";
}
?>