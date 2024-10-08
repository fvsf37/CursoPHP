<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }
    </style>
</head>

<body>

    <!-- Formulario que envía los datos por POST para filtrar productos según existencias -->
    <form method="post">
        <label for="existencias">Introduce un número (X) para filtrar por existencias:</label>
        <!-- Campo de entrada numérico para el usuario -->
        <input type="number" id="existencias" name="existencias" required>
        <!-- Botón para enviar el formulario -->
        <button type="submit">Filtrar</button>
    </form>

    <?php
    // Verificamos si el formulario ha sido enviado mediante el método POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Mostramos un título con el resultado del filtrado
        echo "<h2>Resultado de productos mostrados con existencia mayor a las unidades introducidas anteriormente</h2>";

        // Creamos la tabla para mostrar los productos
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Precio Venta</th>
                    <th>Precio Compra</th>
                    <th>Existencias</th>
                </tr>";

        // Recorremos el array $productos para mostrar solo los productos con existencias mayores al valor introducido
        foreach ($productos as $producto) {
            // Filtramos los productos que tengan más existencias que el valor ingresado en el formulario
            if ($producto['existencias'] > $existencias_minimas) {
                echo "<tr>";
                // Imprimimos cada atributo del producto en una fila de la tabla
                echo "<td>{$producto['id']}</td>";
                echo "<td>{$producto['codigo']}</td>";
                echo "<td>{$producto['descripcion']}</td>";
                echo "<td>{$producto['precioVenta']}</td>";
                echo "<td>{$producto['precioCompra']}</td>";
                echo "<td>{$producto['existencias']}</td>";
                echo "</tr>";
            }
        }

        // Cerramos la tabla
        echo "</table>";
    }
    ?>

</body>

</html>