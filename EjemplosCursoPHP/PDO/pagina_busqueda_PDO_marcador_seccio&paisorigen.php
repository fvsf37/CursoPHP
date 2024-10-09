<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // Recogemos los valores de los parámetros enviados mediante GET
    $busqueda_sec = $_GET["seccion"];      // Sección del artículo que se está buscando
    $busqueda_porig = $_GET["paisdeorigen"]; // País de origen del artículo que se está buscando
    
    // Estructura try...catch...finally para manejar errores en la conexión y ejecución de la consulta
    try {
        // Creamos una nueva conexión con PDO a la base de datos llamada "pruebas"
        $base = new PDO('mysql:host=localhost; dbname=pruebas', 'root', '');

        // Configuramos PDO para lanzar excepciones en caso de errores
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Establecemos el conjunto de caracteres a UTF-8 para manejar correctamente caracteres especiales
        $base->exec("SET CHARACTER SET utf8");

        // Creamos una consulta SQL para buscar productos que coincidan con la sección y el país de origen
        // Usamos marcadores ":m_sec" y ":m_porig" para valores que luego se reemplazarán en la consulta
        $sql = "SELECT CODIGOARTICULO, SECCION, NOMBREARTICULO, PRECIO, FECHA, IMPORTADO, PAISDEORIGEN 
                FROM productos 
                WHERE SECCION = :m_sec AND PAISDEORIGEN = :m_porig";

        // Preparamos la consulta para su ejecución
        $resultado = $base->prepare($sql);

        // Ejecutamos la consulta pasando los valores a los marcadores
        $resultado->execute(array(":m_sec" => $busqueda_sec, ":m_porig" => $busqueda_porig));

        // Recorremos los resultados de la consulta y mostramos los datos en una tabla HTML
        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
            // Imprimimos cada columna de la fila obtenida en una tabla
            echo "<table><tr><td>";
            echo $registro['CODIGOARTICULO'] . "</td><td>";  // Código del artículo
            echo $registro['SECCION'] . "</td><td>";         // Sección
            echo $registro['NOMBREARTICULO'] . "</td><td>";  // Nombre del artículo
            echo $registro['PRECIO'] . "</td><td>";          // Precio del artículo
            echo $registro['FECHA'] . "</td><td>";           // Fecha de registro
            echo $registro['IMPORTADO'] . "</td><td>";       // Si es importado o no
            echo $registro['PAISDEORIGEN'] . "</td></tr></table>"; // País de origen
        }

        // Cerramos el cursor del resultado después de recorrer todos los registros
        $resultado->closeCursor();
    } catch (Exception $e) {
        // Si ocurre un error, lo capturamos en el bloque catch y mostramos un mensaje con el error
        die('Error: ' . $e->GetMessage());
    } finally {
        // En el bloque finally siempre liberamos la conexión a la base de datos
        $base = null;
    }
    ?>
</body>

</html>