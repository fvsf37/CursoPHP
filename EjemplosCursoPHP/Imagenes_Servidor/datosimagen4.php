<?php
// RECIBIMOS LOS DATOS DE LA IMAGEN

// Almacenamos en variables el nombre, tipo y tamaño de la imagen recibida
$nombre_imagen = $_FILES["imagen"]["name"]; // Nombre del archivo de imagen
$tipo_imagen = $_FILES["imagen"]["type"];   // Tipo de archivo (MIME type)
$size_imagen = $_FILES["imagen"]["size"];   // Tamaño del archivo en bytes


// VERIFICAMOS EL TIPO Y TAMAÑO DE LA IMAGEN

// Restricción de tamaño: 1 MB (1 millón de bytes)
if ($size_imagen <= 1000000) {
	// Verificamos si el archivo es un tipo de imagen permitido (jpeg, jpg, png, gif)
	if ($tipo_imagen == "image/jpeg" || $tipo_imagen == "image/jpg" || $tipo_imagen == "image/png" || $tipo_imagen == "image/gif") {

		// Definimos la carpeta de destino en el servidor donde se guardará la imagen
		$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/cursoPHP/Imagenes_Servidor/carpeta_imagenes_subidas/';
		// Movemos la imagen desde la ubicación temporal a la carpeta destino, con su nombre original
		move_uploaded_file($_FILES["imagen"]["tmp_name"], $carpeta_destino . $nombre_imagen);

		// Mostramos la información de la imagen subida
		echo "Nombre de la imagen: " . $nombre_imagen . "<br>";
		echo "Tipo de la imagen: " . $tipo_imagen . "<br>";
		echo "Tamaño de la imagen en bytes: " . $size_imagen . "<br>";

	} else {
		// Mensaje de error si el archivo no es una imagen en formato permitido
		echo "Solo se pueden subir imágenes en formato: jpeg, jpg, png, gif";
	}
} else {
	// Mensaje de error si el tamaño del archivo supera el límite permitido
	echo "El tamaño del archivo es demasiado grande";
}


// CONEXIÓN A LA BASE DE DATOS Y ALMACENAMIENTO DE LA RUTA DE LA IMAGEN

// Incluimos el archivo con los datos de conexión a la base de datos
require("datos_conexion.php");

// Establecemos la conexión a la base de datos
$conexion = mysqli_connect($servername, $username, $password, $database);
if (!$conexion) {
	die("Connection failed: " . mysqli_connect_error()); // Mensaje de error en caso de fallo de conexión
}
echo "Conexión exitosa" . "<br>";

// Actualizamos la tabla 'productos' para guardar la ruta de la imagen en el campo 'FOTO' del producto con el código 'AR01'
$sql = "UPDATE productos SET FOTO='$nombre_imagen' WHERE CODIGOARTICULO='AR01'";
$resultado = mysqli_query($conexion, $sql);

// Finalizamos la conexión a la base de datos
mysqli_close($conexion);
?>