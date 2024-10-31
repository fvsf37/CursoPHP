<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
<<<<<<< HEAD

=======
>>>>>>> 7a93cebd5afbddf3294ef3a87752beb87e361cbd
</head>

<body>

	<?php
<<<<<<< HEAD

	$usuario = $_GET['us'];
	$contra = $_GET['con'];

	//con PASSWORD_DEFAULT conseguimos que la sal la ponga automáticamente
	$contra_cifrada = password_hash($contra, PASSWORD_DEFAULT);

	//require("datos_conexion.php");
	$servername = "localhost";
	$database = "pruebas";
	$username = "root";
	$password = "";

	$conexion = mysqli_connect($servername, $username, $password, $database);

	if (!$conexion) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$consulta = "INSERT INTO usuarios_pass (ID,USUARIOS, PASSWORD) VALUES (NULL,'$usuario', '$contra_cifrada')";

	$resultados = mysqli_query($conexion, $consulta);

	//VAMOS AÑADIR UN ECHO O ALGO QUE NOS DIGA SI HA REALIZADO YA LA INSERCION EN LA BBDD
	if ($resultados == false) { //si ocurre eso entonces es que ha habido algún tipo de error
		echo "Error en la consulta";
	} else {

		echo "Registro guardado<br><br>";
	}




	mysqli_close($conexion); //liberar recursos. cerramos conexion
=======
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
>>>>>>> 7a93cebd5afbddf3294ef3a87752beb87e361cbd
	?>

</body>

</html>