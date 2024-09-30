<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>

<?php
	$usuario=$_POST["login"];
	$contra=$_POST["password"];
	
/*	$pass_cifrado=password_hash($contra, PASSWORD_DEFAULT); /* ESA SAL QUE DECIAMOS EN LA TEORIA LA GENERA AUTOMATICAMENTE*/ 
 	$pass_cifrado=password_hash($contra, PASSWORD_DEFAULT, array("cost"=>12));
/* de esta forma pasamo de 10 a 12 en password_hash, estamos haciendo la contraseña màs larga, màs fuerte, màs robusta, y se necesitan más recursos del servidor*/
	
	try{
		$base=new PDO("mysql:host=localhost; dbname=pruebas", "root", "");
		$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$base->exec("SET CHARACTER SET utf8");
		$sql="INSERT INTO usuarios_pass (usuarios, password) VALUES (:nombre, :contrase)";
		
		$resultado=$base->prepare($sql);
		$resultado->execute(array(":nombre"=>$usuario, ":contrase"=>$pass_cifrado));
		
		echo "Registro insertado";
		$resultado->closeCursor();
		
			
	}catch (Exception $e){
		//die ("Error: " . $e->getMessage());
	
	 echo "La linea del error es: " . $e->getLine();
		
	}finally{
		$base=null;  /*con esto vaciamos la memoria*/
	}
	
	
	
?>
	
	
	
	
</body>
</html>