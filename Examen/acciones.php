<?php
session_start();
include 'db.php';

// Detecta la tabla seleccionada
$tabla = isset($_GET['tabla']) ? $_GET['tabla'] : (isset($_POST['tabla']) ? $_POST['tabla'] : 'productos');

// Verifica si la solicitud es POST (crear o actualizar)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Crear nuevo producto o libro
    if (isset($_POST['crear'])) {
        $datos = $_POST;

        if ($tabla == 'productos') {
            if (insertarProducto($datos)) {
                $_SESSION['mensaje'] = "Producto agregado correctamente.";
            } else {
                $_SESSION['mensaje'] = "Error al agregar el producto.";
            }
        } elseif ($tabla == 'libros') {
            if (insertarLibro($datos)) {
                $_SESSION['mensaje'] = "Libro agregado correctamente.";
            } else {
                $_SESSION['mensaje'] = "Error al agregar el libro.";
            }
        }
    }
    // Actualizar producto o libro existente
    elseif (isset($_POST['actualizar'])) {
        $datos = $_POST;

        if ($tabla == 'productos') {
            if (actualizarProducto($datos)) {
                $_SESSION['mensaje'] = "Producto modificado correctamente.";
            } else {
                $_SESSION['mensaje'] = "Error al modificar el producto.";
            }
        } elseif ($tabla == 'libros') {
            if (actualizarLibro($datos)) {
                $_SESSION['mensaje'] = "Libro modificado correctamente.";
            } else {
                $_SESSION['mensaje'] = "Error al modificar el libro.";
            }
        }
    }

    // Redirige a index.php después de la operación
    header("Location: index.php?tabla=$tabla");
    exit();
}

// Verifica si la solicitud es GET y se quiere eliminar
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];

    if ($tabla == 'productos') {
        if (eliminarProducto($id)) {
            $_SESSION['mensaje'] = "Producto eliminado correctamente.";
        } else {
            $_SESSION['mensaje'] = "Error al eliminar el producto.";
        }
    } elseif ($tabla == 'libros') {
        if (eliminarLibro($id)) {
            $_SESSION['mensaje'] = "Libro eliminado correctamente.";
        } else {
            $_SESSION['mensaje'] = "Error al eliminar el libro.";
        }
    }

    // Redirige a index.php después de la operación
    header("Location: index.php?tabla=$tabla");
    exit();
}

// Si la solicitud no coincide con ninguna acción, redirige de todas formas
$_SESSION['mensaje'] = "Acción no reconocida.";
header("Location: index.php");
exit();
?>