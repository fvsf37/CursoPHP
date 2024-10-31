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
		$contador = 0; //Esta variable es para saber si el login introducido esta o no en la BBDD
	
		$base = new PDO("mysql:host=localhost; dbname=pruebas", "root", "");
		$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//$sql="SELECT * FROM USUARIOS_PASS WHERE USUARIOS=:login";
		$sql = "SELECT ID, USUARIOS, PASSWORD FROM USUARIOS_PASS WHERE USUARIOS=:login AND PASSWORD=:password";
		$resultado = $base->prepare($sql);
		$resultado->execute(array(":login" => $login, ":password" => $password));
		//$resultado->bindValue(":login", $login);
		//$resultado->bindValue(":password", $password);
		//$resultado->execute():
	
		/*		while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
					echo "usuario: " . $registro['usuarios'] . " Contraseña: " . $registro['password'] . "<br>";
				}*/

		while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
			if (password_verify($password, $registro['password'])) {
				$contador++;
			}
		}
		if ($contador > 0) {
			echo "<h1 class='verde'>Usuario registrado</h1>";
		} else {
			echo "<h1 class='rojo'>Usuario NO registrado</h1>";
		}



	} catch (Exception $e) {
		die("Error: " . $e->getMessage());

	}
	?>
</body>

</html>