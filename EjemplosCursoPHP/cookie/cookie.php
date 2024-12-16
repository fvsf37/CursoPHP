<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cookie</title>
</head>

<body>
    <?php
    /* 
    Este bloque de código crea una cookie llamada "prueba4".
    El valor de la cookie será "Esta es la información de cookiezzzzzzzzzz".
    La cookie tendrá una duración de 20 segundos a partir del momento en que se ejecuta el script.
    El cuarto parámetro indica el directorio donde la cookie será válida (/cursoPHP/cookie/contenido/).
    */

    // Crear una cookie llamada "prueba4", con el valor "Esta es la información de cookiezzzzzzzzzz",
    // que expirará después de 20 segundos, y que será válida dentro de la ruta "/cursoPHP/cookie/contenido/"
    setcookie("prueba4", "Esta es la información de cookiezzzzzzzzzz", time() + 20, "/cursoPHP/cookie/contenido/");

    // Mostrar un mensaje de confirmación
    echo "Cookie creada correctamente";
    ?>
</body>

</html>