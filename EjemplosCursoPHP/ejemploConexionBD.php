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

    // Definir las credenciales para la conexión a la base de datos
    $db_host = "localhost";    // Nombre del host, en este caso localhost (servidor local)
    $db_nombre = "cesurdb";    // Nombre de la base de datos
    $db_usuario = "root";      // Usuario de la base de datos, en este caso 'root'
    $db_contra = "";           // Contraseña del usuario de la base de datos (vacía en este caso)
    
    // REALIZAR LA CONEXIÓN
    $conexion = mysqli_connect($db_host, $db_usuario, $db_contra);

    // Verificar si la conexión fue exitosa
    if (mysqli_connect_errno()) {
        // Si hay un error en la conexión, mostramos un mensaje y detenemos la ejecución
        echo "Fallo al conectar con la base de datos";
        exit(); // Salir del script para evitar más errores
    }

    // Seleccionar la base de datos para trabajar
    mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la base de datos");

    // Establecer el juego de caracteres a UTF-8 para manejar correctamente caracteres especiales
    mysqli_set_charset($conexion, "utf8");

    // CREAR LA CONSULTA
    // Aquí se seleccionan todos los registros de la tabla 'productos'
    $consulta = "SELECT * FROM productos";

    // Ejecutar la consulta y almacenar el resultado en la variable $resultados
    $resultados = mysqli_query($conexion, $consulta);

    // RECORRER FILA POR FILA EL RESULTADO (RESULSET)
    // Utilizamos un bucle while para recorrer cada fila del conjunto de resultados
    while ($fila = mysqli_fetch_array($resultados, MYSQLI_ASSOC)) {
        // mysqli_fetch_array devuelve cada fila como un array asociativo (MYSQLI_ASSOC)
        // Mostrar los valores de las columnas de cada fila en una tabla HTML
        echo "<table><tr><td>";
        echo $fila['codigo'] . "</td><td>";         // Mostrar el valor de la columna 'codigo'
        echo $fila['descripcion'] . "</td><td>";   // Mostrar el valor de la columna 'descripcion'
        echo $fila['precioVenta'] . "</td><td>";   // Mostrar el valor de la columna 'precioVenta'
        echo $fila['precioCompra'] . "</td><td>";  // Mostrar el valor de la columna 'precioCompra'
        echo $fila['existencias'] . "</td><tr></table>"; // Mostrar el valor de la columna 'existencias'
        echo "<br>"; // Añadir un salto de línea entre tablas
    }

    // CERRAR LA CONEXIÓN
    // Una vez que hemos terminado de procesar los datos, cerramos la conexión a la base de datos
    mysqli_close($conexion);

    ?>

</body>

</html>