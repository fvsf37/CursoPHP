<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero1 = $_POST['numero1'];
    $numero2 = isset($_POST['numero2']) ? $_POST['numero2'] : null;
    $operacion = $_POST['operacion'];
    $mensaje = '';
    $tipo_mensaje = '';

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
            return "Error: No se puede dividir por cero.";
        }
        return $a / $b;
    }

    function modulo($a, $b)
    {
        if ($b == 0) {
            return "Error: No se puede calcular el módulo con cero.";
        }
        return $a % $b;
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

    $resultado = calculadora($operacion, $numero1, $numero2);

    if (is_numeric($resultado)) {
        $mensaje = "Resultado: $resultado";
        $tipo_mensaje = "exito";
    } else {
        $mensaje = $resultado; // En caso de error
        $tipo_mensaje = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Calculadora en PHP</title>
    <!-- Llamada al archivo de estilos -->
    <link rel="stylesheet" href="estilos.css" />
</head>

<body>
    <header>
        <h1>Calculadora</h1>
    </header>

    <!-- Mensaje de éxito o error -->
    <?php if (!empty($mensaje)): ?>
        <div class="alert <?php echo $tipo_mensaje; ?>">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="" class="formulario">
        <label for="numero1">Número 1:</label>
        <input type="number" id="numero1" name="numero1" required /><br /><br />

        <label for="numero2">Número 2:</label>
        <input type="number" id="numero2" name="numero2" /><br /><br />

        <label for="operacion">Operación:</label>
        <select name="operacion" id="operacion">
            <option value="suma">Suma</option>
            <option value="resta">Resta</option>
            <option value="multiplicacion">Multiplicación</option>
            <option value="division">División</option>
            <option value="modulo">Módulo</option>
            <option value="potencia">Potencia</option>
            <option value="factorial">Factorial (Solo número 1)</option>
            <option value="aleatorio">
                Número Aleatorio (entre Número 1 y Número 2)
            </option>
        </select><br /><br />

        <input type="submit" value="Calcular" class="boton" />
    </form>

    <!-- Script para ocultar el mensaje después de 3 segundos -->
    <script>
        window.onload = function () {
            const alertBox = document.querySelector('.alert');
            if (alertBox) {
                alertBox.style.display = 'block'; // Mostramos el mensaje
                setTimeout(function () {
                    alertBox.style.display = 'none'; // Ocultamos después de 3 segundos
                }, 3000);
            }
        };
    </script>
</body>

</html>