<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        setcookie("idiomaSeleccionado", $_GET['idioma'], time()+86400);

        if (!$_COOKIE['idiomaSeleccionado']){
            header("Location:pagina1.php");
        }else if ($_COOKIE['idiomaSeleccionado']=='es'){
            header("Location:espana.php");
        }else{
            header("Location:ingles.php");
        }
    ?>
</body>
</html>