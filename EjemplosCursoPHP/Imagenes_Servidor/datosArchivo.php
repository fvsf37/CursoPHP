<?php
// RECIBIMOS LOS DATOS DEL ARCHIVO SUBIDO

// Almacenamos el nombre, tipo y tamaño del archivo recibido en variables
$nombre_archivo = $_FILES["archivo"]["name"]; // Nombre del archivo subido
$tipo_archivo = $_FILES["archivo"]["type"];   // Tipo MIME del archivo
$size_archivo = $_FILES["archivo"]["size"];   // Tamaño del archivo en bytes


// VERIFICAMOS QUE EL TAMAÑO NO SUPERE 1 MB (1 millón de bytes)

if ($size_archivo <= 1000000) {
	// Definimos la carpeta de destino en el servidor donde se guardará el archivo
	$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/cursoPHP/Imagenes_Servidor/carpeta_imagenes_subidas/';
	// Movemos el archivo desde la carpeta temporal a la carpeta de destino
	move_uploaded_file($_FILES["archivo"]["tmp_name"], $carpeta_destino . $nombre_archivo);

	// Mostramos detalles del archivo subido
	echo "Nombre del archivo: " . $nombre_archivo . "<br>";
	echo "Tipo del archivo: " . $tipo_archivo . "<br>";
	echo "Tamaño del archivo en bytes: " . $size_archivo . "<br><br>";

} else {
	// Mensaje de error si el tamaño del archivo excede el límite
	echo "El tamaño del archivo es demasiado grande<br><br>";
}


// CONEXIÓN A LA BASE DE DATOS Y ALMACENAMIENTO DEL CONTENIDO DEL ARCHIVO

// Incluimos el archivo que contiene los datos de conexión a la base de datos
require("datos_conexion.php");

// Establecemos la conexión a la base de datos
$conexion = mysqli_connect($servername, $username, $password, $database);
if (!$conexion) {
	die("Error de conexión: " . mysqli_connect_error()); // Error en caso de fallo de conexión
}
echo "Conexión exitosa" . "<br>";

// LEEMOS EL CONTENIDO DEL ARCHIVO EN BYTES

// Abrimos el archivo subido en modo de lectura
$archivo_objetivo = fopen($carpeta_destino . $nombre_archivo, "r");
// Leemos el contenido del archivo en bytes
$contenido_archivo_en_bytes = fread($archivo_objetivo, $size_archivo);
// Añadimos barras invertidas a los caracteres especiales para evitar errores SQL
$contenido_archivo_en_bytes = addslashes($contenido_archivo_en_bytes);
fclose($archivo_objetivo); // Cerramos el archivo después de leerlo

// INSERTAMOS LOS DATOS EN LA BASE DE DATOS

// Creamos la consulta SQL para insertar el archivo en la tabla 'archivos', con su nombre, tipo y contenido en bytes
$sql = "INSERT INTO archivos (id, nombre, tipo, contenido) VALUES ('', '$nombre_archivo', '$tipo_archivo', '$contenido_archivo_en_bytes')";
$resultado = mysqli_query($conexion, $sql); // Ejecutamos la consulta

// Verificamos si se ha insertado correctamente
if (mysqli_affected_rows($conexion) > 0) {
	echo "Se ha insertado el registro con éxito";
} else {
	echo "No se ha insertado el registro con éxito";
}

// Finalizamos la conexión a la base de datos
mysqli_close($conexion);

?>