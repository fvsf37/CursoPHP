<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    /* Usamos la variable superglobal $_COOKIE y le ponemos entre corchetes y comillas el nombre de la cookie*/

    if(isset($_COOKIE["prueba4"])){
        echo $_COOKIE["prueba4"];
    }else{
        echo "LA COOKIE NO SE HA CREADO";
    }
      
    ?>
</body>
</html>