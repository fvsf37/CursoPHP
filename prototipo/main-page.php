<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            box-sizing: border-box;
        }

        h3 {
            font-size: 1.2em;
            color: #007BFF;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            cursor: pointer;
            padding: 10px;
            border: none;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php 
    session_start();
    $user= $_SESSION["user"];

    try{
        $base = new PDO('mysql:host=localhost; dbname=repasoexamen', 'root', '');
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $base->exec('SET CHARACTER SET utf8');
        //Comando SQL usado para la consulta
        $sql = "SELECT img FROM users WHERE USER= :m_user";
        $resultado = $base->prepare($sql);
        //Se pasan los parámetros de la consulta
        $resultado->execute(array(":m_user" => $user));
        while($fila=$resultado->fetch(PDO::FETCH_ASSOC)){
            $ruta_imagen=$fila["img"];
        }
        $resultado->closeCursor();
    }catch(Exception $e){
        echo $e->getMessage();
    }finally{
        $base=null;
    }
    ?>

    <h2>Bienvenido, <?php echo $_SESSION["user"] ; ?></h2>

    <img src="img/<?php echo $ruta_imagen;?>" alt="Foto de perfil">
    <br>
    <br>
    <form action="enviarEmail.php?default=false" method="post" enctype="multipart/form-data">
        <h3>
            <?php
            if (isset($_GET["customEmail"])) {
                echo ("Mensaje enviado correctamente.");
            } else {
                echo ("Envía tu correo personalizado desde aquí.");
            }
            ?>
        </h3>
        <label for="mailSubject">Asunto:</label>
        <input type="text" name="mailSubject" required>
        <label for="mailContent">Cuerpo:</label>
        <textarea name="mailContent" cols="30" rows="10" required></textarea>
        <label for="mailAttach">Adjuntar:</label>
        <input type="file" name="mailAttach">
        <input type="submit" value="Enviar">
    </form>

</body>
</html>