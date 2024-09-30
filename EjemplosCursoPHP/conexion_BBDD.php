<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $db_host = "localhost";
    $db_nombre = "pruebas";
    $db_usuario = "root";
    $db_contra = "";

    //REALIZAMOS LA CONEXION
    $conexion = mysqli_connect($db_host, $db_usuario, $db_contra, $db_nombre);

    //CREAMOS LA CONSULTA
    $consulta = "SELECT * FROM datospersonales";

    //GUARDAMOS EN UNA TABLA VIRTUAL EL RESULSET O RECORDSET
    $resultados = mysqli_query($conexion, $consulta);

    //RECORREMOS FILA A FILA DICHA TABLA, DICHO RESULSET
    $fila = mysqli_fetch_row($resultados);

    echo $fila[0] . " ";
    echo $fila[1] . " ";
    echo $fila[2] . " ";
    echo $fila[3] . " ";

    echo "<br>";

    $fila = mysqli_fetch_row($resultados);

    echo $fila[0] . " ";
    echo $fila[1] . " ";
    echo $fila[2] . " ";
    echo $fila[3] . " ";

    ?>

</body>

</html>