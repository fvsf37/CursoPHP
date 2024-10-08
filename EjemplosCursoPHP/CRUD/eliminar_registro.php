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
    // Recoge los datos del formulario enviados mediante POST
    $codigoarticulo = $_POST["cart"];  // Código del artículo
    $seccion = $_POST["secc"];         // Sección
    $nombrearticulo = $_POST["nart"];  // Nombre del artículo
    $precio = $_POST["pre"];           // Precio del artículo
    $fecha = $_POST["fech"];           // Fecha del artículo
    $importado = $_POST["imp"];        // Si es importado
    $paisdeorigen = $_POST["porig"];   // País de origen
    
    // Incluir el archivo de conexión a la base de datos
    require("datos_conexion.php");

    // Realizar la conexión a la base de datos
    $conexion = mysqli_connect($db_host, $db_usuario, $db_contra);

    // Verificar si la conexión fue exitosa
    if (mysqli_connect_errno()) {
        echo "Fallo al conectar con la base de datos";
        exit();  // Si la conexión falla, se detiene la ejecución para evitar más errores
    }

    // Seleccionar la base de datos en la que se va a trabajar
    mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la base de datos");

    // Establecer el juego de caracteres a UTF-8 para manejar correctamente caracteres especiales
    mysqli_set_charset($conexion, "utf8");

    //--------------------------------------------
    // Crear la consulta DELETE para eliminar el registro con el código de artículo proporcionado
    $consulta = "DELETE FROM productos WHERE CODIGOARTICULO='$codigoarticulo'";
    //---------------------------------------------
    
    // Ejecutar la consulta y guardar el resultado
    $resultados = mysqli_query($conexion, $consulta);

    // Verificar si la eliminación fue exitosa
    if ($resultados == false) {
        echo "ERROR EN LA CONSULTA. REGISTRO NO ELIMINADO";
    } else {
        // Verificar cuántos registros fueron afectados (eliminados) por la consulta
        if (mysqli_affected_rows($conexion) == 0) {
            // Si no se afectaron registros, significa que no había un artículo con el código proporcionado
            echo "No hay registros que eliminar con ese criterio";
        } else {
            // Si se eliminaron registros, se muestra cuántos fueron eliminados
            echo "Se han eliminado " . mysqli_affected_rows($conexion) . " registros";
        }
    }

    // Cerrar la conexión con la base de datos para liberar recursos
    mysqli_close($conexion);
    ?>
</body>

</html>