<?php
session_start();
session_destroy(); // Elimina todos los datos de la sesión
header("Location: login.php");
exit();
?>
