<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // Crear una nueva instancia de mysqli para conectarse a la base de datos
    $conexion = new mysqli("localhost", "root", "", "pruebas");

    // Verificar si hubo un error en la conexión
    if ($conexion->connect_errno) {
        // Mostrar el número de error si la conexión falla
        echo "Falló la conexión: " . $conexion->connect_errno;
    }

    // Establecer el juego de caracteres a UTF-8 para manejar caracteres especiales
    $conexion->set_charset("utf8");

    // Crear una consulta SQL para seleccionar todos los registros de la tabla "productos"
    $sql = "SELECT * FROM productos";

    // Ejecutar la consulta y almacenar el resultado en la variable $resultados
    $resultados = $conexion->query($sql);

    // Verificar si ocurrió algún error al ejecutar la consulta
    if ($conexion->errno) {
        // Si hay un error, se muestra el mensaje de error y se detiene la ejecución
        die($conexion->error);
    }

    // Recorrer los resultados devueltos por la consulta usando fetch_assoc()
    while ($fila = $resultados->fetch_assoc()) {
        // fetch_assoc() devuelve un array asociativo donde las claves son los nombres de las columnas
        // Se imprimen los valores de cada columna en una tabla HTML
        echo "<table><tr><td>";
        echo $fila['CODIGOARTICULO'] . "</td><td>";  // Mostrar el código del artículo
        echo $fila['SECCION'] . "</td><td>";         // Mostrar la sección
        echo $fila['NOMBREARTICULO'] . "</td><td>";  // Mostrar el nombre del artículo
        echo $fila['PRECIO'] . "</td><td>";          // Mostrar el precio
        echo $fila['FECHA'] . "</td><td>";           // Mostrar la fecha
        echo $fila['IMPORTADO'] . "</td><td>";       // Mostrar si es importado
        echo $fila['PAISDEORIGEN'] . "</td></tr></table>"; // Mostrar el país de origen
    }

    // Alternativa: usar fetch_array() para recorrer el resultset como un array indexado
    /*
    while ($fila = $resultados->fetch_array()) {
        echo "<table><tr><td>";
        echo $fila[0] . "</td><td>";  // Código del artículo (posición 0)
        echo $fila[1] . "</td><td>";  // Sección (posición 1)
        echo $fila[2] . "</td><td>";  // Nombre del artículo (posición 2)
        echo $fila[3] . "</td><td>";  // Precio (posición 3)
        echo $fila[4] . "</td><td>";  // Fecha (posición 4)
        echo $fila[5] . "</td><td>";  // Importado (posición 5)
        echo $fila[6] . "</td></tr></table>";  // País de origen (posición 6)
    }
    */

    // Cerrar la conexión a la base de datos
    $conexion->close();
    ?>
</body>

</html>