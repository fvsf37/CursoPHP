<?php
session_start();
include 'db.php'; // Conexión a la base de datos

// Verifica si se cargaron imagen, código y tabla
if (isset($_FILES['imagen']) && isset($_POST['codigo']) && isset($_POST['tabla'])) {
    // Asigna información de la imagen a variables
    $nombre_imagen = $_FILES["imagen"]["name"];
    $tipo_imagen = $_FILES["imagen"]["type"];
    $size_imagen = $_FILES["imagen"]["size"];

    // Valida tamaño y tipo de imagen
    if ($size_imagen <= 1000000) { // Máx. 1MB
        if ($tipo_imagen == "image/jpeg" || $tipo_imagen == "image/jpg" || $tipo_imagen == "image/png" || $tipo_imagen == "image/gif") {

            // Define la carpeta destino para la imagen
            $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/CURSOPHP/Examen/carpeta_imagenes_subidas/';

            // Mueve la imagen a la carpeta destino
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $carpeta_destino . $nombre_imagen)) {
                $codigo = $_POST['codigo'];
                $tabla = $_POST['tabla'];

                // Prepara la consulta para actualizar la imagen en la base de datos
                if ($tabla == 'productos') {
                    $sql = "UPDATE productos SET FOTO=? WHERE CODIGOARTICULO=?";
                } elseif ($tabla == 'libros') {
                    $sql = "UPDATE libros SET FOTO=? WHERE id=?";
                }

                $stmt = mysqli_prepare($conexion, $sql);
                mysqli_stmt_bind_param($stmt, "ss", $nombre_imagen, $codigo); // Asigna imagen y código
                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['mensaje'] = "Imagen subida y guardada en la base de datos correctamente.";
                } else {
                    $_SESSION['mensaje'] = "Error al guardar la imagen en la base de datos.";
                }
            } else {
                $_SESSION['mensaje'] = "Error al mover la imagen a la carpeta de destino.";
            }

        } else {
            $_SESSION['mensaje'] = "Formato de imagen no permitido. Solo JPEG, JPG, PNG y GIF.";
        }
    } else {
        $_SESSION['mensaje'] = "El tamaño de la imagen es demasiado grande. Máx. 1MB.";
    }
} else {
    $_SESSION['mensaje'] = "Error al cargar la imagen.";
}

// Redirige de vuelta con el mensaje
header("Location: index.php?tabla=$tabla");
exit();
?>