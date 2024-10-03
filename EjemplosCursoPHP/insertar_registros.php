<?php

$codigoarticulo = $_POST["cart"];
$seccion = $_POST["secc"];
$nombrearticulo = $_POST["nart"];
$precio = $_POST["pre"];
$fecha = $_POST["fech"];
$importado = $_POST["imp"];
$paisdeorigen = $_POST["porig"];

require("datos_conexion.php");

$conexion = mysqli_connect($db_host, $db_usuario, $db_contra);

if (mysqli_connect_errno()) {
    echo "Fallo al conectar con la base de datos";
    exit();
}

mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la base de datos");
mysqli_set_charset($conexion, "utf8");

// Comprobamos si el CODIGOARTICULO ya existe
$consulta_comprobar = "SELECT CODIGOARTICULO FROM productos WHERE CODIGOARTICULO='$codigoarticulo'";
$resultado_comprobar = mysqli_query($conexion, $consulta_comprobar);

if (mysqli_num_rows($resultado_comprobar) > 0) {
    echo "El producto con el CODIGOARTICULO '$codigoarticulo' ya existe.";
} else {
    // Si no existe, se inserta
    $consulta = "INSERT INTO productos (CODIGOARTICULO, SECCION, NOMBREARTICULO, PRECIO, FECHA, IMPORTADO, PAISDEORIGEN) VALUES ('$codigoarticulo', '$seccion', '$nombrearticulo', '$precio',  '$fecha', '$importado', '$paisdeorigen')";

    $resultados = mysqli_query($conexion, $consulta);

    if ($resultados == false) {
        echo "ERROR EN LA CONSULTA. REGISTRO NO INSERTADO";
    } else {
        echo "REGISTRO INSERTADO CORRECTAMENTE";
    }
}

mysqli_close($conexion);
?>