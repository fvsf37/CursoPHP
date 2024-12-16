<?php
// Configuración de la conexión a la base de datos
$db_host = "localhost";
$db_usuario = "root";
$db_nombre = "crudcesur";
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
    $query = "INSERT INTO productos (codigo, descripcion, precioVenta, precioCompra, existencias, foto) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "ssddib", $datos['codigo'], $datos['descripcion'], $datos['precioVenta'], $datos['precioCompra'], $datos['existencias'], $datos['foto']);
    return mysqli_stmt_execute($stmt);
}

// Actualiza un producto existente
function actualizarProducto($datos)
{
    global $conexion;
    $query = "UPDATE productos SET codigo=?, descripcion=?, precioVenta=?, precioCompra=?, existencias=?, foto=? WHERE id=?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "ssddibi", $datos['codigo'], $datos['descripcion'], $datos['precioVenta'], $datos['precioCompra'], $datos['existencias'], $datos['foto'], $datos['id']);
    return mysqli_stmt_execute($stmt);
}

// Elimina un producto por su id
function eliminarProducto($id)
{
    global $conexion;
    $query = "DELETE FROM productos WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    $resultado = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
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
        'buscar_codigo' => 'codigo',
        'buscar_descripcion' => 'descripcion',
        'buscar_precioVenta' => 'precioVenta',
        'buscar_precioCompra' => 'precioCompra',
        'buscar_existencias' => 'existencias'
    ];

    // Añade condiciones a la consulta según criterios
    if (!empty($criterios)) {
        foreach ($criterios as $campo => $valor) {
            if (isset($column_map[$campo])) {
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

// Obtiene un producto por su id
function obtenerProductoPorId($id)
{
    global $conexion;
    $query = "SELECT * FROM productos WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}