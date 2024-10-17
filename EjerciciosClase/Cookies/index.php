<?php
// Verificamos si la cookie idioma está establecida
if (isset($_COOKIE['idioma'])) {
    $idioma = $_COOKIE['idioma'];

    if ($idioma == 'es') {
        $mensaje = "Esta es la página en español";
    } elseif ($idioma == 'en') {
        $mensaje = "This is the English page";
    }
} else {
    $idioma = null;
    $mensaje = null;
}

// Si se ha enviado el parámetro lang, guardamos la cookie del idioma seleccionado
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    setcookie('idioma', $lang, time() + 5, "/");
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="<?php echo $idioma ? $idioma : 'en'; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Idioma</title>
</head>

<body>

    <?php if ($idioma): ?>
        <h1><?php echo $mensaje; ?></h1>
        <form action="eliminar_cookie.php" method="post">
            <button type="submit">Borrar cookie y cambiar idioma</button>
        </form>
    <?php else: ?>
        <h1>Selecciona tu idioma</h1>
        <a href="index.php?lang=es"><img src="Bandera_cruz_de_Borgoña_2.svg.png" alt="Español" style="width:50px;"></a>
        <a href="index.php?lang=en"><img src="BanderaReinoUnido22.jpg" alt="Inglés" style="width:50px;"></a>
    <?php endif; ?>

</body>

</html>