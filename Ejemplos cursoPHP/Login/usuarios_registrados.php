<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php

//Poneos código php aquí antes de mostrar el contenido  del html, comprobando que la sesión está abierta y es correcta

        session_start();
        if (!isset($_SESSION["usuario"])){
            header("Location:login_2.php");
        }
        echo "Hola: ". $_SESSION["usuario"] . "<br>";
    ?>



    <h1>Bienvenidos Usuarios</h1>
    <p>Esto es informacion solo para usuarios registtrados</p>

</body>
</html>