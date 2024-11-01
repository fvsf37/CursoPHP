<?php
session_start(); // Inicia la sesión
session_destroy(); // Destruye toda la información de la sesión
header("Location: login.php"); // Redirige al usuario a la página de login
exit(); // Termina el script
?>