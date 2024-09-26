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
        $busqueda_secc=$_GET["secc"];
        $busqueda_nart=$_GET["nart"];
        $busqueda_pre=$_GET["pre"];
        $busqueda_fech=$_GET["fech"];
        $busqueda_imp=$_GET["imp"];
        $busqueda_porig=$_GET["porig"];
        

    //try...catch...finally, Intenta esto...y si se produce un error capturalo(catch) y finalmente haz esto (finally). El finally siempre se ejecuta independientemente de que haya hecho el try o el catch
        try{
            $base= new PDO('mysql:host=localhost; dbname=pruebas', 'root', ''); //Creada conexion con la base de datos
            $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $base->exec("SET CHARACTER SET utf8");
            $sql="INSERT INTO productos (CODIGOARTICULO, SECCION, NOMBREARTICULO, PRECIO, FECHA, IMPORTADO, PAISDEORIGEN) VALUES (:c_art, :seccion, :n_art, :precio, :fecha, :importado, :p_orig)";
            $resultado=$base->prepare($sql);
            $resultado->execute(array(":c_art"=>$busqueda_cart, ":seccion"=>$busqueda_secc, ":n_art"=>$busqueda_nart, ":precio"=>$busqueda_pre, ":fecha"=>$busqueda_fech, ":importado"=>$busqueda_imp, ":p_orig"=>$busqueda_porig));
            echo "Registro insertado";
            $resultado->closeCursor();
        }catch (Exception $e){ // Si se produce un fallo lo captura y crea el objeto $e
            die ('Error: ' . $e->GetMessage());
        }finally{
            $base=null; //una forma de decirle que vacie la memoria
        }

    ?>
</body>
</html>