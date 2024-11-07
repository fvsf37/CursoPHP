<?php
session_start();
include 'db.php'; // Incluye la conexión a la base de datos

// Asegúrate de que el archivo de imagen fue cargado
if (isset($_FILES['imagen']) && isset($_POST['codigo']) && isset($_POST['tabla'])) {
    // Obtén los datos de la imagen
    $nombre_imagen = $_FILES["imagen"]["name"];
    $tipo_imagen = $_FILES["imagen"]["type"];
    $size_imagen = $_FILES["imagen"]["size"];

    // Validación del tamaño y el tipo de imagen
    if ($size_imagen <= 1000000) { // Máximo de 1MB
        if ($tipo_imagen == "image/jpeg" || $tipo_imagen == "image/jpg" || $tipo_imagen == "image/png" || $tipo_imagen == "image/gif") {

            // Carpeta destino (ajusta el nombre de la carpeta según tu proyecto)
            $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/ruta_a_tu_proyecto/carpeta_imagenes_subidas/';
            move_uploaded_file($_FILES["imagen"]["tmp_name"], $carpeta_destino . $nombre_imagen);

            // Conexión a la base de datos
            $codigo = $_POST['codigo'];
            $tabla = $_POST['tabla'];

            // Determina la consulta según la tabla
            if ($tabla == 'productos') {
                $sql = "UPDATE productos SET FOTO='$nombre_imagen' WHERE CODIGOARTICULO=?";
            } elseif ($tabla == 'libros') {
                $sql = "UPDATE libros SET FOTO='$nombre_imagen' WHERE id=?";
            }

            // Ejecuta la consulta
            $stmt = mysqli_prepare($conexion, $sql);
            mysqli_stmt_bind_param($stmt, "s", $codigo);
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['mensaje'] = "Imagen subida y guardada en la base de datos correctamente.";
            } else {
                $_SESSION['mensaje'] = "Error al guardar la imagen en la base de datos.";
            }

        } else {
            $_SESSION['mensaje'] = "Formato de imagen no permitido. Solo se admiten JPEG, JPG, PNG y GIF.";
        }
    } else {
        $_SESSION['mensaje'] = "El tamaño de la imagen es demasiado grande. Máximo 1MB.";
    }
} else {
    $_SESSION['mensaje'] = "Error al cargar la imagen.";
}

// Redirige de vuelta a la página principal con el mensaje
header("Location: index.php?tabla=$tabla");
exit();
?>