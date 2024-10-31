<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Insertar Usuario</title>
</head>

<body>

	<?php
	// Se recogen los datos introducidos por el usuario en el formulario (login y password)
	$usuario = $_POST["login"];   // Nombre de usuario
	$contra = $_POST["password"]; // Contraseña proporcionada por el usuario
	
	// Usamos password_hash() para cifrar la contraseña. Esto genera una contraseña cifrada que incluye una "sal" automáticamente.
	// El parámetro PASSWORD_DEFAULT selecciona el algoritmo predeterminado para el hashing.
	// El "cost" es el coste de procesamiento, que por defecto es 10. Aquí lo incrementamos a 12 para mayor seguridad.
	$pass_cifrado = password_hash($contra, PASSWORD_DEFAULT, array("cost" => 12));

	try {
		// Conexión a la base de datos usando PDO
		$base = new PDO("mysql:host=localhost; dbname=pruebas", "root", "");

		// Configuramos PDO para que arroje excepciones en caso de error
		$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// Establecemos el conjunto de caracteres UTF-8 para manejar correctamente caracteres especiales
		$base->exec("SET CHARACTER SET utf8");

		// Consulta SQL para insertar el nuevo usuario en la tabla "usuarios_pass"
		$sql = "INSERT INTO usuarios_pass (usuarios, password) VALUES (:nombre, :contrase)";

		// Preparamos la consulta SQL para su ejecución
		$resultado = $base->prepare($sql);

		// Ejecutamos la consulta SQL, vinculando los valores proporcionados por el usuario (nombre y contraseña cifrada)
		$resultado->execute(array(":nombre" => $usuario, ":contrase" => $pass_cifrado));

		// Si la ejecución es exitosa, mostramos un mensaje
		echo "Registro insertado";

		// Cerramos el cursor para liberar recursos
		$resultado->closeCursor();

	} catch (Exception $e) {
		// En caso de que ocurra un error, capturamos la excepción y mostramos la línea donde ocurrió el error
		echo "La línea del error es: " . $e->getLine();
	} finally {
		// Cerramos la conexión a la base de datos para liberar recursos
		$base = null;
	}
	?>

</body>

</html>