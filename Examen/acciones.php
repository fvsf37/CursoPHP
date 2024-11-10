<?php
session_start();
include 'db.php';

// Detecta la tabla seleccionada, por defecto es 'productos'
$tabla = isset($_GET['tabla']) ? $_GET['tabla'] : (isset($_POST['tabla']) ? $_POST['tabla'] : 'productos');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datos = [
        'codigo' => $_POST['codigo'],
        'seccion' => $_POST['seccion'],
        'nombre' => $_POST['nombre'],
        'precio' => $_POST['precio'],
        'fecha' => $_POST['fecha'],
        'importado' => $_POST['importado'],
        'pais' => $_POST['pais']
    ];

    insertarProducto($datos);
}


// Procesa la solicitud POST para crear o actualizar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Crear un nuevo producto o libro
    if (isset($_POST['crear'])) {
        $datos = $_POST;

        if ($tabla == 'productos') {
            $_SESSION['mensaje'] = insertarProducto($datos) ? "Producto agregado correctamente." : "Error al agregar el producto.";
        } elseif ($tabla == 'libros') {
            $_SESSION['mensaje'] = insertarLibro($datos) ? "Libro agregado correctamente." : "Error al agregar el libro.";
        }
    }
    // Actualiza un producto o libro existente
    elseif (isset($_POST['actualizar'])) {
        $datos = $_POST;

        if ($tabla == 'productos') {
            $_SESSION['mensaje'] = actualizarProducto($datos) ? "Producto modificado correctamente." : "Error al modificar el producto.";
        } elseif ($tabla == 'libros') {
            $_SESSION['mensaje'] = actualizarLibro($datos) ? "Libro modificado correctamente." : "Error al modificar el libro.";
        }
    }

    // Redirige a index.php después de la operación
    header("Location: index.php?tabla=$tabla");
    exit();
}

// Procesa la solicitud GET para eliminar un producto o libro
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];

    if ($tabla == 'productos') {
        $_SESSION['mensaje'] = eliminarProducto($id) ? "Producto eliminado correctamente." : "Error al eliminar el producto.";
    } elseif ($tabla == 'libros') {
        $_SESSION['mensaje'] = eliminarLibro($id) ? "Libro eliminado correctamente." : "Error al eliminar el libro.";
    }

    // Redirige a index.php después de la operación
    header("Location: index.php?tabla=$tabla");
    exit();
}

// Redirige si no coincide con ninguna acción
$_SESSION['mensaje'] = "Acción no reconocida.";
header("Location: index.php");
exit();
