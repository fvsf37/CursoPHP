<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #1e1e1e;
            color: #fff;
        }

        .calculator {
            width: 400px;
            background: #2d2d2d;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }

        .calculator-display {
            width: 100%;
            height: 60px;
            margin-bottom: 20px;
            font-size: 2rem;
            text-align: right;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
            box-sizing: border-box;
        }

        .calculator-buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .calculator-button {
            height: 60px;
            font-size: 1.2rem;
            border: none;
            border-radius: 5px;
            background: #444;
            color: white;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .calculator-button:active {
            background: #666;
        }

        .calculator-button.operation {
            background: #f57c00;
        }

        .calculator-button.equals {
            background: #4caf50;
        }

        .calculator-button.clear {
            background: #d32f2f;
        }

        .calculator-button.special {
            background: #555;
        }
    </style>
</head>

<body>
    <div class="calculator">
        <form id="calcForm" action="<?= base_url('calculator/calculate') ?>" method="post">
            <!-- Pantalla de la calculadora -->
            <input type="text" id="display" name="display" class="calculator-display" readonly
                value="<?= isset($result) ? htmlspecialchars($result) : '' ?>">
            <input type="hidden" id="operation" name="operation">

            <!-- Botones de la calculadora -->
            <div class="calculator-buttons">
                <button type="button" class="calculator-button special" onclick="setOperation('%')">%</button>
                <button type="button" class="calculator-button clear" onclick="clearEntry()">CE</button>
                <button type="button" class="calculator-button clear" onclick="clearDisplay()">C</button>
                <button type="button" class="calculator-button special" onclick="backspace()">⌫</button>

                <button type="button" class="calculator-button special" onclick="setOperation('1/x')">1/x</button>
                <button type="button" class="calculator-button special" onclick="setOperation('x^2')">x²</button>
                <button type="button" class="calculator-button special" onclick="setOperation('sqrt')">√</button>
                <button type="button" class="calculator-button operation" onclick="appendOperation('/')">÷</button>

                <button type="button" class="calculator-button" onclick="appendNumber(7)">7</button>
                <button type="button" class="calculator-button" onclick="appendNumber(8)">8</button>
                <button type="button" class="calculator-button" onclick="appendNumber(9)">9</button>
                <button type="button" class="calculator-button operation" onclick="appendOperation('*')">×</button>

                <button type="button" class="calculator-button" onclick="appendNumber(4)">4</button>
                <button type="button" class="calculator-button" onclick="appendNumber(5)">5</button>
                <button type="button" class="calculator-button" onclick="appendNumber(6)">6</button>
                <button type="button" class="calculator-button operation" onclick="appendOperation('-')">−</button>

                <button type="button" class="calculator-button" onclick="appendNumber(1)">1</button>
                <button type="button" class="calculator-button" onclick="appendNumber(2)">2</button>
                <button type="button" class="calculator-button" onclick="appendNumber(3)">3</button>
                <button type="button" class="calculator-button operation" onclick="appendOperation('+')">+</button>

                <button type="button" class="calculator-button special" onclick="toggleSign()">+/-</button>
                <button type="button" class="calculator-button" onclick="appendNumber(0)">0</button>
                <button type="button" class="calculator-button" onclick="appendDecimal()">.</button>
                <button type="submit" class="calculator-button equals">=</button>
            </div>
        </form>
    </div>
    <!-- Enlace al archivo JavaScript externo -->
    <script src="<?= base_url('js/calculator.js') ?>"></script>
</body>

</html>