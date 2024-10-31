<?php

<<<<<<< HEAD
session_start(); //reanudamos la sesion que está abierta
session_destroy(); //destruimos la sesion
header("Location:login_3.php"); //Redireccionamo al login. Aunque podriamos redireccionar a otra página que diga hasta luego
=======
// Reanudamos la sesión que está activa, de modo que podamos acceder a los datos de la sesión actual
session_start();

// Destruimos la sesión actual, eliminando todos los datos almacenados en la sesión
session_destroy();

// Redirigimos al usuario a la página de inicio de sesión "login_3.php"
// Podrías redirigir a otra página de despedida, o a una página de "Hasta luego" si lo prefieres
header("Location:login_3.php");
>>>>>>> 7a93cebd5afbddf3294ef3a87752beb87e361cbd

?>