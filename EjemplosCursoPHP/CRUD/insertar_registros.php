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

    // Recoge los datos enviados por el formulario mediante POST
    $codigoarticulo = $_POST["cart"];  // Código del artículo
    $seccion = $_POST["secc"];         // Sección
    $nombrearticulo = $_POST["nart"];  // Nombre del artículo
    $precio = $_POST["pre"];           // Precio del artículo
    $fecha = $_POST["fech"];           // Fecha del artículo
    $importado = $_POST["imp"];        // Indicador si es importado
    $paisdeorigen = $_POST["porig"];   // País de origen
    
    // Incluir el archivo de conexión con los datos de la base de datos
    require("datos_conexion.php");

    // Conectar a la base de datos utilizando mysqli_connect()
    $conexion = mysqli_connect($db_host, $db_usuario, $db_contra);

    // Verificar si la conexión ha fallado
    if (mysqli_connect_errno()) {
        echo "Fallo al conectar con la base de datos";
        exit();  // Si falla la conexión, detiene la ejecución para evitar más errores
    }

    // Seleccionar la base de datos
    mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la base de datos");

    // Establecer el juego de caracteres a UTF-8 para manejar correctamente caracteres especiales
    // CORRECCIÓN: El valor correcto es 'utf8' en lugar de 'uft8'
    mysqli_set_charset($conexion, "utf8");

    //--------------------------------------------
    // Crear la consulta INSERT para agregar un nuevo registro
    $consulta = "INSERT INTO productos (CODIGOARTICULO, SECCION, NOMBREARTICULO, PRECIO, FECHA, IMPORTADO, PAISDEORIGEN) 
                 VALUES ('$codigoarticulo', '$seccion', '$nombrearticulo', '$precio', '$fecha', '$importado', '$paisdeorigen')";
    //---------------------------------------------
    
    // Ejecutar la consulta y guardar el resultado en la variable $resultados
    $resultados = mysqli_query($conexion, $consulta);

    // Verificar si la inserción fue exitosa
    if ($resultados == false) {
        echo "ERROR EN LA CONSULTA. REGISTRO NO INSERTADO";
    } else {
        echo "REGISTRO INSERTADO CORRECTAMENTE";
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);

    ?>
</body>

</html>