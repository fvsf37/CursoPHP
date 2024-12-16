<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // Recogemos los valores enviados a través de la URL usando el método GET
    $busqueda_cart = $_GET["cart"];    // Código del artículo
    $busqueda_secc = $_GET["secc"];    // Sección del artículo
    $busqueda_nart = $_GET["nart"];    // Nombre del artículo
    $busqueda_pre = $_GET["pre"];      // Precio del artículo
    $busqueda_fech = $_GET["fech"];    // Fecha del artículo
    $busqueda_imp = $_GET["imp"];      // Indicador de si es importado
    $busqueda_porig = $_GET["porig"];  // País de origen del artículo
    
    // try...catch...finally se usa para manejar errores
    try {
        // Conectamos a la base de datos usando PDO
        $base = new PDO('mysql:host=localhost; dbname=pruebas', 'root', '');

        // Configuramos PDO para lanzar excepciones en caso de errores
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Establecemos el juego de caracteres a UTF-8 para manejar correctamente caracteres especiales
        $base->exec("SET CHARACTER SET utf8");

        // Preparamos una consulta SQL para insertar los datos en la tabla productos
        $sql = "INSERT INTO productos (CODIGOARTICULO, SECCION, NOMBREARTICULO, PRECIO, FECHA, IMPORTADO, PAISDEORIGEN) 
                    VALUES (:c_art, :seccion, :n_art, :precio, :fecha, :importado, :p_orig)";

        // Preparamos la consulta para su ejecución
        $resultado = $base->prepare($sql);

        // Ejecutamos la consulta, pasando los valores recibidos a través del método GET
        $resultado->execute(array(
            ":c_art" => $busqueda_cart,
            ":seccion" => $busqueda_secc,
            ":n_art" => $busqueda_nart,
            ":precio" => $busqueda_pre,
            ":fecha" => $busqueda_fech,
            ":importado" => $busqueda_imp,
            ":p_orig" => $busqueda_porig
        ));

        // Si la inserción fue exitosa, mostramos un mensaje
        echo "Registro insertado";

        // Cerramos el cursor para liberar recursos
        $resultado->closeCursor();
    } catch (Exception $e) {
        // Si ocurre un error, lo capturamos en catch y mostramos el mensaje de error
        die('Error: ' . $e->GetMessage());
    } finally {
        // El bloque finally se ejecuta siempre, haya o no errores
        // Cerramos la conexión a la base de datos asignando null a la variable
        $base = null;
    }

    ?>
</body>

</html>