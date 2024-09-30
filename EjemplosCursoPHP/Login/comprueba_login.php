<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
	<style>
		h1.rojo{
			color:red;
		}
		h1.verde{
			color:green;
		}
	</style>
</head>

<body>
	
<?php

	
	try{
		$login=htmlentities(addslashes($_POST["login"])); //Convertir cualquier simbolo html, una comilla, un guion bajo. Como argumento addslashes escapa cualquier caracter de este tipo
		$password=htmlentities(addslashes($_POST["password"]));
		
		
		$base=new PDO("mysql:host=localhost; dbname=pruebas", "root", "");
		$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
		$sql="SELECT ID, USUARIOS, PASSWORD FROM USUARIOS_PASS WHERE USUARIOS=:login AND PASSWORD=:password";
		$resultado=$base->prepare($sql);
		
		$resultado->bindValue(":login", $login);
		$resultado->bindValue(":password", $password);
		$resultado->execute();
				
        $numero_registro=$resultado->rowCount();
		if ($numero_registro!=0){
			echo "<h1 class='verde'>Usuario registrado</h1>";
		}else{
			header("location:login.php");
		}
				
		
	}catch (Exception $e){
			die ("Error: " . $e->getMessage());

	}
?>
</body>
</html>