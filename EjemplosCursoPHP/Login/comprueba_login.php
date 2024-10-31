<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
	<style>
		h1.rojo {
			color: red;
<<<<<<< HEAD
=======
			/* Estilo para los mensajes en rojo */
>>>>>>> 7a93cebd5afbddf3294ef3a87752beb87e361cbd
		}

		h1.verde {
			color: green;
<<<<<<< HEAD
=======
			/* Estilo para los mensajes en verde */
>>>>>>> 7a93cebd5afbddf3294ef3a87752beb87e361cbd
		}
	</style>
</head>

<body>

	<?php
<<<<<<< HEAD


	try {
		$login = htmlentities(addslashes($_POST["login"])); //Convertir cualquier simbolo html, una comilla, un guion bajo. Como argumento addslashes escapa cualquier caracter de este tipo
		$password = htmlentities(addslashes($_POST["password"]));


		$base = new PDO("mysql:host=localhost; dbname=pruebas", "root", "");
		$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT ID, USUARIOS, PASSWORD FROM USUARIOS_PASS WHERE USUARIOS=:login AND PASSWORD=:password";
		$resultado = $base->prepare($sql);

=======
	try {
		// Escapamos cualquier carácter especial que el usuario haya introducido en el campo "login"
		// `htmlentities` convierte caracteres especiales en entidades HTML, y `addslashes` añade barras invertidas para escapar caracteres especiales
		$login = htmlentities(addslashes($_POST["login"]));

		// Escapamos también el valor introducido en el campo "password"
		$password = htmlentities(addslashes($_POST["password"]));

		// Conexión a la base de datos utilizando PDO (con MySQL como sistema de gestión de base de datos)
		$base = new PDO("mysql:host=localhost; dbname=pruebas", "root", "");

		// Configuramos PDO para lanzar excepciones en caso de error
		$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// Consulta SQL para seleccionar el ID, usuario y contraseña, donde el nombre de usuario y contraseña coincidan con los valores proporcionados
		$sql = "SELECT ID, USUARIOS, PASSWORD FROM USUARIOS_PASS WHERE USUARIOS=:login AND PASSWORD=:password";

		// Preparamos la consulta para su ejecución
		$resultado = $base->prepare($sql);

		// Asignamos los valores del usuario y la contraseña a los marcadores ":login" y ":password" utilizando `bindValue`
>>>>>>> 7a93cebd5afbddf3294ef3a87752beb87e361cbd
		$resultado->bindValue(":login", $login);
		$resultado->bindValue(":password", $password);

		// Ejecutamos la consulta con los valores asignados
		$resultado->execute();

<<<<<<< HEAD
		$numero_registro = $resultado->rowCount();
		if ($numero_registro != 0) {
			echo "<h1 class='verde'>Usuario registrado</h1>";
		} else {
			header("location:login.php");
		}


	} catch (Exception $e) {
		die("Error: " . $e->getMessage());
=======
		// Obtenemos el número de filas que coinciden con la consulta
		$numero_registro = $resultado->rowCount();

		// Si se encuentra un registro que coincide con el usuario y la contraseña...
		if ($numero_registro != 0) {
			// Si hay coincidencia, mostramos un mensaje verde indicando que el usuario está registrado
			echo "<h1 class='verde'>Usuario registrado</h1>";
		} else {
			// Si no hay coincidencia, redirigimos al usuario de vuelta a la página de login "login.php"
			header("location:login.php");
		}
>>>>>>> 7a93cebd5afbddf3294ef3a87752beb87e361cbd

	} catch (Exception $e) {
		// Si ocurre un error, capturamos la excepción y mostramos un mensaje con el error
		die("Error: " . $e->getMessage());
	}
	?>
</body>

</html>