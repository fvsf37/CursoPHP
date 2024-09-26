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
        setcookie("prueba4", "Esta es la información de cookie", time()-1, "/cursoPHP/cookie/contenido/");
        echo "Cookie destruida correctamente";
    ?>
</body>
</html>