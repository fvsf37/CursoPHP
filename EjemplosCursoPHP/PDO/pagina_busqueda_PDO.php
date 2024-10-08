<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // Recogemos el valor de búsqueda enviado a través del formulario por el método GET
    $busqueda = $_GET["buscar"];

    // Estructura try...catch...finally para manejar errores en la conexión o ejecución
    try {
        // Crear una conexión con la base de datos usando PDO (host=localhost, base de datos=pruebas)
        $base = new PDO('mysql:host=localhost; dbname=pruebas', 'root', '');

        // Configurar PDO para que arroje excepciones en caso de error
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Establecer el conjunto de caracteres UTF-8 para la conexión
        $base->exec("SET CHARACTER SET utf8");

        // Preparar la consulta SQL con un parámetro (marcado con ?)
        // La consulta buscará un artículo cuyo nombre coincida con lo que el usuario introdujo en el campo "buscar"
        $sql = "SELECT CODIGOARTICULO, SECCION, NOMBREARTICULO, PRECIO, FECHA, IMPORTADO, PAISDEORIGEN FROM productos WHERE NOMBREARTICULO=?";

        // Preparamos la consulta para su ejecución con el método prepare() de PDO
        $resultado = $base->prepare($sql);

        // Ejecutamos la consulta, pasando el valor de $busqueda como parámetro
        // Esto sustituye el ? de la consulta SQL por el valor introducido por el usuario
        $resultado->execute(array($busqueda));

        // Recorremos los resultados de la consulta con un bucle while y la función fetch(PDO::FETCH_ASSOC)
        // Se obtienen los resultados como un array asociativo
        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
            // Imprimimos los valores de cada columna en una tabla HTML
            echo "<table><tr><td>";
            echo $registro['CODIGOARTICULO'] . "</td><td>";  // Código del artículo
            echo $registro['SECCION'] . "</td><td>";         // Sección del artículo
            echo $registro['NOMBREARTICULO'] . "</td><td>";  // Nombre del artículo
            echo $registro['PRECIO'] . "</td><td>";          // Precio del artículo
            echo $registro['FECHA'] . "</td><td>";           // Fecha de registro
            echo $registro['IMPORTADO'] . "</td><td>";       // Si es importado o no
            echo $registro['PAISDEORIGEN'] . "</td></tr></table>"; // País de origen
        }

        // Cerrar el cursor después de recorrer los resultados
        $resultado->closeCursor();
    } catch (Exception $e) {
        // Si se produce un error, lo capturamos con catch
        // Mostramos el mensaje de error con $e->GetMessage() y detenemos la ejecución
        die('Error: ' . $e->GetMessage());
    } finally {
        // El bloque finally se ejecuta siempre, haya o no errores
        // Aquí liberamos la conexión con la base de datos asignando null a la variable $base
        $base = null;
    }

    ?>
</body>

</html>