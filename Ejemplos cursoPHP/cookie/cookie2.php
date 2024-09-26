<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    /* 
    Cuando el navegador abra esta pagina creará la cookie llamada prueba y tendrá como contenido "Esta es la información de cookie1
    La cookie se crea en el momento que se abre el navegaodr, toma nota de la hora, min y segundos y la creará durante 15 segundos
    */
        setcookie("prueba2", "Esta es la información de cookie", time()+15);
    ?>
</body>
</html>