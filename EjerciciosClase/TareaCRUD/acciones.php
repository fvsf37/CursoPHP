<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['crear'])) {
        $datos = $_POST;
        if (insertarProducto($datos)) {
            $_SESSION['mensaje'] = "Producto insertado correctamente";
            $_SESSION['tipo_mensaje'] = "exito";
        } else {
            $_SESSION['mensaje'] = "Error al insertar el producto";
            $_SESSION['tipo_mensaje'] = "error";
        }
    } elseif (isset($_POST['actualizar'])) {
        $datos = $_POST;
        if (actualizarProducto($datos)) {
            $_SESSION['mensaje'] = "Producto actualizado correctamente";
            $_SESSION['tipo_mensaje'] = "exito";
        } else {
            $_SESSION['mensaje'] = "Error al actualizar el producto";
            $_SESSION['tipo_mensaje'] = "error";
        }
    }
    header("Location: index.php");
    exit();
} elseif (isset($_GET['eliminar'])) {
    $codigo = $_GET['eliminar'];
    if (eliminarProducto($codigo)) {
        $_SESSION['mensaje'] = "Producto eliminado correctamente";
        $_SESSION['tipo_mensaje'] = "exito";
    } else {
        $_SESSION['mensaje'] = "Error al eliminar el producto";
        $_SESSION['tipo_mensaje'] = "error";
    }
    header("Location: index.php");
    exit();
}
