<?php

session_start(); //reanudamos la sesion que está abierta
session_destroy(); //destruimos la sesion
header("Location:login_3.php"); //Redireccionamo al login. Aunque podriamos redireccionar a otra página que diga hasta luego

?>