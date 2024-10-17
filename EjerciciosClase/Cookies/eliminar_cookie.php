<?php
// Eliminamos la cookie de idioma estableciendo su fecha de expiración en el pasado
setcookie('idioma', '', time() - 30, "/");

// Redirigimos a la página principal para que el usuario pueda volver a elegir el idioma
header("Location: index.php");
exit();
?>