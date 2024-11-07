<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    //Recogemos parámetros por método POST
    $user = $_POST["user"];
    $password = $_POST["password"];
    //Variable con la contraseña cifrada
    //password_hash() -> Utiliza el algoritmo con las opciones proporcionadas para cifrar contraseñas
    //password_hash([string que se va a cifrar], [algoritmo que cifra], [array('cost'=>X) fuerza de cifrado])
    $secretPassword=password_hash($password, PASSWORD_DEFAULT, array('cost'=>12));
    $email = $_POST["email"];
    //Comprueba que ha recibido una imagen del formulario, si no, carga una por defecto
    //$img = "img/empty.jpg";
    if($_FILES["img"]["error"]=== UPLOAD_ERR_OK){
        $ruta_destino = $_FILES["img"]["name"];
        $carpeta_destino = $_SERVER["DOCUMENT_ROOT"]."/prototipo/img/";
        move_uploaded_file($_FILES["img"]["tmp_name"],$carpeta_destino.$ruta_destino);
        //copy($_files["img"]["tmp_name"], $carpeta_destino);
        $img =$ruta_destino;
    }else{
        $img="empty.jpg";
    }

    //Intenta una conexión a una base de datos
    try {
        //Objeto encargado de conectarse a la base de datos
        $base = new PDO('mysql:host=localhost; dbname=repasoexamen', 'root', '');
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $base->exec('SET CHARACTER SET utf8');
        //Comando SQL usado para la consulta
        $sql = "SELECT * FROM users WHERE USER= :m_user AND EMAIL= :m_email ";
        $resultado = $base->prepare($sql);
        //Se pasan los parámetros de la consulta
        $resultado->execute(array(":m_user" => $user, ":m_email" => $email));
        //Comprueba que SOLO hay un usuario en la base de datos con esas credenciales
        if ($resultado->rowCount() != 0) {
            //Crea una sesión con índice llamado "error" y se le establece un valor cuando no hay exactamente un usuario
            session_start();
            $_SESSION['errorSigning'] = "Ya hay un usuario con esas credenciales";
            //Redirige
            header("Location:signup.php");
        } else {
            $sql = "INSERT INTO users (user, pass, email, img) VALUES (:m_user, :m_password, :m_email, :m_img)";
            $resultado = $base->prepare($sql);
            //Se pasan los parámetros de la consulta
            $resultado->execute(array(":m_user" => $user, ":m_password" => $secretPassword, ":m_email" => $email, ":m_img"=>$img));
            header("Location:login.php");
        }
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