<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // Recogemos el valor que se ha introducido en el formulario (enviado por método GET)
    $busqueda = $_GET["buscar"];

    // try...catch...finally: Se usa para manejar errores de forma controlada
    try {
        // Creando la conexión a la base de datos usando PDO (host: localhost, base de datos: pruebas)
        $base = new PDO('mysql:host=localhost; dbname=pruebas', 'root', '');

        // Configuramos PDO para que arroje excepciones en caso de errores
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Establecemos el juego de caracteres a UTF-8 para manejar correctamente caracteres especiales
        $base->exec("SET CHARACTER SET utf8");

        // Consulta SQL con marcador ":n_art" para buscar un artículo cuyo nombre coincida con el valor proporcionado
        $sql = "SELECT CODIGOARTICULO, SECCION, NOMBREARTICULO, PRECIO, FECHA, IMPORTADO, PAISDEORIGEN FROM productos WHERE NOMBREARTICULO = :n_art";

        // Preparamos la consulta usando PDO para prevenir inyecciones SQL
        $resultado = $base->prepare($sql);

        // Ejecutamos la consulta pasando el valor de $busqueda como parámetro para el marcador ":n_art"
        $resultado->execute(array(":n_art" => $busqueda));

        // Recorremos los resultados de la consulta y los mostramos en una tabla HTML
        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
            // Imprimir los valores del producto en formato de tabla HTML
            echo "<table><tr><td>";
            echo $registro['CODIGOARTICULO'] . "</td><td>";   // Código del artículo
            echo $registro['SECCION'] . "</td><td>";          // Sección
            echo $registro['NOMBREARTICULO'] . "</td><td>";   // Nombre del artículo
            echo $registro['PRECIO'] . "</td><td>";           // Precio
            echo $registro['FECHA'] . "</td><td>";            // Fecha de registro
            echo $registro['IMPORTADO'] . "</td><td>";        // Importado o no
            echo $registro['PAISDEORIGEN'] . "</td></tr></table>"; // País de origen
        }

        // Cerramos el cursor del resultado para liberar los recursos
        $resultado->closeCursor();

    } catch (Exception $e) {
        // Si ocurre un error, lo capturamos y mostramos un mensaje
        die('Error: ' . $e->getMessage());
    } finally {
        // Liberamos la conexión a la base de datos
        $base = null;
    }
    ?>
</body>

</html>