<?php

namespace App\Controllers;

class Calculator extends BaseController
{
    public function index()
    {
        // Muestra la vista de la calculadora con un resultado vacío inicial
        return view('calculator_form', ['result' => '']);
    }

    public function calculate()
    {
        // Obtiene los datos enviados desde el formulario
        $expression = $this->request->getPost('display'); // Expresión matemática ingresada
        $operation = $this->request->getPost('operation'); // Operación avanzada seleccionada
        $result = null;

        try {
            // Verificar si no se enviaron datos
            if (empty($expression) && empty($operation)) {
                $result = 'No se enviaron datos';
            } elseif ($operation) {
                // Procesar operaciones avanzadas
                $number = floatval($expression); // Convierte la entrada en un número
                switch ($operation) {
                    case '1/x':
                        $result = ($number == 0) ? 'Error: División entre cero' : 1 / $number;
                        break;
                    case 'x^2':
                        $result = $number ** 2;
                        break;
                    case 'sqrt':
                        $result = ($number < 0) ? 'Error: Raíz negativa' : sqrt($number);
                        break;
                    default:
                        $result = 'Operación no válida';
                }
            } else {
                // Procesar expresiones matemáticas básicas
                // Validar que la expresión contiene caracteres válidos
                if (!preg_match('/^[0-9+\-\*\/\(\)\. ]+$/', $expression)) {
                    $result = 'Expresión no válida';
                } else {
                    $result = eval ('return ' . $expression . ';'); // Evaluar la expresión
                }
            }
        } catch (\Throwable $e) {
            // Registrar el error en los logs para depuración
            log_message('error', 'Error en el cálculo: ' . $e->getMessage());
            $result = 'Error en el cálculo';
        }

        // Regresa la vista con el resultado del cálculo
        return view('calculator_form', ['result' => $result]);
    }
}
