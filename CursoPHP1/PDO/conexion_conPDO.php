<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    //try...catch...finally, Intenta esto...y si se produce un error capturalo(catch) y finalmente haz esto (finally). El finally siempre se ejecuta independientemente de que haya hecho el try o el catch
        try{
            $base= new PDO('mysql:host=localhost; dbname=pruebas', 'root', ''); //Creada conexion con la base de datos
            echo "Conexion OK";
        }catch (Exception $e){ // Si se produce un fallo lo captura y crea el objeto $e
            die ('Error: ' . $e->GetMessage());
        }finally{
            $base=null; //una forma de decirle que vacie la memoria
        }

    ?>
</body>
</html>