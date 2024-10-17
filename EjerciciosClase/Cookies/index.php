<?php
// Comprobamos si la cookie 'idioma' existe
if (isset($_COOKIE['idioma'])) {
    $idioma = $_COOKIE['idioma'];

    // Dependiendo del idioma almacenado en la cookie, mostramos el contenido adecuado
    if ($idioma == 'es') {
        $mensaje = "Bienvenido, has seleccionado Español";
    } elseif ($idioma == 'en') {
        $mensaje = "Welcome, you have selected English";
    }
} else {
    // Si no existe la cookie, mostramos las opciones de idioma
    $idioma = null;
    $mensaje = null;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Idioma</title>
</head>

<body>

    <?php if ($idioma): ?>
        <!-- Si existe la cookie, mostramos el mensaje y el botón para cambiar el idioma -->
        <h1><?php echo $mensaje; ?></h1>
        <form action="eliminar_cookie.php" method="post">
            <button type="submit">Borrar cookie y cambiar idioma</button> <!-- Botón para borrar la cookie -->
        </form>
    <?php else: ?>
        <!-- Si no existe la cookie, mostramos las banderas para seleccionar el idioma -->
        <h1>Selecciona tu idioma</h1>
        <a href="idioma.php?lang=es"><img src="Bandera_cruz_de_Borgoña_2.svg.png" alt="Español" style="width:50px;"></a>
        <a href="idioma.php?lang=en"><img src="BanderaReinoUnido22.jpg" alt="Inglés" style="width:50px;"></a>
    <?php endif; ?>

</body>

</html>