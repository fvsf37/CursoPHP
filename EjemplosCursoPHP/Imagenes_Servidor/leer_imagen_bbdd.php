<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
</head>

<?php

// LO PRIMERO: CONECTAR CON LA BASE DE DATOS

require("datos_conexIon.php"); // Incluye las credenciales de conexión a la base de datos
$conexion = mysqli_connect($servername, $username, $password, $database); // Conexión a la base de datos
if (!$conexion) { // Verificamos si la conexión falló
	die("Connection failed: " . mysqli_connect_error()); // Mensaje de error y detiene la ejecución si falla
}

// Consulta SQL para obtener la ruta de la imagen del producto con el código 'AR01'
$consulta = "SELECT FOTO FROM productos WHERE CODIGOARTICULO='AR01'";
$resultado = mysqli_query($conexion, $consulta); // Ejecutamos la consulta en la base de datos

// Obtenemos el resultado de la consulta (la ruta de la imagen) y la guardamos en una variable
while ($fila = mysqli_fetch_array($resultado)) {
	$ruta_imagen = $fila["FOTO"]; // Asignamos la ruta de la imagen a la variable $ruta_imagen
}

?>
<div>
	<!-- Mostramos la imagen en la página web usando la ruta obtenida de la base de datos -->
	<img src="carpeta_imagenes_subidas/<?php echo $ruta_imagen; ?>" alt="Imagen del primer artículo" width="15%">
</div>

<body>
</body>

</html>