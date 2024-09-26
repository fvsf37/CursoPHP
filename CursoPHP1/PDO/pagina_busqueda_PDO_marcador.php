<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $busqueda=$_GET["buscar"];

    //try...catch...finally, Intenta esto...y si se produce un error capturalo(catch) y finalmente haz esto (finally). El finally siempre se ejecuta independientemente de que haya hecho el try o el catch
        try{
            $base= new PDO('mysql:host=localhost; dbname=pruebas', 'root', ''); //Creada conexion con la base de datos
            $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $base->exec("SET CHARACTER SET utf8");
            $sql="SELECT CODIGOARTICULO, SECCION, NOMBREARTICULO, PRECIO, FECHA, IMPORTADO, PAISDEORIGEN FROM productos where NOMBREARTICULO=:n_art"; //UTILIZO MARCADOR
            $resultado=$base->prepare($sql);
            //$resultado->execute(array("CAMISETA BALONCESTO"));
            $resultado->execute(array(":n_art"=>$busqueda));
            while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
                echo "<table><tr><td>";
                echo $registro['CODIGOARTICULO'] . "</td><td>";
                echo $registro['SECCION'] . "</td><td>";
                echo $registro['NOMBREARTICULO'] . "</td><td>";
                echo $registro['PRECIO'] . "</td><td>";
                echo $registro['FECHA'] . "</td><td>";
                echo $registro['IMPORTADO'] . "</td><td>";
                echo $registro['PAISDEORIGEN'] . "</td></tr></table>";
            }
            $resultado->closeCursor();
        }catch (Exception $e){ // Si se produce un fallo lo captura y crea el objeto $e
            die ('Error: ' . $e->GetMessage());
        }finally{
            $base=null; //una forma de decirle que vacie la memoria
        }

    ?>
</body>
</html>