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

    $db_host = "localhost";
    $db_nombre = "cesurdb";
    $db_usuario = "root";
    $db_contra = "";

    //REALIZAMOS LA CONEXION
    $conexion = mysqli_connect($db_host, $db_usuario, $db_contra);

    //ESTA FUNCION SE EJECUTA SI NO TIENE EXITO LA CONEXION CON LA BASE DE DATOS
    if (mysqli_connect_errno()) {
        echo "Fallo al conectar con la base de datos";
        //SI HAY FALLO LE DECIMOS QUE SALGA PARA QUE NO SIGA EJECUTANDO CÓDIGO PHP Y SALGAN MÁS ERRORES
        exit();
    }

    // Quitamos de $conexion el nombre de la base de datos para controlarlo por aquí
    mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la base de datos");

    //PARA INDICAR QUE QUEREMOS UTILIZAR EL JUEGO DE CARACTERES UTF-8
    mysqli_set_charset($conexion, "utf8");

    //CREAMOS LA CONSULTA
    $consulta = "SELECT * FROM productos";

    //GUARDAMOS EN UNA TABLA VIRTUAL EL RESULSET O RECORDSET
    $resultados = mysqli_query($conexion, $consulta);

    //RECORREMOS FILA A FILA DICHA TABLA, DICHO RESULSET
    while ($fila = mysqli_fetch_array($resultados, MYSQLI_ASSOC)) {
        // mysqli_fetch_array necesita dos parámetros, por un lado el resulset y por otro lado una CONSTANTE que es MYSQL_ASSOC
        echo "<table><tr><td>";
        echo $fila['codigo'] . "</td><td>";
        echo $fila['descripcion'] . "</td><td>";
        echo $fila['precioVenta'] . "</td><td>";
        echo $fila['precioCompra'] . "</td><td>";
        echo $fila['existencias'] . "</td><tr></table>";
        echo "<br>";
    }

    //FINALMENTE CERRAMOS LA CONEXION
    
    mysqli_close($conexion);

    ?>

</body>

</html>