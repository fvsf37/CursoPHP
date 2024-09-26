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
		$login=htmlentities(addslashes($_POST["login"])); 
		$password=htmlentities(addslashes($_POST["password"]));
		
		
		$base=new PDO("mysql:host=localhost; dbname=pruebas", "root", "");
		$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
		$sql="SELECT ID, USUARIOS, PASSWORD FROM USUARIOS_PASS WHERE USUARIOS=:login";
		$resultado=$base->prepare($sql);
		
		$resultado->bindValue(":login", $login);
		$resultado->execute();
				
        $numero_registro=$resultado->rowCount();
		if ($numero_registro!=0){
			while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
				if (password_verify($password, $registro['PASSWORD'])){
					echo "Usuario Registrado" . "<br>";
				}else{
					echo "Usuario NO Registrado" . "<br>";
					
				}
			}
		}else{
			header("location:login_3.php");
		}
				
		
	}catch (Exception $e){
			die ("Error: " . $e->getMessage());

	}
?>
</body>
</html>