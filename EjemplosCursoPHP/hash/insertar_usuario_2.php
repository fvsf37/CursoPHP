<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
</head>

<body>

	<?php
	// Capturamos los valores de 'us' (usuario) y 'con' (contraseña) desde la URL utilizando el método GET
	$usuario = $_GET['us'];
	$contra = $_GET['con'];

	// Ciframos la contraseña utilizando password_hash() con el algoritmo PASSWORD_DEFAULT, que incluye una sal automáticamente.
	// La opción 'cost' se usa para aumentar la complejidad de cifrado (13 en este caso, que es un número alto).
	$contra_cifrada = password_hash($contra, PASSWORD_DEFAULT, array("cost" => 13));

	// Configuración de los datos de conexión a la base de datos
	$servername = "localhost";  // Servidor de base de datos (localhost)
	$database = "pruebas";      // Nombre de la base de datos
	$username = "root";         // Usuario de la base de datos
	$password = "";             // Contraseña del usuario
	
	// Creamos una conexión con la base de datos utilizando mysqli_connect()
	$conexion = mysqli_connect($servername, $username, $password, $database);

	// Verificamos si la conexión ha fallado
	if (!$conexion) {
		// Si hay un error en la conexión, mostramos el mensaje y detenemos el script
		die("Connection failed: " . mysqli_connect_error());
	}

	// Consulta SQL para insertar un nuevo usuario y su contraseña cifrada en la tabla 'usuarios_pass'
	$consulta = "INSERT INTO usuarios_pass (ID, USUARIOS, PASSWORD) VALUES (NULL, '$usuario', '$contra_cifrada')";

	// Ejecutamos la consulta SQL
	$resultados = mysqli_query($conexion, $consulta);

	// Verificamos si la inserción en la base de datos fue exitosa o no
	if ($resultados == false) {
		// Si la consulta falló, mostramos un mensaje de error
		echo "Error en la consulta";
	} else {
		// Si la inserción fue exitosa, mostramos un mensaje de confirmación
		echo "Registro guardado<br><br>";
	}

	// Cerramos la conexión a la base de datos para liberar los recursos
	mysqli_close($conexion);
	?>

</body>

</html>