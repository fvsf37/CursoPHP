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

    $codigoarticulo = $_POST["c_art"];
    $seccion = $_POST["sec"];
    $nombrearticulo = $_POST["n_art"];
    $precio = $_POST["pre"];
    $fecha = $_POST["fech"];
    $importado = $_POST["imp"];
    $paisdeorigen = $_POST["porig"];

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

    //--------------------------------------------
    
    $consulta = "UPDATE productos SET CODIGOARTICULO='$codigoarticulo', SECCION='$seccion', NOMBREARTICULO='$nombrearticulo', PRECIO='$precio', FECHA='$fecha', IMPORTADO='$importado', PAISDEORIGEN='$paisdeorigen' WHERE CODIGOARTICULO='$codigoarticulo' ";
    //---------------------------------------------
    
    //GUARDAMOS EN UNA TABLA VIRTUAL EL RESULSET O RECORDSET
    $resultados = mysqli_query($conexion, $consulta);

    if ($resultados == false) {
        echo "ERROR EN LA CONSUTA. REGISTRO NO ACTUALIZADO";
    } else {
        echo "REGISTRO ACTUALIZADO CORRECTAMENTE";
    }
    //FINALMENTE CERRAMOS LA CONEXION
    
    mysqli_close($conexion);

    ?>

</body>

</html>