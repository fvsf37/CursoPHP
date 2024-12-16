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
    // Recibe los valores del formulario que el usuario envió por GET (campos como código de artículo, sección, nombre, etc.)
    $cart = $_GET["cart"]; // Código del artículo
    $secc = $_GET["secc"]; // Sección
    $nart = $_GET["nart"]; // Nombre del artículo
    $pre = $_GET["pre"]; // Precio
    $fech = $_GET["fech"]; // Fecha
    $imp = $_GET["imp"]; // Si es importado
    $porig = $_GET["porig"]; // País de origen
    
    // Incluye el archivo de conexión a la base de datos donde se configuran las credenciales
    require_once("../datos_conexion.php");

    // Establece la conexión a la base de datos con las credenciales del archivo externo
    $conexion = mysqli_connect($db_host, $db_usuario, $db_contra);

    // Verifica si la conexión fue exitosa, si no, muestra un mensaje de error y termina la ejecución
    if (mysqli_connect_errno()) {
        echo "Fallo al conectar con la base de datos";
        exit();
    }

    // Selecciona la base de datos específica donde se va a trabajar
    mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la base de datos");

    // Configura el conjunto de caracteres a UTF-8 para evitar problemas con caracteres especiales
    mysqli_set_charset($conexion, "utf8");

    //--------------------CONSULTA PREPARADA PARA INSERTAR DATOS----------------------------------------
    // Prepara la consulta SQL para insertar los valores recibidos del formulario en la tabla 'productos'
    $sql = "INSERT INTO productos (CODIGOARTICULO, SECCION, NOMBREARTICULO, PRECIO, FECHA, IMPORTADO, PAISDEORIGEN) VALUES (?,?,?,?,?,?,?)";

    // Prepara la consulta para evitar inyecciones SQL
    $resultado = mysqli_prepare($conexion, $sql);

    // Vincula los valores recibidos a los parámetros de la consulta, con los tipos de datos: s (string), i (integer)
    $ok = mysqli_stmt_bind_param($resultado, "sssisss", $cart, $secc, $nart, $pre, $fech, $imp, $porig);

    // Ejecuta la consulta preparada con los valores vinculados
    $ok = mysqli_stmt_execute($resultado);

    // Verifica si la ejecución fue exitosa
    if ($ok == false) {
        echo "Error al ejecutar la consulta";
    } else {
        // Si fue exitosa, muestra un mensaje de confirmación de inserción exitosa
        echo "INSERTADO CON ÉXITO NUEVO REGISTRO:<br><br>";

        // Cierra el objeto de consulta para liberar recursos
        mysqli_stmt_close($resultado);
    }

    //----------------------FIN CONSULTA PREPARADA----------------------------------------
    ?>
</body>

</html>