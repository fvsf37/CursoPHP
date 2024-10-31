<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Cookie</title>
</head>

<body>
    <?php
    /* Verificamos si la cookie llamada "prueba4" ha sido creada usando la superglobal $_COOKIE */

    // Usamos la función isset() para verificar si la cookie "prueba4" existe
    if (isset($_COOKIE["prueba4"])) {
        // Si la cookie existe, mostramos su valor
        echo $_COOKIE["prueba4"];
    } else {
        // Si la cookie no existe o ha expirado, mostramos un mensaje informando que no está disponible
        echo "LA COOKIE NO SE HA CREADO";
    }
    ?>
</body>

</html>