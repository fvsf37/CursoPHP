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

    //ESTA FUNCION SE EJECUTA SI NO TIENE EXITO LA CONEXION CON LA BASE DE DATOS
    if (mysqli_connect_errno()) {
        echo "Fallo al conectar con la base de datos";
        //SI HAY FALLO LE DECIMOS QUE SALGA PARA QUE NO SIGA EJECUTANDO CÓDIGO PHP Y SALGAN MÁS ERRORES
        exit();
    }

    //PARA INDICAR QUE QUEREMOS UTILIZAR EL JUEGO DE CARACTERES UTF-8
    mysqli_set_charset($conexion, "uft8");

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

    ?>

</body>

</html>