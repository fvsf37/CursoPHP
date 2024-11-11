<?php
// Configuración de la conexión a la base de datos
$db_host = "localhost";
$db_usuario = "root";
$db_nombre = "pruebas";
$db_contra = "";

// Conexión a la base de datos
$conexion = mysqli_connect($db_host, $db_usuario, $db_contra, $db_nombre);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Funciones CRUD para la tabla productos

// Inserta un producto en la tabla productos
function insertarProducto($datos)
{
    global $conexion;
    $query = "INSERT INTO productos (CODIGOARTICULO, SECCION, NOMBREARTICULO, PRECIO, FECHA, IMPORTADO, PAISDEORIGEN) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "sssssss", $datos['codigo'], $datos['seccion'], $datos['nombre'], $datos['precio'], $datos['fecha'], $datos['importado'], $datos['pais']);
    return mysqli_stmt_execute($stmt);
}

// Actualiza un producto existente
function actualizarProducto($datos)
{
    global $conexion;
    $query = "UPDATE productos SET SECCION=?, NOMBREARTICULO=?, PRECIO=?, FECHA=?, IMPORTADO=?, PAISDEORIGEN=? WHERE CODIGOARTICULO=?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "sssssss", $datos['seccion'], $datos['nombre'], $datos['precio'], $datos['fecha'], $datos['importado'], $datos['pais'], $datos['codigo_original']);
    return mysqli_stmt_execute($stmt);
}

// Elimina un producto por su código
function eliminarProducto($codigo)
{
    global $conexion;
    $query = "DELETE FROM productos WHERE CODIGOARTICULO=?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "s", $codigo);
    return mysqli_stmt_execute($stmt);
}

// Obtiene productos con búsqueda avanzada según criterios
function obtenerProductos($criterios = [])
{
    global $conexion;
    $query = "SELECT * FROM productos WHERE 1=1";
    $params = [];
    $types = "";

    // Mapeo de criterios a columnas de la tabla productos
    $column_map = [
        'buscar_codigo' => 'CODIGOARTICULO',
        'buscar_nombre' => 'NOMBREARTICULO',
        'buscar_seccion' => 'SECCION',
        'buscar_precio' => 'PRECIO',
        'buscar_importado' => 'IMPORTADO',
        'buscar_pais' => 'PAISDEORIGEN'
    ];

    // Añade condiciones a la consulta según criterios
    if (!empty($criterios)) {
        foreach ($criterios as $campo => $valor) {
            if (isset($column_map[$campo])) {  // Verifica que el criterio existe en el mapa
                $query .= " AND " . $column_map[$campo] . " LIKE ?";
                $params[] = "%" . $valor . "%";
                $types .= "s";
            }
        }
    }

    $stmt = mysqli_prepare($conexion, $query);

    if (!empty($params)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}

// Funciones CRUD para la tabla libros

// Inserta un libro en la tabla libros
function insertarLibro($datos)
{
    global $conexion;
    $query = "INSERT INTO libros (titulo, autor, genero, anio_publicacion, precio, stock, editorial) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "sssidsi", $datos['titulo'], $datos['autor'], $datos['genero'], $datos['anio'], $datos['precio'], $datos['stock'], $datos['editorial']);
    return mysqli_stmt_execute($stmt);
}

// Actualiza un libro existente
function actualizarLibro($datos)
{
    global $conexion;
    $query = "UPDATE libros SET titulo=?, autor=?, genero=?, anio_publicacion=?, precio=?, stock=?, editorial=? WHERE id=?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "sssidsii", $datos['titulo'], $datos['autor'], $datos['genero'], $datos['anio'], $datos['precio'], $datos['stock'], $datos['editorial'], $datos['codigo_original']);
    return mysqli_stmt_execute($stmt);
}

// Elimina un libro por su ID
function eliminarLibro($id)
{
    global $conexion;
    $query = "DELETE FROM libros WHERE id=?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    return mysqli_stmt_execute($stmt);
}

// Obtiene libros con búsqueda avanzada según criterios
function obtenerLibros($criterios = [])
{
    global $conexion;
    $query = "SELECT * FROM libros WHERE 1=1";
    $params = [];
    $types = "";

    // Mapeo de criterios a columnas de la tabla libros
    $column_map = [
        'buscar_titulo' => 'titulo',
        'buscar_autor' => 'autor',
        'buscar_genero' => 'genero',
        'buscar_anio' => 'anio_publicacion',
        'buscar_precio' => 'precio',
        'buscar_editorial' => 'editorial'
    ];

    // Añade condiciones a la consulta según criterios
    if (!empty($criterios)) {
        foreach ($criterios as $campo => $valor) {
            if (isset($column_map[$campo])) {  // Verifica que el criterio existe en el mapa
                $query .= " AND " . $column_map[$campo] . " LIKE ?";
                $params[] = "%" . $valor . "%";
                $types .= "s";
            }
        }
    }

    $stmt = mysqli_prepare($conexion, $query);

    if (!empty($params)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}

// Obtiene un producto por su código
function obtenerProductoPorCodigo($codigo)
{
    global $conexion;
    $query = "SELECT * FROM productos WHERE CODIGOARTICULO = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "s", $codigo);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result); // Retorna un array asociativo o null si no se encuentra
}

// Obtiene un libro por su ID
function obtenerLibroPorId($id)
{
    global $conexion;
    $query = "SELECT * FROM libros WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result); // Retorna un array asociativo o null si no se encuentra
}
