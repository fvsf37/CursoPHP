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
    // Recoge el valor introducido en el campo de búsqueda del formulario a través del método GET
    $busqueda = $_GET["buscar"];

    // Incluir archivo de conexión a la base de datos con las credenciales
    require_once("datos_conexion.php");

    // Establecer la conexión con la base de datos
    $conexion = mysqli_connect($db_host, $db_usuario, $db_contra);

    // Verificar si la conexión ha fallado
    if (mysqli_connect_errno()) {
        echo "Fallo al conectar con la base de datos";
        // Detener el script si la conexión falla para evitar más errores
        exit();
    }

    // Seleccionar la base de datos que se va a utilizar
    mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la base de datos");

    // Establecer el juego de caracteres a UTF-8 (descomentado para que funcione con caracteres especiales)
    mysqli_set_charset($conexion, "utf8");

    //--------------------------------------------
    // Crear la consulta para buscar productos cuyo nombre contenga el valor de $busqueda
    $consulta = "SELECT * FROM productos WHERE NOMBREARTICULO LIKE '%$busqueda%'";

    // Ejecutar la consulta y almacenar los resultados en la variable $resultados
    $resultados = mysqli_query($conexion, $consulta);

    // Verificar si la consulta devolvió resultados
    if (!$resultados) {
        echo "Error en la consulta";
        exit();
    }

    // Recorrer cada fila del resultset devuelto por la consulta y mostrar los datos en una tabla HTML
    while ($fila = mysqli_fetch_array($resultados, MYSQLI_ASSOC)) {
        // Imprimir los valores de las columnas de cada fila en una tabla
        echo "<table><tr><td>";
        echo $fila['CODIGOARTICULO'] . "</td><td>";  // Mostrar el código del artículo
        echo $fila['SECCION'] . "</td><td>";         // Mostrar la sección
        echo $fila['NOMBREARTICULO'] . "</td><td>";  // Mostrar el nombre del artículo
        echo $fila['PRECIO'] . "</td><td>";          // Mostrar el precio
        echo $fila['FECHA'] . "</td><td>";           // Mostrar la fecha
        echo $fila['IMPORTADO'] . "</td><td>";       // Mostrar si es importado
        echo $fila['PAISDEORIGEN'] . "</td></tr></table>"; // Mostrar el país de origen
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
    ?>
</body>

</html>