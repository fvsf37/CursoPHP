<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            font-size: 24px;
            color: #333;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            table-layout: fixed;
            /* Mantiene el tamaño de las celdas igual */
        }

        th,
        td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            text-align: center;
            /* Centra el texto en la celda */
            overflow: hidden;
            /* Evita que el contenido desborde */
            text-overflow: ellipsis;
            /* Agrega puntos suspensivos si el texto es muy largo */
            white-space: nowrap;
            /* Evita que el texto se envuelva en varias líneas */
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e0f7fa;
        }
    </style>
</head>

<body>
    <?php

    require("datos_conexion.php");

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
    $consulta = "SELECT * FROM productos WHERE NOMBREARTICULO LIKE 'BALON%'";

    //GUARDAMOS EN UNA TABLA VIRTUAL EL RESULSET O RECORDSET
    $resultados = mysqli_query($conexion, $consulta);

    //RECORREMOS FILA A FILA DICHA TABLA, DICHO RESULSET
    //HAY QUE HACERLO DE FORMA ASOCIATIVA EN VEZ DE INDEXADA LA IMPRESIÓN DE LOS DATOS
    while ($fila = mysqli_fetch_array($resultados, MYSQLI_ASSOC)) {
        // mysqli_fetch_array necesita dos parámetros, por un lado el resulset y por otro lado una CONSTANTE que es MYSQL_ASSOC
        echo "<table><tr><td>";
        echo $fila['CODIGOARTICULO'] . "</td><td>";
        echo $fila['SECCION'] . "</td><td>";
        echo $fila['NOMBREARTICULO'] . "</td><td>";
        echo $fila['PRECIO'] . "</td><td>";
        echo $fila['FECHA'] . "</td><td>";
        echo $fila['IMPORTADO'] . "</td><td>";
        echo $fila['PAISDEORIGEN'] . "</td><tr></table>";
    }

    //FINALMENTE CERRAMOS LA CONEXION
    
    mysqli_close($conexion);

    ?>

</body>

</html>