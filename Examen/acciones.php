<?php
session_start();
include 'db.php'; // Conexión a la base de datos

// Detecta la tabla seleccionada, por defecto es 'productos'
$tabla = 'productos';

// Procesa la solicitud POST para crear o actualizar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Verifica si es una solicitud para crear un nuevo producto
    if (isset($_POST['crear'])) {
        $datos = [
            'codigo' => $_POST['codigo'],
            'descripcion' => $_POST['descripcion'],
            'precioVenta' => $_POST['precioVenta'],
            'precioCompra' => $_POST['precioCompra'],
            'existencias' => $_POST['existencias'],
            'foto' => !empty($_FILES['foto']['tmp_name']) ? file_get_contents($_FILES['foto']['tmp_name']) : null
        ];

        // Llama a la función de inserción y establece el mensaje de sesión según el resultado
        if (insertarProducto($datos)) {
            $_SESSION['mensaje'] = "Producto agregado correctamente.";
        } else {
            $_SESSION['mensaje'] = "Error al agregar el producto.";
        }
    }

    // Verifica si es una solicitud para actualizar un producto existente
    elseif (isset($_POST['actualizar'])) {
        $datos = [
            'id' => $_POST['id'],
            'codigo' => $_POST['codigo'],
            'descripcion' => $_POST['descripcion'],
            'precioVenta' => $_POST['precioVenta'],
            'precioCompra' => $_POST['precioCompra'],
            'existencias' => $_POST['existencias'],
            'foto' => !empty($_FILES['foto']['tmp_name']) ? file_get_contents($_FILES['foto']['tmp_name']) : null
        ];

        // Llama a la función de actualización y establece el mensaje de sesión según el resultado
        if (actualizarProducto($datos)) {
            $_SESSION['mensaje'] = "Producto modificado correctamente.";
        } else {
            $_SESSION['mensaje'] = "Error al modificar el producto.";
        }
    }

    // Redirige a index.php después de la operación
    header("Location: index.php?tabla=$tabla");
    exit();
}

// Procesa la solicitud GET para eliminar un producto
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];

    // Llama a la función de eliminación y establece el mensaje de sesión según el resultado
    if (eliminarProducto($id)) {
        $_SESSION['mensaje'] = "Producto eliminado correctamente.";
    } else {
        $_SESSION['mensaje'] = "Error al eliminar el producto.";
    }

    // Redirige a index.php después de la operación
    header("Location: index.php?tabla=$tabla");
    exit();
}

// Redirige si no coincide con ninguna acción
$_SESSION['mensaje'] = "Acción no reconocida.";
header("Location: index.php");
exit();
?>