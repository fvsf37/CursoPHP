<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mostrar lo que se está recibiendo desde el formulario
    echo "Usuario: " . $_POST['login'] . "<br>";
    echo "Contraseña: " . $_POST['password'] . "<br>";

    // Escapamos los datos introducidos por el usuario
    $login = htmlentities(addslashes($_POST['login']));
    $password = htmlentities(addslashes($_POST['password']));

    try {
        // Conexión a la base de datos
        $base = new PDO('mysql:host=localhost;dbname=prueba', 'root', '');
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta para buscar el usuario por el nombre de usuario
        $sql = "SELECT * FROM autentificacion WHERE nombreusuario = :login";
        $resultado = $base->prepare($sql);
        $resultado->bindValue(':login', $login);
        $resultado->execute();

        // Verificamos si encontramos al usuario
        if ($resultado->rowCount() > 0) {
            $registro = $resultado->fetch(PDO::FETCH_ASSOC);

            // Comparar la contraseña en texto plano (sin cifrado)
            if ($password == $registro['contraseña']) {
                // Almacenar el nombre de usuario en la sesión
                $_SESSION['usuario'] = $registro['nombreusuario'];

                // Redirigimos al CRUD si el login es exitoso
                header('Location: crud.php');
                exit();
            } else {
                echo "Contraseña incorrecta.";
                header('Location: login.php?error=incorrect_password');
            }
        } else {
            echo "Usuario no encontrado.";
            header('Location: login.php?error=user_not_found');
        }
    } catch (Exception $e) {
        // Si ocurre algún error, mostramos el mensaje
        die('Error: ' . $e->getMessage());
    }
}
