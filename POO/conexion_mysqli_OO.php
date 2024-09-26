<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $conexion= new mysqli("localhost", "root", "", "pruebas");
        if ($conexion->connect_errno){
            echo "Falló la conexion" . $conexion->connect_errno;
        }
        $conexion->set_charset("utf8");
        $sql="SELECT * FROM productos";
        $resultados=$conexion->query($sql);
        if ($conexion->errno){
            die ($conexion->error);
        }
        while ($fila=$resultados->fetch_assoc()){
            echo "<table><tr><td>";
            echo $fila['CODIGOARTICULO'] . "</td><td>";
            echo $fila['SECCION'] . "</td><td>";
            echo $fila['NOMBREARTICULO'] . "</td><td>";
            echo $fila['PRECIO'] . "</td><td>";
            echo $fila['FECHA'] . "</td><td>";
            echo $fila['IMPORTADO'] . "</td><td>";
            echo $fila['PAISDEORIGEN'] . "</td></tr></table>";
        }

/* O BIEN
        while ($fila=$resultados->fetch_array()){
            echo "<table><tr><td>";
            echo $fila[0] . "</td><td>";
            echo $fila[1] . "</td><td>";
            echo $fila[2] . "</td><td>";
            echo $fila[3] . "</td><td>";
            echo $fila[4] . "</td><td>";
            echo $fila[5] . "</td><td>";
            echo $fila[6] . "</td></tr></table>";
        }
*/

        $conexion->close();
    ?>
</body>
</html>