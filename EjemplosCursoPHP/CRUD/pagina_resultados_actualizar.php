<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        table {
            width: 50%;
            border: 1px dotted red;
            margin: auto;
        }
    </style>
</head>

<body>
    <?php
    // Recoger el valor que el usuario ha introducido en el campo de búsqueda del formulario
    $busqueda = $_GET["actualizar"];

    // Incluir el archivo de conexión a la base de datos
    require("datos_conexion.php");

    // Realizar la conexión a la base de datos
    $conexion = mysqli_connect($db_host, $db_usuario, $db_contra);

    // Verificar si la conexión fue exitosa
    if (mysqli_connect_errno()) {
        echo "Fallo al conectar con la base de datos";
        // Si la conexión falla, detener la ejecución
        exit();
    }

    // Seleccionar la base de datos que se va a utilizar
    mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la base de datos");

    // Establecer el juego de caracteres a UTF-8 para manejar correctamente caracteres especiales
    mysqli_set_charset($conexion, "utf8");

    //--------------------------------------------
    // Crear la consulta para buscar productos cuyo nombre coincida con el valor de $busqueda
    $consulta = "SELECT * FROM productos WHERE NOMBREARTICULO LIKE '%$busqueda%'";

    // Ejecutar la consulta y guardar los resultados en la variable $resultados
    $resultados = mysqli_query($conexion, $consulta);

    // Recorrer los resultados devueltos por la consulta y generar un formulario para cada registro
    while ($fila = mysqli_fetch_array($resultados, MYSQLI_ASSOC)) {
        // Crear un formulario para actualizar los datos del producto
        echo "<form action='actualizar.php' method='post'>";
        // Crear campos de texto para cada columna, con los valores precargados del producto actual
        echo "<input type='text' name='c_art' value='" . $fila['CODIGOARTICULO'] . "'><br>";
        echo "<input type='text' name='sec' value='" . $fila['SECCION'] . "'><br>";
        echo "<input type='text' name='n_art' value='" . $fila['NOMBREARTICULO'] . "'><br>";
        echo "<input type='text' name='pre' value='" . $fila['PRECIO'] . "'><br>";
        echo "<input type='text' name='fech' value='" . $fila['FECHA'] . "'><br>";
        echo "<input type='text' name='imp' value='" . $fila['IMPORTADO'] . "'><br>";
        echo "<input type='text' name='porig' value='" . $fila['PAISDEORIGEN'] . "'><br>";
        // Botón para enviar el formulario y actualizar los datos del producto
        echo "<input type='submit' name='env' value='Actualizar!'>";
        echo "</form>";
        echo "<br>";
    }

    // Cerrar la conexión a la base de datos para liberar recursos
    mysqli_close($conexion);

    ?>
</body>

</html>