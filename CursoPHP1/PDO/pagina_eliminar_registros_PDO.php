<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $busqueda_cart=$_GET["cart"];
     
        try{
            $base= new PDO('mysql:host=localhost; dbname=pruebas', 'root', ''); //Creada conexion con la base de datos
            $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $base->exec("SET CHARACTER SET utf8");
            $sql="DELETE FROM productos WHERE CODIGOARTICULO=:c_art";
            $resultado=$base->prepare($sql);
            $resultado->execute(array(":c_art"=>$busqueda_cart));
            echo "Registro borrado";
            $resultado->closeCursor();
        }catch (Exception $e){ // Si se produce un fallo lo captura y crea el objeto $e
            die ('Error: ' . $e->GetMessage());
        }finally{
            $base=null; //una forma de decirle que vacie la memoria
        }

    ?>
</body>
</html>