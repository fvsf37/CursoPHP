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
    
    //Intenta una conexión a una base de datos
    try {
        //Objeto encargado de conectarse a la base de datos
        $base = new PDO('mysql:host=localhost; dbname=repasoexamen', 'root', '');
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $base->exec('SET CHARACTER SET utf8');
        //Comando SQL usado para la consulta
        $sql = "SELECT * FROM users WHERE USER= :m_user";
        $resultado = $base->prepare($sql);
        //Se pasan los parámetros de la consulta
        $resultado->execute(array(":m_user" => $user));
        //Comprueba que SOLO hay un usuario en la base de datos con ese usuario
        if ($resultado->rowCount() == 1) {
            while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($password, $fila["pass"])) {
                    session_start();
                    $_SESSION["user"] = $user;
                    //Crea una cookie en caso de haber ticado la casilla de Recordar
                    if (isset($_POST["remember"])) {
                        setcookie("rememberme", $user, time() + 86400);
                    }
                    //Redirige
                    header("Location:main-page.php");
                } else {
                    //Crea una sesión con índice llamado "error" y se le establece un valor cuando no hay exactamente un usuario
                    session_start();
                    $_SESSION['error'] = "Error de inicio de sesión";
                    //Redirige
                    header("Location:login.php");
                }
            }
        } else {
            //Crea una sesión con índice llamado "error" y se le establece un valor cuando no hay exactamente un usuario
            session_start();
            $_SESSION['error'] = "Error de inicio de sesión";
            //Redirige
            header("Location:login.php");
        }
        //Cierra el cursor de resultados de la consulta actual
        $resultado->closeCursor();
    } catch (Exception $e) {
        // Devuelve el mensaje de error en caso de haberlo
        die('Error: ' . $e->getMessage());
    } finally {
        //Elimina los datos de la conexión de la base de datos, pues ya no los necesita
        $base = null;
    }
    ?>
</body>

</html>