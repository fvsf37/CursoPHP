<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
	<style>
		h1.rojo {
			color: red;
		}

		h1.verde {
			color: green;
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
		// Escapar caracteres especiales para prevenir inyección de código HTML o SQL
		$login = htmlentities(addslashes($_POST["login"])); // Escapa caracteres especiales en el login
		$password = htmlentities(addslashes($_POST["password"])); // Escapa caracteres especiales en el password
	
		// Conectamos a la base de datos "pruebas"
		$base = new PDO("mysql:host=localhost; dbname=pruebas", "root", "");

		// Configuramos PDO para que lance excepciones en caso de errores
		$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// Consulta SQL para verificar si el usuario y la contraseña coinciden con un registro en la base de datos
		$sql = "SELECT ID, USUARIOS, PASSWORD FROM USUARIOS_PASS WHERE USUARIOS=:login AND PASSWORD=:password";

		// Preparamos la consulta
		$resultado = $base->prepare($sql);

		// Usamos bindValue para asociar los valores del formulario a los marcadores de la consulta
>>>>>>> 7a93cebd5afbddf3294ef3a87752beb87e361cbd
		$resultado->bindValue(":login", $login);
		$resultado->bindValue(":password", $password);

		// Ejecutamos la consulta
		$resultado->execute();

<<<<<<< HEAD
		$numero_registro = $resultado->rowCount();
		if ($numero_registro != 0) {
			//COMENTAR LA SIGUIENTE LINEA PARA VER QUE SI EL USUARIO EXISTE VA A USUARIOS_REGISTRADOS PERO NO DEBEMOS DEJARLO ASI YA QUE SI COPIAMOS LA URL Y PEGAMOS EN OTRO NAVEGADOR ENTRAMOS EN LA PAGINA PRIVADA
			session_start(); // CREARIA UNA SESION PARA EL USUARIO QUE SE ACABA DE LOGUEAR
//ALMACENAMOS DENTRO DE LA VARIABLE SUPERGLOBAL $_SESSION EL LOGIN DEL USUARIO. Al ser variable superglobal vamos a poder usarla
//en cualquier otra página de nuestro sitio
			$_SESSION["usuario"] = $_POST["login"]; //El nombre que le queramos dar a esa sesion. Guardando en ella el nombre del usuario
			header("location:usuarios_registrados_1.php");
		} else {
			header("location:login_3.php");
		}


	} catch (Exception $e) {
		die("Error: " . $e->getMessage());
=======
		// Contamos cuántos registros coinciden con el usuario y la contraseña proporcionados
		$numero_registro = $resultado->rowCount();

		// Si hay un registro que coincide con el usuario y la contraseña...
		if ($numero_registro != 0) {
			// Iniciamos una sesión para el usuario que acaba de iniciar sesión
			session_start();

			// Almacenamos el nombre de usuario en la variable superglobal $_SESSION
			$_SESSION["usuario"] = $_POST["login"];

			// Redirigimos al usuario a la página "usuarios_registrados_1.php"
			header("location:usuarios_registrados_1.php");
		} else {
			// Si el usuario no es encontrado, lo redirigimos a la página de inicio de sesión "login_3.php"
			header("location:login_3.php");
		}
>>>>>>> 7a93cebd5afbddf3294ef3a87752beb87e361cbd

	} catch (Exception $e) {
		// Si ocurre un error, lo capturamos y mostramos el mensaje de error
		die("Error: " . $e->getMessage());
	}
	?>
</body>

</html>