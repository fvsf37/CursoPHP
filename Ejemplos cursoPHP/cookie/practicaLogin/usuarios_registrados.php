<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table, tr, td{
            border-collapse: collapse;
            border: 2px solid red;
            margin: 2px;
            padding: 2px;
            text-align: center;
        }

    </style>

</head>
<body>

    <?php
        if (empty($_COOKIE["usuarioregistrado"])){
            
            header("location:login.php");

        }else{
            echo "Hola: " . $_COOKIE["usuarioregistrado"];
            echo "<h1>Bienvenidos Usuarios</h1>
            <p>Esto es informacion solo para usuarios registtrados</p>
            <p><a href='destruye_cookie.php'>CERRAR SESION</a></p>";

        }  
    ?>
</body>
</html>