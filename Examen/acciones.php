<?php
session_start();
include 'db.php';

// Verifica si la solicitud es POST (crear o actualizar producto)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica si se está intentando crear un producto
    if (isset($_POST['crear'])) {
        $datos = $_POST;
        if (insertarProducto($datos)) {
            $_SESSION['mensaje'] = "Producto agregado correctamente.";
        } else {
            $_SESSION['mensaje'] = "Error al agregar el producto.";
        }
    }
    // Verifica si se está intentando actualizar un producto
    elseif (isset($_POST['actualizar'])) {
        $datos = $_POST;
        if (actualizarProducto($datos)) {
            $_SESSION['mensaje'] = "Producto modificado correctamente.";
        } else {
            $_SESSION['mensaje'] = "Error al modificar el producto.";
        }
    }
    // Redirige a index.php después de la operación
    header("Location: index.php");
    exit();
}

// Verifica si la solicitud es GET y se quiere eliminar un producto
elseif (isset($_GET['eliminar'])) {
    $codigo = $_GET['eliminar'];
    if (eliminarProducto($codigo)) {
        $_SESSION['mensaje'] = "Producto eliminado correctamente.";
    } else {
        $_SESSION['mensaje'] = "Error al eliminar el producto.";
    }
    // Redirige a index.php después de la operación
    header("Location: index.php");
    exit();
}

// Si la solicitud no coincide con ninguna acción, redirige de todas formas
else {
    $_SESSION['mensaje'] = "Acción no reconocida.";
    header("Location: index.php");
    exit();
}
?>