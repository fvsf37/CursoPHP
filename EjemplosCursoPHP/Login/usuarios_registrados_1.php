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

//Poneos código php aquí antes de mostrar el contenido  del html, comprobando que la sesión está abierta y es correcta

        session_start();
        if (!isset($_SESSION["usuario"])){
            header("Location:login_3.php");
        }
        echo "HOLA: ". $_SESSION["usuario"] . "<br>";
    ?>



    <h1>Bienvenidos Usuarios</h1>
    <p>Esto es informacion solo para usuarios registtrados</p>
    <table>
        <tr>
            <td colspan="3">ZONA USUARIOS REGISTRADOS</td>
        </tr>
        <tr>
            <td><a href="usuarios_registrados_2.php">Pagina 1</a></td>
            <td><a href="usuarios_registrados_3.php">Pagina 2</a></td>
            <td><a href="usuarios_registrados_4.php">Pagina 3</a></td>
        </tr>
    </table>
    <p><a href="cierre.php">CERRAR SESION</a></p>
</body>
</html>