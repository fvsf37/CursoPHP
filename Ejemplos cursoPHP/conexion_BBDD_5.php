<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <?php

    require("datos_conexion.php");

    //REALIZAMOS LA CONEXION
    $conexion = mysqli_connect($db_host,$db_usuario, $db_contra);

    //ESTA FUNCION SE EJECUTA SI NO TIENE EXITO LA CONEXION CON LA BASE DE DATOS
    if (mysqli_connect_errno()){
        echo "Fallo al conectar con la base de datos";
    //SI HAY FALLO LE DECIMOS QUE SALGA PARA QUE NO SIGA EJECUTANDO CÓDIGO PHP Y SALGAN MÁS ERRORES
        exit();
    }

    // Quitamos de $conexion el nombre de la base de datos para controlarlo por aquí
    mysqli_select_db($conexion,$db_nombre) or die ("No se encuentra la base de datos");

    //PARA INDICAR QUE QUEREMOS UTILIZAR EL JUEGO DE CARACTERES UTF-8
    mysqli_set_charset($conexion,"utf8");

    //CREAMOS LA CONSULTA
    $consulta="SELECT * FROM productos";

    //GUARDAMOS EN UNA TABLA VIRTUAL EL RESULSET O RECORDSET
    $resultados=mysqli_query($conexion,$consulta);

    //RECORREMOS FILA A FILA DICHA TABLA, DICHO RESULSET
    while ($fila=mysqli_fetch_row($resultados)){
        echo $fila[0] . " ";
        echo $fila[1] . " ";
        echo $fila[2] . " ";
        echo $fila[3] . " ";
        echo $fila[4] . " ";
        echo $fila[5] . " ";
        echo $fila[6] . " ";
        echo "<br>";
        echo "<br>";
    }

    //FINALMENTE CERRAMOS LA CONEXION

    mysqli_close($conexion);

   ?>

</body>
</html>