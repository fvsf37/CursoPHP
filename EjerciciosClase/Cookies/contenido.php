<?php
// Verificamos si la cookie 'idioma' está establecida
if (isset($_COOKIE['idioma'])) {
    $idioma = $_COOKIE['idioma'];

    // Dependiendo del idioma en la cookie, se muestra el contenido adecuado
    if ($idioma == 'es') {
        $mensaje = "Esta es la página en español";
    } elseif ($idioma == 'en') {
        $mensaje = "This is the English page";
    }
} else {
    // Si no existe la cookie de idioma, redirige a la página principal para seleccionar idioma
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="<?php echo $idioma; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contenido</title>
</head>

<body>
    <h1><?php echo $mensaje; ?></h1>
    <a href="eliminar_cookie.php">Cambiar idioma (Eliminar cookie)</a>
</body>

</html>