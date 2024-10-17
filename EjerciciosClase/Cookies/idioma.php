<?php
// Si se ha enviado el parámetro "lang", guardamos la cookie del idioma seleccionado
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    // Establecemos una cookie
    setcookie('idioma', $lang, time() + 30, "/");
    // Redirigimos a la página principal (index.php)
    header("Location: index.php");
    exit();
}
?>