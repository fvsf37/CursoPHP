<?php

// Parámetros de conexión
$db_host = "localhost";
$db_usuario = "root";
$db_nombre = "pruebas";
$db_contra = "";

// Conexión a la base de datos
$conexion = mysqli_connect($db_host, $db_usuario, $db_contra, $db_nombre);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Función para crear un producto
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
    $query = "UPDATE productos SET CODIGOARTICULO=?, SECCION=?, NOMBREARTICULO=?, PRECIO=?, FECHA=?, IMPORTADO=?, PAISDEORIGEN=? WHERE CODIGOARTICULO=?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "ssssssss", $datos['codigo'], $datos['seccion'], $datos['nombre'], $datos['precio'], $datos['fecha'], $datos['importado'], $datos['pais'], $datos['codigo_original']);
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

// Función para obtener productos con búsqueda avanzada y filtro de NULL
function obtenerProductos($criterios = [])
{
    global $conexion;
    $query = "SELECT * FROM productos WHERE CODIGOARTICULO IS NOT NULL AND SECCION IS NOT NULL AND NOMBREARTICULO IS NOT NULL AND PRECIO IS NOT NULL";
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
        $types .= "d"; // Tipo de dato decimal o float
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

    // Verifica si hay parámetros para vincular
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
    $query = "SELECT * FROM productos WHERE CODIGOARTICULO=?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "s", $codigo);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt)->fetch_assoc();
}
