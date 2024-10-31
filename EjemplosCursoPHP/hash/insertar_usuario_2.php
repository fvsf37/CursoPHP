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
	$contra_cifrada = password_hash($contra, PASSWORD_DEFAULT, array("cost" => 13));


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
	// Capturamos los valores de 'us' (usuario) y 'con' (contraseña) desde la URL utilizando el método GET
	$usuario = $_GET['us'];
	$contra = $_GET['con'];

	// Ciframos la contraseña utilizando password_hash() con el algoritmo PASSWORD_DEFAULT, que incluye una sal automáticamente.
	// La opción 'cost' se usa para aumentar la complejidad de cifrado (13 en este caso, que es un número alto).
	$contra_cifrada = password_hash($contra, PASSWORD_DEFAULT, array("cost" =>13));

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
>>>>>>> 7a93cebd5afbddf3294ef3a87752beb87e361cbd
	?>

</body>

</html>