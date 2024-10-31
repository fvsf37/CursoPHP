<?php

// Reanudamos la sesión que está activa, de modo que podamos acceder a los datos de la sesión actual
session_start();

// Destruimos la sesión actual, eliminando todos los datos almacenados en la sesión
session_destroy();

// Redirigimos al usuario a la página de inicio de sesión "login_3.php"
// Podrías redirigir a otra página de despedida, o a una página de "Hasta luego" si lo prefieres
header("Location:login_3.php");

?>