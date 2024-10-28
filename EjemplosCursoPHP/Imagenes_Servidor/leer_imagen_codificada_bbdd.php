<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
</head>

<?php
$Id = "";          // Variable para almacenar el ID de la imagen
$contenido = "";   // Variable para almacenar el contenido de la imagen en base64
$tipo = "";        // Variable para almacenar el tipo de archivo (formato de imagen)

// LO PRIMERO: CONECTAR CON LA BASE DE DATOS

require("datos_conexIon.php");  // Archivo de conexión que incluye las credenciales de la base de datos
$conexion = mysqli_connect($servername, $username, $password, $database); // Conexión a la base de datos
if (!$conexion) { // Comprobamos si la conexión falló
	die("Connection failed: " . mysqli_connect_error()); // Mostramos un mensaje de error y detenemos la ejecución
}

// Consulta SQL para seleccionar el archivo con ID específico (14 en este caso)
$consulta = "SELECT * FROM archivos WHERE id=14";
$resultado = mysqli_query($conexion, $consulta); // Ejecutamos la consulta en la base de datos

// Recorremos el resultado y asignamos los valores a las variables
while ($fila = mysqli_fetch_array($resultado)) {
	$Id = $fila["id"];             // Almacenamos el ID
	$tipo = $fila["tipo"];         // Almacenamos el tipo de archivo
	$contenido = $fila["contenido"]; // Almacenamos el contenido de la imagen (datos en binario)
}

// VISUALIZAR EN LA PÁGINA WEB LA INFORMACIÓN
echo "ID: " . $Id . "<br>"; // Mostrar el ID de la imagen
echo "Tipo: " . $tipo . "<br>"; // Mostrar el tipo de archivo

// MOSTRAR EL CONTENIDO EN FORMATO BASE64
echo "Contenido" . $contenido . "<br><br>";

// DECODIFICAR EL CONTENIDO BINARIO PARA MOSTRAR COMO IMAGEN
// Utilizamos <img src> para mostrar la imagen decodificada en la página
echo "<img src='data:image/jpeg;base64," . base64_encode($contenido) . "'>"; // Codificamos en base64 y definimos el tipo de contenido

?>

<!-- 
	Esta sección alternativa permite mostrar una imagen que esté almacenada localmente en una carpeta específica
	<div>
		<img src="carpeta_imagenes_subidas/<?php echo $ruta_imagen; ?>" alt="Imagen del primer artículo" width="15%">
	</div>
-->

<body>
</body>

</html>