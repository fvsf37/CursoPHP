<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        fieldset {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        legend {
            font-size: 1.2em;
            font-weight: bold;
            color: #333;
        }

        p {
            margin: 10px 0;
        }

        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        a {
            text-decoration: none;
            color: #28a745;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_COOKIE["rememberme"])) {
        header("Location:main-page.php");
    }
    ?>

    <h2>Inicio de sesión</h2>
    <form action="redirect.php" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Inicia sesión</legend>
            <?php
            //Recoge el dato almacenado de SESSION['error'] en caso de existir y muestra el error
            session_start();
            if (isset($_SESSION['error'])) {
                echo "<p style='color:red;'>" . $_SESSION['error'] . "</p>";
                unset($_SESSION['error']);
            }
            ?>
            <p>Usuario: <input type="text" name="user" id="user"></p>
            <p>Contraseña: <input type="password" name="password" id="password"></p>
            <p>Recordarme? <input type="checkbox" name="remember" id="remember"></p>

            <p>¿No tienes cuenta? <a href="signup.php">Regístrate</a></p>
            <p><input type="submit" value="Iniciar sesión"></p>
        </fieldset>
    </form>

</body>

</html>