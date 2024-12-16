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
        }

        th,
        td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            text-align: center;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
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

    // Incluir archivo de conexión con las credenciales de la base de datos
    require("datos_conexion.php");

    // Conectar a la base de datos utilizando las credenciales definidas
    $conexion = mysqli_connect($db_host, $db_usuario, $db_contra);

    // Verificar si la conexión ha fallado, en caso afirmativo mostrar un mensaje y finalizar el script
    if (mysqli_connect_errno()) {
        echo "Fallo al conectar con la base de datos";
        // Terminar la ejecución para evitar más errores si la conexión falla
        exit();
    }

    // Seleccionar la base de datos que queremos usar, si no existe, mostrar mensaje de error y finalizar
    mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la base de datos");

    // Configurar el conjunto de caracteres que queremos usar para la conexión (UTF-8 para caracteres especiales)
    mysqli_set_charset($conexion, "utf8");

    // Crear la consulta SQL para seleccionar todos los productos cuyo nombre empieza con 'BALON'
    $consulta = "SELECT * FROM productos WHERE NOMBREARTICULO LIKE 'BALON%'";

    // Ejecutar la consulta y guardar el resultado en la variable $resultados (un resultset)
    $resultados = mysqli_query($conexion, $consulta);

    // Recorrer cada fila del resultset devuelto por la consulta
    while ($fila = mysqli_fetch_array($resultados, MYSQLI_ASSOC)) {
        // Para cada fila, usamos mysqli_fetch_array con el modo MYSQLI_ASSOC para obtener los datos de forma asociativa (clave => valor)
    
        // Mostrar los datos en una tabla HTML con cada campo en una celda
        echo "<table><tr><td>";
        echo $fila['CODIGOARTICULO'] . "</td><td>"; // Código del artículo
        echo $fila['SECCION'] . "</td><td>"; // Sección
        echo $fila['NOMBREARTICULO'] . "</td><td>"; // Nombre del artículo
        echo $fila['PRECIO'] . "</td><td>"; // Precio
        echo $fila['FECHA'] . "</td><td>"; // Fecha de registro
        echo $fila['IMPORTADO'] . "</td><td>"; // Si es importado
        echo $fila['PAISDEORIGEN'] . "</td><tr></table>"; // País de origen
    }

    // Cerrar la conexión con la base de datos después de haber procesado los datos
    mysqli_close($conexion);

    ?>
</body>

</html>