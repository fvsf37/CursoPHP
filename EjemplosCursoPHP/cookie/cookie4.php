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
    La cookie se crea en el momenot que se abre el navegaodr, toma nota de la hora, min y segundos y la creará durante 30 segundos
    El cuarto parámetro hace referencia al directorio de actuación
    */
        setcookie("prueba4", "Esta es la información de cookiezzzzzzzzzz", time()+20, "/cursoPHP/cookie/contenido/");
        echo "Cookie creada correctamente";
    ?>
</body>
</html>