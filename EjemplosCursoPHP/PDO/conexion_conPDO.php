<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // La estructura try...catch...finally permite manejar errores de forma controlada
    // "try" se usa para intentar ejecutar código que puede generar un error.
    // Si ocurre un error dentro del bloque try, el control pasará al bloque catch
    
    try {
        // Intentamos crear una conexión a la base de datos usando PDO
        // La clase PDO se utiliza para conectar a la base de datos de forma más segura y flexible
        // 'mysql:host=localhost; dbname=pruebas' especifica el servidor de base de datos y el nombre de la base de datos
        // 'root' es el usuario y '' (vacío) es la contraseña en este caso
        $base = new PDO('mysql:host=localhost; dbname=pruebas', 'root', '');

        // Si la conexión se realiza correctamente, mostramos un mensaje
        echo "Conexión OK";

    } catch (Exception $e) {
        // Si ocurre un error al conectar a la base de datos, capturamos la excepción y ejecutamos este bloque
        // "GetMessage()" obtiene el mensaje de error que genera la excepción
        die('Error: ' . $e->GetMessage()); // Mostramos el mensaje de error y detenemos la ejecución del script
    } finally {
        // El bloque "finally" siempre se ejecuta, independientemente de si hubo un error o no
        // Liberamos la conexión a la base de datos asignando null a la variable $base
        $base = null; // Esto libera los recursos de la conexión con la base de datos
    }

    ?>
</body>

</html>