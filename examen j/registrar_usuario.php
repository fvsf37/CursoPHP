<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registrar_usuario</title>
</head>
<body>
<?php
    //Recogemos parámetros por método POST
    $user = $_POST["user"];
    $password = $_POST["password"];
    $secretPassword=password_hash($password, PASSWORD_DEFAULT, array('cost'=>12));
    
    //Intenta una conexión a una base de datos
    try {
        //Objeto encargado de conectarse a la base de datos
        $base = new PDO('mysql:host=localhost; dbname=pruebas', 'root', '');
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $base->exec('SET CHARACTER SET utf8');
        //Comando SQL usado para la consulta
        $sql = "SELECT * FROM usuario WHERE usuario= :m_user";
        $resultado = $base->prepare($sql);
        //Se pasan los parámetros de la consulta
        $resultado->execute(array(":m_user" => $user));
        //Comprueba que SOLO hay un usuario en la base de datos con ese usuario
        if ($resultado->rowCount() != 0) {
            //Crea una sesión con índice llamado "error" y se le establece un valor cuando no hay exactamente un usuario
            session_start();
            $_SESSION['error'] = "Error: Dicho usuario ya existe y no se insertará en la base de datos";
            //Redirige
            header("Location:formulario_registrar_usuario.php");
        } else {
            $sql = "INSERT INTO usuario (usuario, password) VALUES (:m_user, :m_password)";
            $resultado = $base->prepare($sql);
            //Se pasan los parámetros de la consulta
            $resultado->execute(array(":m_user" => $user, ":m_password" => $secretPassword));
            header("Location:main-page.php");
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