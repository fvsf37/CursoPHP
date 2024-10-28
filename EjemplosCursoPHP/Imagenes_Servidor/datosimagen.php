<?php
// RECIBIMOS LOS DATOS DE LA IMAGEN

// Obtenemos y almacenamos el nombre, tipo y tamaño de la imagen
$nombre_imagen = $_FILES["imagen"]["name"]; // Nombre original del archivo de imagen
$tipo_imagen = $_FILES["imagen"]["type"];   // Tipo MIME del archivo
$size_imagen = $_FILES["imagen"]["size"];   // Tamaño del archivo en bytes


// DEFINIMOS EL DIRECTORIO DE DESTINO PARA GUARDAR LA IMAGEN

// $_SERVER['DOCUMENT_ROOT'] proporciona la ruta al directorio principal de documentos del servidor, generalmente 'C:\xampp\htdocs\'
// Añadimos la carpeta donde se almacenará la imagen dentro del servidor
$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/cursoPHP/Imagenes_Servidor/carpeta_imagenes_subidas/';


// MOVEMOS LA IMAGEN DESDE LA CARPETA TEMPORAL A LA CARPETA DESTINO

// La función `move_uploaded_file` toma el archivo temporal y lo mueve al directorio especificado con su nombre original
move_uploaded_file($_FILES["imagen"]["tmp_name"], $carpeta_destino . $nombre_imagen);


// MOSTRAMOS DETALLES DE LA IMAGEN SUBIDA

// Mostramos al usuario información sobre la imagen que se ha subido, incluyendo su nombre, tipo y tamaño
echo "Nombre de la imagen: " . $nombre_imagen . "<br>";
echo "Tipo de la imagen: " . $tipo_imagen . "<br>";
echo "Tamaño de la imagen en bytes: " . $size_imagen . "<br>";

// NOTA:
// Aquí se podrían agregar verificaciones adicionales, como:
// - Limitar el tamaño de la imagen para evitar cargas demasiado grandes.
// - Restringir el tipo de archivo para aceptar solo imágenes, evitando archivos no deseados.

?>