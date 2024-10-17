<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticación Simple</title>
</head>

<body>

    <?php
    // Función para destruir las cookies de sesión y recordar usuario
    function destruir_cookies()
    {
        // Destruir la cookie de usuario registrado
        setcookie("usuarioregistrado", "", time() - 30);
        // Mensaje indicando que la sesión se cerró correctamente
        echo "<h1>Sesión cerrada correctamente</h1>";
    }

    // Verificar si el usuario solicitó cerrar sesión (mediante el parámetro 'accion=cerrar')
    if (isset($_GET['accion']) && $_GET['accion'] == 'cerrar') {
        destruir_cookies(); // Llamada a la función que destruye las cookies
        exit; // Terminar la ejecución del script después de cerrar sesión
    }

    // Verificar si ya existe una cookie de usuario registrado
    if (!empty($_COOKIE["usuarioregistrado"])) {
        // Si la cookie está presente, el usuario está autenticado, mostrar saludo y opción de cerrar sesión
        echo "<h1>Hola, " . $_COOKIE["usuarioregistrado"] . "</h1>";
        echo "<p>Bienvenido a la zona de usuarios registrados.</p>";
        echo "<p><a href='?accion=cerrar'>Cerrar Sesión</a></p>";
        exit; // Terminar la ejecución aquí si el usuario ya está autenticado
    }

    // Procesar el formulario de login cuando se envía una solicitud POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Sanitizar los datos de entrada (login y contraseña)
        $login = htmlentities(addslashes($_POST["login"]));
        $password = htmlentities(addslashes($_POST["password"]));
        $recordar = isset($_POST["recordar"]); // Verificar si el checkbox de "Recordar Usuario" está marcado
    
        // Validación de credenciales (simulación con un array de usuarios válidos)
        $usuarios_validos = [
            "usuario1" => "password1",
            "usuario2" => "password2"
        ];

        // Verificar si las credenciales son correctas
        if (array_key_exists($login, $usuarios_validos) && $usuarios_validos[$login] == $password) {
            // Si las credenciales son válidas
            if ($recordar) {
                // Si el usuario selecciona "Recordar Usuario", la cookie durará 1 día
                setcookie("usuarioregistrado", $login, time() + 30);
            } else {
                // Si no selecciona "Recordar Usuario", la cookie durará solo hasta que se cierre el navegador (cookie de sesión)
                setcookie("usuarioregistrado", $login);
            }
            // Redirigir al mismo archivo para evitar el reenvío del formulario
            header("Location: " . $_SERVER['PHP_SELF']);
            exit; // Terminar la ejecución después de la redirección
        } else {
            // Si las credenciales son incorrectas, mostrar un mensaje de error
            echo "<h1>Credenciales incorrectas</h1>";
        }
    }

    // Mostrar el formulario de login si el usuario no está autenticado o si no se ha enviado el formulario
    ?>
    <h1>Iniciar Sesión</h1>
    <form action="" method="post">
        <label for="login">Usuario:</label>
        <input type="text" name="login" id="login" required><br><br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required><br><br>
        <label for="recordar">Recordar Usuario</label>
        <input type="checkbox" name="recordar" id="recordar"><br><br>
        <input type="submit" value="Login">
    </form>

</body>

</html>