<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
	<style>
		/* Definimos estilos para los encabezados h1 con clases 'rojo' y 'verde' */
		h1.rojo {
			color: red;
			/* Aplica color rojo al texto */
		}

		h1.verde {
			color: green;
			/* Aplica color verde al texto */
		}
	</style>
</head>

<body>

	<?php
	// Iniciamos un bloque try-catch para manejar posibles excepciones
	try {
		// Capturamos y sanitizamos los datos enviados por el formulario mediante POST
		$login = htmlentities(addslashes($_POST["login"]));
		$password = htmlentities(addslashes($_POST["password"]));

		// Establecemos la conexión a la base de datos usando PDO
		$base = new PDO("mysql:host=localhost; dbname=pruebas", "root", "");
		// Configuramos PDO para que lance excepciones en caso de error
		$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// Preparamos una consulta SQL para buscar el usuario ingresado
		$sql = "SELECT ID, USUARIOS, PASSWORD FROM USUARIOS_PASS WHERE USUARIOS = :login";
		$resultado = $base->prepare($sql);

		// Vinculamos el valor del parámetro :login con la variable $login
		$resultado->bindValue(":login", $login);
		// Ejecutamos la consulta preparada
		$resultado->execute();

		// Obtenemos el número de registros que coinciden con el usuario ingresado
		$numero_registro = $resultado->rowCount();

		// Si existe al menos un registro con el usuario ingresado
		if ($numero_registro != 0) {
			// Recorremos los registros obtenidos
			while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
				// Verificamos si la contraseña ingresada coincide con la almacenada en la base de datos
				if (password_verify($password, $registro['PASSWORD'])) {
					// Si la contraseña es correcta, mostramos un mensaje de éxito
					echo "Estás dentro, cruza la pasarela" . "<br>";
				} else {
					// Si la contraseña es incorrecta, mostramos un mensaje de error
					echo "Usuario NO Registrado" . "<br>";
				}
			}
		} else {
			// Si no existe el usuario, redirigimos al formulario de login
			header("location:login_3.php");
		}

	} catch (Exception $e) {
		// En caso de excepción, mostramos el mensaje de error y detenemos la ejecución
		die("Error: " . $e->getMessage());
	}
	?>
</body>

</html>