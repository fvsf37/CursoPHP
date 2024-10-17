<?php
setcookie('idioma', '', time() - 5, "/");
header("Location: index.php");
exit();
?>