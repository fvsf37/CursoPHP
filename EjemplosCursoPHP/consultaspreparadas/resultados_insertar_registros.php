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
    //LO NUEVO PARA ESTE CODIOG ES ALMACENAR EN UNA VARIABLE LO QUE EL USUARIO HAYA INTRODUCIDO EN EL CAMPO DE BUSQUEDA DEL FORMULARIO
    $cart = $_GET["cart"];
    $secc = $_GET["secc"];
    $nart = $_GET["nart"];
    $pre = $_GET["pre"];
    $fech = $_GET["fech"];
    $imp = $_GET["imp"];
    $porig = $_GET["porig"];

    require_once("../datos_conexion.php");
    $conexion = mysqli_connect($db_host, $db_usuario, $db_contra);

    if (mysqli_connect_errno()) {
        echo "Fallo al conectar con la base de datos";
        exit();
    }

    mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la base de datos");
    mysqli_set_charset($conexion, "utf8");

    //--------------------COSULTAS PREPARADAS----------------------------------------
    $sql = "INSERT INTO productos (CODIGOARTICULO, SECCION, NOMBREARTICULO, PRECIO, FECHA, IMPORTADO, PAISDEORIGEN) VALUES (?,?,?,?,?,?,?)";
    $resultado = mysqli_prepare($conexion, $sql);
    $ok = mysqli_stmt_bind_param($resultado, "sssisss", $cart, $secc, $nart, $pre, $fech, $imp, $porig); //Si esta instruccion tiene exito sera TRUE y sino sera FALSE
    $ok = mysqli_stmt_execute($resultado);//Si esta instruccion tiene exito sera TRUE y sino sera FALSE
    
    if ($ok == false) {
        echo "Error al ejecutar la consulta";
    } else {
        //MOSTRAMOS LOS RESULTADOS
        //$ok=mysqli_stmt_bind_result($resultado, $codigoarticulo, $seccion, $nombrearticulo, $precio, $fecha, $importado, $paisdeorigen);
        echo "INSERTADO CON EXITO NUEVO REGISTRO:<br><br>";

        mysqli_stmt_close($resultado);
    }

    //----------------------FIN COSULTAS PREPARADAS----------------------------------------
    


    ?>

</body>

</html>