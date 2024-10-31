<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Cookie</title>
</head>

<body>
    <?php
    /* Para eliminar una cookie, simplemente se establece una fecha de expiración en el pasado.
       Esto provoca que el navegador elimine la cookie automáticamente.
       En este caso, estamos eliminando la cookie "prueba4". */

    // La cookie "prueba4" se establece con un tiempo de expiración en el pasado (time() - 1), lo que la elimina
    setcookie("prueba4", "Esta es la información de cookie", time() - 1, "/cursoPHP/cookie/contenido/");

    // Mensaje de confirmación
    echo "Cookie destruida correctamente";
    ?>
</body>

</html>