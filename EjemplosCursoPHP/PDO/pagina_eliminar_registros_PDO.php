<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // Recoge el valor del código del artículo que se va a eliminar, enviado a través del método GET
    $busqueda_cart = $_GET["cart"];

    // try...catch...finally es una estructura para manejar errores de manera controlada
    try {
        // Crear una nueva conexión a la base de datos usando PDO
        $base = new PDO('mysql:host=localhost; dbname=pruebas', 'root', '');

        // Configurar PDO para lanzar excepciones en caso de errores en las operaciones de base de datos
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Establecer el conjunto de caracteres UTF-8 para manejar correctamente caracteres especiales
        $base->exec("SET CHARACTER SET utf8");

        // Preparar la consulta SQL para eliminar un registro de la tabla 'productos' donde el 'CODIGOARTICULO' coincida
        $sql = "DELETE FROM productos WHERE CODIGOARTICULO=:c_art";

        // Preparamos la consulta usando el método prepare()
        $resultado = $base->prepare($sql);

        // Ejecutar la consulta, pasando el valor del artículo a eliminar mediante un array asociativo
        $resultado->execute(array(":c_art" => $busqueda_cart));

        // Mensaje de éxito si se borra el registro
        echo "Registro borrado";

        // Cerramos el cursor del resultado para liberar recursos
        $resultado->closeCursor();

    } catch (Exception $e) {
        // Captura cualquier error que ocurra durante la conexión o la ejecución de la consulta
        // Muestra un mensaje de error y detiene el script
        die('Error: ' . $e->GetMessage());
    } finally {
        // Este bloque se ejecuta siempre, tanto si hay error como si no
        // Cerramos la conexión a la base de datos asignando null a la variable
        $base = null;
    }
    ?>
</body>

</html>