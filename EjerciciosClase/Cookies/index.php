<?php
// Comprobamos si se ha enviado una solicitud para eliminar la cookie
if (isset($_POST['eliminar_cookie'])) {
    // Eliminamos la cookie de idioma estableciendo su fecha de expiración en el pasado
    setcookie('idioma', '', time() - 5, "/");
    // Redirigimos a la misma página para que el usuario pueda volver a elegir un idioma
    header("Location: index.php");
    exit();
}

// Verificamos si la cookie 'idioma' está establecida
if (isset($_COOKIE['idioma'])) {
    $idioma = $_COOKIE['idioma'];

    // Dependiendo del idioma en la cookie, mostramos el contenido adecuado
    if ($idioma == 'es') {
        $mensaje = "Esta es la página en español";
    } elseif ($idioma == 'en') {
        $mensaje = "This is the English page";
    }
} else {
    // Si no existe la cookie, mostramos las opciones de idioma
    $idioma = null;
    $mensaje = null;
}

// Si se ha enviado el parámetro 'lang', guardamos la cookie del idioma seleccionado
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    // Establecemos una cookie que dura 1 día
    setcookie('idioma', $lang, time() + 5, "/");
    // Redirigimos a la misma página para evitar reenvío del formulario
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="<?php echo $idioma ? $idioma : 'en'; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Idioma</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #333;
        }

        .language-selection img {
            width: 100px;
            margin: 15px;
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .language-selection img:hover {
            transform: scale(1.1);
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        .message {
            margin: 20px 0;
        }

        .language-selection {
            margin: 20px 0;
        }
    </style>
</head>

<body>

    <div class="container">
        <?php if ($idioma): ?>
            <!-- Si existe la cookie, mostramos el mensaje en el idioma correspondiente y el botón para cambiar el idioma -->
            <h1><?php echo $mensaje; ?></h1>
            <div class="message">
                <form method="post">
                    <button type="submit" name="eliminar_cookie">Borrar cookie y cambiar idioma</button>
                </form>
            </div>
        <?php else: ?>
            <!-- Si no existe la cookie, mostramos las banderas para seleccionar el idioma -->
            <h1>Selecciona tu idioma</h1>
            <div class="language-selection">
                <a href="index.php?lang=es" title="Seleccionar Español">
                    <img src="Bandera_cruz_de_Borgoña_2.svg.png" alt="Español">
                </a>
                <a href="index.php?lang=en" title="Select English">
                    <img src="BanderaReinoUnido22.jpg" alt="English">
                </a>
            </div>
        <?php endif; ?>
    </div>

</body>

</html>