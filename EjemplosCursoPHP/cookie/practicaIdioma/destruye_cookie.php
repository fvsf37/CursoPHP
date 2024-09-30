<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    /* Para eliminar una cookie basta con decirle un tiempo anteior, un tiempo negativo en defiitiva*/
        setcookie("idiomaSeleccionado", "Fin de la Cookie", time()-1);
        echo "<h1>Cookie destruida correctamente</h1>";
    ?>
</body>
</html>