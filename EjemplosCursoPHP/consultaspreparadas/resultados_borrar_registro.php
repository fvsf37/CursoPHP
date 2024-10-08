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
    // Recibe el valor que el usuario ha ingresado en el campo de búsqueda del formulario a través del método GET
    $codarticulo = $_GET["borrar"];

    // Incluye el archivo de conexión a la base de datos donde se definen las credenciales ($db_host, $db_usuario, $db_contra)
    require_once("../datos_conexion.php");

    // Establece la conexión con la base de datos usando las credenciales importadas
    $conexion = mysqli_connect($db_host, $db_usuario, $db_contra);

    // Verifica si hay algún error en la conexión con la base de datos
    if (mysqli_connect_errno()) {
        echo "Fallo al conectar con la base de datos";
        exit(); // Termina la ejecución si hay un fallo en la conexión
    }

    // Selecciona la base de datos donde se van a hacer las operaciones
    mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la base de datos");

    // Configura el conjunto de caracteres a UTF-8 para manejar bien los caracteres especiales
    mysqli_set_charset($conexion, "utf8");

    //--------------------CONSULTA PREPARADA PARA ELIMINAR----------------------------------------
    // Prepara una consulta SQL para eliminar un registro en la tabla 'productos' donde el 'CODIGOARTICULO' coincida con el que se recibe en $codarticulo
    $sql = "DELETE FROM productos WHERE CODIGOARTICULO=?";

    // Prepara la consulta SQL para su ejecución
    $resultado = mysqli_prepare($conexion, $sql);

    // Vincula el valor de $codarticulo al parámetro de la consulta, donde "s" indica que es una cadena de texto
    $ok = mysqli_stmt_bind_param($resultado, "s", $codarticulo);

    // Ejecuta la consulta ya con el valor vinculado
    $ok = mysqli_stmt_execute($resultado);

    // Verifica si la ejecución de la consulta fue exitosa
    if ($ok == false) {
        echo "Error al ejecutar la consulta";
    } else {
        // Si se ejecuta correctamente, muestra un mensaje confirmando la eliminación
        echo "BORRADO CON ÉXITO EL REGISTRO:<br><br>";

        // Cierra el objeto de consulta para liberar recursos
        mysqli_stmt_close($resultado);
    }

    //----------------------FIN DE LA CONSULTA PREPARADA----------------------------------------
    ?>
</body>

</html>