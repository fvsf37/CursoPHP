<?php
$productos = [
    [
        "id" => 1,
        "codigo" => "s1024",
        "descripcion" => "Mermelada de fresas",
        "precioVenta" => 2.35,
        "precioCompra" => 2.09,
        "existencias" => 77
    ],
    [
        "id" => 2,
        "codigo" => "p0703",
        "descripcion" => "Aceite de Oliva",
        "precioVenta" => 6.75,
        "precioCompra" => 5.98,
        "existencias" => 17
    ],
    [
        "id" => 3,
        "codigo" => "f5941",
        "descripcion" => "Palomitas de maíz",
        "precioVenta" => 0.78,
        "precioCompra" => 0.41,
        "existencias" => 48
    ]
];

$existencias_minimas = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $existencias_minimas = $_POST['existencias'];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <!-- Llamada al archivo CSS externo -->
    <link rel="stylesheet" href="estilos.css" />
</head>

<body>

    <header>
        <h1>Gestión de Productos</h1>
    </header>

    <form method="post" class="formulario">
        <label for="existencias">Introduce un número para filtrar por existencias:</label>
        <input type="number" id="existencias" name="existencias" required>
        <button type="submit" class="boton">Filtrar</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<h2>Resultado de productos mostrados con existencia mayor a las unidades introducidas anteriormente</h2>";

        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Precio Venta</th>
                    <th>Precio Compra</th>
                    <th>Existencias</th>
                </tr>";

        foreach ($productos as $producto) {
            if ($producto['existencias'] > $existencias_minimas) {
                echo "<tr>";
                echo "<td>{$producto['id']}</td>";
                echo "<td>{$producto['codigo']}</td>";
                echo "<td>{$producto['descripcion']}</td>";
                echo "<td>{$producto['precioVenta']}</td>";
                echo "<td>{$producto['precioCompra']}</td>";
                echo "<td>{$producto['existencias']}</td>";
                echo "</tr>";
            }
        }

        echo "</table>";
    }
    ?>

</body>

</html>