<?php
// Conexión a la base de datos
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

// Función para insertar un producto
function insertarProducto($datos)
{
    global $conexion;
    $query = "INSERT INTO productos (CODIGOARTICULO, SECCION, NOMBREARTICULO, PRECIO, FECHA, IMPORTADO, PAISDEORIGEN) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "sssssss", $datos['codigo'], $datos['seccion'], $datos['nombre'], $datos['precio'], $datos['fecha'], $datos['importado'], $datos['pais']);
    return mysqli_stmt_execute($stmt);
}

// Función para actualizar un producto
function actualizarProducto($datos)
{
    global $conexion;
    $query = "UPDATE productos SET SECCION=?, NOMBREARTICULO=?, PRECIO=?, FECHA=?, IMPORTADO=?, PAISDEORIGEN=? WHERE CODIGOARTICULO=?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "sssssss", $datos['seccion'], $datos['nombre'], $datos['precio'], $datos['fecha'], $datos['importado'], $datos['pais'], $datos['codigo_original']);
    return mysqli_stmt_execute($stmt);
}

// Función para eliminar un producto
function eliminarProducto($codigo)
{
    global $conexion;
    $query = "DELETE FROM productos WHERE CODIGOARTICULO=?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "s", $codigo);
    return mysqli_stmt_execute($stmt);
}

// Función para obtener productos con búsqueda avanzada
function obtenerProductos($criterios = [])
{
    global $conexion;
    $query = "SELECT * FROM productos WHERE 1=1";
    $params = [];
    $types = "";

    // Agrega condiciones de búsqueda avanzada
    if (!empty($criterios['buscar_codigo'])) {
        $query .= " AND CODIGOARTICULO LIKE ?";
        $params[] = "%" . $criterios['buscar_codigo'] . "%";
        $types .= "s";
    }
    if (!empty($criterios['buscar_nombre'])) {
        $query .= " AND NOMBREARTICULO LIKE ?";
        $params[] = "%" . $criterios['buscar_nombre'] . "%";
        $types .= "s";
    }
    if (!empty($criterios['buscar_seccion'])) {
        $query .= " AND SECCION LIKE ?";
        $params[] = "%" . $criterios['buscar_seccion'] . "%";
        $types .= "s";
    }
    if (!empty($criterios['buscar_precio'])) {
        $query .= " AND PRECIO = ?";
        $params[] = $criterios['buscar_precio'];
        $types .= "d";
    }
    if (!empty($criterios['buscar_importado'])) {
        $query .= " AND IMPORTADO = ?";
        $params[] = $criterios['buscar_importado'];
        $types .= "s";
    }
    if (!empty($criterios['buscar_pais'])) {
        $query .= " AND PAISDEORIGEN LIKE ?";
        $params[] = "%" . $criterios['buscar_pais'] . "%";
        $types .= "s";
    }

    $stmt = mysqli_prepare($conexion, $query);

    if (!empty($params)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}

// Funciones CRUD para la tabla libros

// Función para insertar un libro
function insertarLibro($datos)
{
    global $conexion;
    $query = "INSERT INTO libros (titulo, autor, genero, anio_publicacion, precio, stock, editorial) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "sssidsi", $datos['titulo'], $datos['autor'], $datos['genero'], $datos['anio'], $datos['precio'], $datos['stock'], $datos['editorial']);
    return mysqli_stmt_execute($stmt);
}

// Función para actualizar un libro
function actualizarLibro($datos)
{
    global $conexion;
    $query = "UPDATE libros SET titulo=?, autor=?, genero=?, anio_publicacion=?, precio=?, stock=?, editorial=? WHERE id=?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "sssidsii", $datos['titulo'], $datos['autor'], $datos['genero'], $datos['anio'], $datos['precio'], $datos['stock'], $datos['editorial'], $datos['codigo_original']);
    return mysqli_stmt_execute($stmt);
}

// Función para eliminar un libro
function eliminarLibro($id)
{
    global $conexion;
    $query = "DELETE FROM libros WHERE id=?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    return mysqli_stmt_execute($stmt);
}

// Función para obtener libros con búsqueda avanzada
function obtenerLibros($criterios = [])
{
    global $conexion;
    $query = "SELECT * FROM libros WHERE 1=1";
    $params = [];
    $types = "";

    // Agrega condiciones de búsqueda avanzada
    if (!empty($criterios['buscar_titulo'])) {
        $query .= " AND titulo LIKE ?";
        $params[] = "%" . $criterios['buscar_titulo'] . "%";
        $types .= "s";
    }
    if (!empty($criterios['buscar_autor'])) {
        $query .= " AND autor LIKE ?";
        $params[] = "%" . $criterios['buscar_autor'] . "%";
        $types .= "s";
    }
    if (!empty($criterios['buscar_genero'])) {
        $query .= " AND genero LIKE ?";
        $params[] = "%" . $criterios['buscar_genero'] . "%";
        $types .= "s";
    }
    if (!empty($criterios['buscar_anio'])) {
        $query .= " AND anio_publicacion = ?";
        $params[] = $criterios['buscar_anio'];
        $types .= "i";
    }
    if (!empty($criterios['buscar_precio'])) {
        $query .= " AND precio = ?";
        $params[] = $criterios['buscar_precio'];
        $types .= "d";
    }
    if (!empty($criterios['buscar_editorial'])) {
        $query .= " AND editorial LIKE ?";
        $params[] = "%" . $criterios['buscar_editorial'] . "%";
        $types .= "s";
    }

    $stmt = mysqli_prepare($conexion, $query);

    if (!empty($params)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}

// Función para obtener un producto por su código
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


// Función para obtener un libro por su ID
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
