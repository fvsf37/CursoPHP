<?php
// RECIBIMOS LOS DATOS DE LA IMAGEN

// Almacenamos en variables el nombre, tipo y tamaño de la imagen que se está subiendo
$nombre_imagen = $_FILES["imagen"]["name"]; // Nombre del archivo de imagen
$tipo_imagen = $_FILES["imagen"]["type"];   // Tipo MIME del archivo
$size_imagen = $_FILES["imagen"]["size"];   // Tamaño del archivo en bytes


// VERIFICACIÓN DEL TIPO Y TAMAÑO DE LA IMAGEN

// Limitamos el tamaño a 1 MB (1 millón de bytes)
if ($size_imagen <= 1000000) {
	// Permitimos únicamente archivos de imagen con formatos específicos
	if ($tipo_imagen == "image/jpeg" || $tipo_imagen == "image/jpg" || $tipo_imagen == "image/png" || $tipo_imagen == "image/gif") {

		// Definimos la carpeta de destino donde se guardará la imagen subida en el servidor
		$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/cursoPHP/Imagenes_Servidor/carpeta_imagenes_subidas/';

		// Movemos la imagen desde el directorio temporal a la carpeta de destino con su nombre original
		move_uploaded_file($_FILES["imagen"]["tmp_name"], $carpeta_destino . $nombre_imagen);

		// Mostramos detalles de la imagen subida al usuario
		echo "Nombre de la imagen: " . $nombre_imagen . "<br>";
		echo "Tipo de la imagen: " . $tipo_imagen . "<br>";
		echo "Tamaño de la imagen en bytes: " . $size_imagen . "<br>";

	} else {
		// Mensaje de error si el archivo no es una imagen en un formato permitido
		echo "Solo se pueden subir imágenes con los formatos: jpeg, jpg, png, gif";
	}
} else {
	// Mensaje de error si el tamaño del archivo excede el límite
	echo "El tamaño del archivo es demasiado grande";
}


// CONEXIÓN A LA BASE DE DATOS Y ALMACENAMIENTO DE LA RUTA DE LA IMAGEN

// Incluimos el archivo con las credenciales de conexión a la base de datos
require("datos_conexion.php");

// Establecemos la conexión a la base de datos
$conexion = mysqli_connect($servername, $username, $password, $database);
if (!$conexion) {
	die("Error de conexión: " . mysqli_connect_error()); // Error si la conexión falla
}

// Insertamos en la base de datos la ruta de la imagen en el campo 'FOTO' de la tabla 'productos'
// Esto almacena el nombre del archivo de imagen en la columna correspondiente
$sql = "INSERT INTO productos (FOTO) VALUES ('$nombre_imagen')";

// Ejecución de la consulta SQL
$resultado = mysqli_query($conexion, $sql);

// Cerramos la conexión a la base de datos
mysqli_close($conexion);

?>