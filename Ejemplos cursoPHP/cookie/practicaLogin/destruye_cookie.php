<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        setcookie("usuarioregistrado", "Fin de la Cookie", time()-1);
        echo "<h1>Cookie USUARIO REGISTRADO destruida correctamente</h1>";

        setcookie("marcadoRecordar", "Fin de la Cookie", time()-1);
        echo "<h1>Cookie MARCADO RECORDAR destruida correctamente</h1>";
    ?>
</body>
</html>