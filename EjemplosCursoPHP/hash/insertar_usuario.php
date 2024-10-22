<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
</head>

<body>

	<?php
	// Recibimos los parámetros 'us' (usuario) y 'con' (contraseña) desde la URL (usando el método GET)
	$usuario = $_GET['us'];
	$contra = $_GET['con'];

	// Ciframos la contraseña utilizando password_hash() con el algoritmo PASSWORD_DEFAULT, que incluye una sal automáticamente.
	$contra_cifrada = password_hash($contra, PASSWORD_DEFAULT);

	// Datos de conexión a la base de datos (normalmente estos se incluyen en un archivo externo)
	$servername = "localhost";  // Servidor de base de datos (en este caso, localhost)
	$database = "pruebas";      // Nombre de la base de datos
	$username = "root";         // Usuario de la base de datos
	$password = "";             // Contraseña del usuario (en este caso está vacía)
	
	// Establecemos la conexión con la base de datos MySQL usando mysqli_connect()
	$conexion = mysqli_connect($servername, $username, $password, $database);

	// Verificamos si la conexión falló
	if (!$conexion) {
		// Si la conexión falla, se muestra un mensaje de error y se detiene el script
		die("Connection failed: " . mysqli_connect_error());
	}

	// Creamos la consulta SQL para insertar un nuevo registro en la tabla 'usuarios_pass'
	// La contraseña será la versión cifrada generada anteriormente
	$consulta = "INSERT INTO usuarios_pass (ID, USUARIOS, PASSWORD) VALUES (NULL, '$usuario', '$contra_cifrada')";

	// Ejecutamos la consulta SQL usando mysqli_query()
	$resultados = mysqli_query($conexion, $consulta);

	// Verificamos si la consulta se ejecutó correctamente
	if ($resultados == false) {
		// Si ocurre un error, se muestra un mensaje indicándolo
		echo "Error en la consulta";
	} else {
		// Si la inserción fue exitosa, se muestra un mensaje de confirmación
		echo "Registro guardado<br><br>";
	}

	// Cerramos la conexión a la base de datos para liberar recursos
	mysqli_close($conexion);
	?>

</body>

</html>