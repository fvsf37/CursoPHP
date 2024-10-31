<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticación Simple</title>
    <style>
        /* Estilos generales */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            text-align: left;
            color: #333;
            font-size: 16px;
        }

        input[type="text"],
        input[type="password"] {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="checkbox"] {
            margin-right: 10px;
        }

        .submit-btn {
            padding: 10px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        .message {
            font-size: 16px;
            margin-top: 20px;
            color: #333;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }
    </style>
</head>

<body>

    <div class="container">
        <?php
        // Función para destruir las cookies de sesión y recordar usuario
        function destruir_cookies()
        {
            // Destruir la cookie de usuario registrado
            setcookie("usuarioregistrado", "", time() - 30);
            // Mensaje indicando que la sesión se cerró correctamente
            echo "<h1 class='message success'>Sesión cerrada correctamente</h1>";
        }

        // Verificar si el usuario solicitó cerrar sesión (mediante el parámetro 'accion=cerrar')
        if (isset($_GET['accion']) && $_GET['accion'] == 'cerrar') {
            destruir_cookies(); // Llamada a la función que destruye las cookies
            exit; // Terminar la ejecución del script después de cerrar sesión
        }

        // Verificar si ya existe una cookie de usuario registrado
        if (!empty($_COOKIE["usuarioregistrado"])) {
            // Si la cookie está presente, el usuario está autenticado
            echo "<h1 class='message success'>Hola, " . $_COOKIE["usuarioregistrado"] . "</h1>";
            echo "<p class='message'>Bienvenido a la zona de usuarios registrados.</p>";
            // Mostrar enlace para cerrar sesión
            echo "<a href='?accion=cerrar' class='submit-btn'>Cerrar Sesión</a>";
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
                    // Si el usuario selecciona "Recordar Usuario", la cookie durará 30 segundos
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
                echo "<h1 class='message error'>Credenciales incorrectas</h1>";
            }
        }

        // Mostrar el formulario de login si el usuario no está autenticado o si no se ha enviado el formulario
        ?>
        <h1>Iniciar Sesión</h1>
        <form action="" method="post">
            <label for="login">Usuario:</label>
            <input type="text" name="login" id="login" required>

            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required>

            <label><input type="checkbox" name="recordar" id="recordar"> Recordar Usuario</label>

            <input type="submit" value="Login" class="submit-btn">
        </form>
    </div>

</body>

</html>