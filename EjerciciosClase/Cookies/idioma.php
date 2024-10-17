<?php
// Si se ha enviado el parámetro "lang", guardamos la cookie del idioma seleccionado
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    setcookie('idioma', $lang, time() + 5, "/");
    header("Location: index.php");
    exit();
}
?>