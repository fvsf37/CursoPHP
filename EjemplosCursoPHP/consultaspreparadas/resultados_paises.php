<!DOCTYPE html>
<html lang="en">

<head>

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
    // Recoge el valor introducido por el usuario en el campo de búsqueda del formulario, enviado por GET
    $pais = $_GET["buscar"]; // Valor del país de origen que se va a buscar
    
    // Incluye el archivo de conexión con las credenciales de acceso a la base de datos
    require_once("../datos_conexion.php");

    // Establece la conexión con la base de datos usando las credenciales importadas
    $conexion = mysqli_connect($db_host, $db_usuario, $db_contra);

    // Verifica si la conexión fue exitosa, en caso de error muestra un mensaje y termina la ejecución
    if (mysqli_connect_errno()) {
        echo "Fallo al conectar con la base de datos";
        exit();
    }

    // Selecciona la base de datos a la que se conectará
    mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la base de datos");

    // Configura el conjunto de caracteres a UTF-8 para evitar problemas con caracteres especiales
    mysqli_set_charset($conexion, "utf8");

    //--------------------CONSULTA PREPARADA PARA SELECCIONAR REGISTROS----------------------------------------
    // Prepara una consulta SQL para seleccionar artículos donde el 'PAISDEORIGEN' coincida con el valor recibido
    $sql = "SELECT CODIGOARTICULO, SECCION, NOMBREARTICULO, PRECIO, FECHA, IMPORTADO, PAISDEORIGEN FROM productos WHERE PAISDEORIGEN= ?";

    // Prepara la consulta para evitar inyecciones SQL
    $resultado = mysqli_prepare($conexion, $sql);

    // Vincula el valor del país proporcionado por el usuario al parámetro de la consulta ("s" indica que es un string)
    $ok = mysqli_stmt_bind_param($resultado, "s", $pais);

    // Ejecuta la consulta con los valores vinculados
    $ok = mysqli_stmt_execute($resultado);

    // Verifica si la ejecución de la consulta fue exitosa
    if ($ok == false) {
        echo "Error al ejecutar la consulta";
    } else {
        // Si la consulta es exitosa, se vinculan las columnas de resultado a variables
        $ok = mysqli_stmt_bind_result($resultado, $codigoarticulo, $seccion, $nombrearticulo, $precio, $fecha, $importado, $paisdeorigen);

        // Muestra un encabezado indicando que se encontraron artículos
        echo "Artículos encontrados:<br><br>";

        // Recorre los resultados obtenidos y los muestra en una tabla
        while (mysqli_stmt_fetch($resultado)) {
            echo "<table><tr><td>";
            echo $codigoarticulo . "</td><td>";
            echo $seccion . "</td><td>";
            echo $nombrearticulo . "</td><td>";
            echo $precio . "</td><td>";
            echo $fecha . "</td><td>";
            echo $importado . "</td><td>";
            echo $paisdeorigen . "</td></tr></table>";
        }

        // Cierra el objeto de consulta para liberar los recursos
        mysqli_stmt_close($resultado);
    }

    //----------------------FIN CONSULTA PREPARADA----------------------------------------
    ?>
</body>

</html>