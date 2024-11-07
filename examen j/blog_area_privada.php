<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blog_area_privada</title>
</head>
<body>
<?php
    //Recogemos parámetros por método POST
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descrip"];
    $img=$_FILES["img"];
    

    //Comprueba que ha recibido una imagen del formulario, si no, carga una por defecto
   /* if($_FILES["img"]["error"]=== UPLOAD_ERR_OK){
        $ruta_destino = $_FILES["img"]["name"];
        $carpeta_destino = $_SERVER["DOCUMENT_ROOT"]."/examen/img/";
        move_uploaded_file($_FILES["img"]["tmp_name"],$carpeta_destino.$ruta_destino);
        //copy($_files["img"]["tmp_name"], $carpeta_destino);
        $img =$ruta_destino;
    }else{
        $img="empty.png";
    } */

    //Intenta una conexión a una base de datos
    try {
        //Objeto encargado de conectarse a la base de datos
        $base = new PDO('mysql:host=localhost; dbname=pruebas', 'root', '');
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $base->exec('SET CHARACTER SET utf8');
        //Comando SQL usado para la consulta
        $sql = "INSERT INTO blog (titulo, descripcion) VALUES (:m_titulo, :m_descripcion)";
            $resultado = $base->prepare($sql);
            //Se pasan los parámetros de la consulta
            $resultado->execute(array(":m_titulo" => $titulo, ":m_descripcion" => $descripcion));
            header("Location:mostrarBlog.php");
    }catch (Exception $e){
        // Devuelve el mensaje de error en caso de haberlo
        die ('Error: ' . $e->getMessage());
    }finally{
        //Elimina los datos de la conexión de la base de datos, pues ya no los necesita
        $base=null;
    }
    ?>
</body>
</html>