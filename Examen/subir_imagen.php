<?php
session_start();
include 'db.php';

// Verifica si se cargaron imagen y código
if (isset($_FILES['imagen']) && isset($_POST['codigo'])) {
    // Asigna información de la imagen a variables
    $nombre_imagen = $_FILES["imagen"]["name"];
    $tipo_imagen = $_FILES["imagen"]["type"];
    $size_imagen = $_FILES["imagen"]["size"];

    // Valida tamaño y tipo de imagen
    if ($size_imagen <= 1000000) { // Máx. 1MB
        if (in_array($tipo_imagen, ["image/jpeg", "image/jpg", "image/png", "image/gif"])) {

            // Lee el contenido binario de la imagen
            $imagen_binaria = file_get_contents($_FILES["imagen"]["tmp_name"]);

            // Prepara la consulta para actualizar la imagen en la base de datos
            $codigo = $_POST['codigo'];
            $sql = "UPDATE productos SET foto=? WHERE codigo=?";
            $stmt = mysqli_prepare($conexion, $sql);
            mysqli_stmt_bind_param($stmt, "ss", $imagen_binaria, $codigo);

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['mensaje'] = "Imagen subida y guardada en la base de datos correctamente.";
            } else {
                $_SESSION['mensaje'] = "Error al guardar la imagen en la base de datos.";
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
header("Location: index.php?tabla=productos");
exit();
