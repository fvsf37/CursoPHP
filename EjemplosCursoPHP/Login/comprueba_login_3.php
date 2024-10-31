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


	try {
		$login = htmlentities(addslashes($_POST["login"])); //Convertir cualquier simbolo html, una comilla, un guion bajo. Como argumento addslashes escapa cualquier caracter de este tipo
		$password = htmlentities(addslashes($_POST["password"]));


		$base = new PDO("mysql:host=localhost; dbname=pruebas", "root", "");
		$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT ID, USUARIOS, PASSWORD FROM USUARIOS_PASS WHERE USUARIOS=:login AND PASSWORD=:password";
		$resultado = $base->prepare($sql);

		$resultado->bindValue(":login", $login);
		$resultado->bindValue(":password", $password);
		$resultado->execute();

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

	}
	?>
</body>

</html>