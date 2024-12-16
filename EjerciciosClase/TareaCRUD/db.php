<?php
session_start();

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

// Función para obtener todos los productos o filtrar por búsqueda
function obtenerProductos($buscar = "")
{
    global $conexion;
    $query = "SELECT * FROM productos";
    if (!empty($buscar)) {
        $query .= " WHERE CODIGOARTICULO LIKE ? OR NOMBREARTICULO LIKE ?";
        $stmt = mysqli_prepare($conexion, $query);
        $param = "%{$buscar}%";
        mysqli_stmt_bind_param($stmt, "ss", $param, $param);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    } else {
        return mysqli_query($conexion, $query);
    }
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
