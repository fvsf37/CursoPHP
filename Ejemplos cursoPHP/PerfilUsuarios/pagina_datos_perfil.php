<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
	
<?php
	
	$usuario=$_GET['us'];
	$contra=$_GET['con'];

	require("datos_conexion.php");

	$conexion = mysqli_connect($servername, $username, $password, $database);
	
		if (!$conexion) {
			die("Connection failed: " . mysqli_connect_error());
		}
	
	$consulta="SELECT * FROM perfilusuarios WHERE usuario='$usuario' AND password='$contra'";
	

	
	$resultados=mysqli_query($conexion,$consulta);
	

	while ($fila=mysqli_fetch_array($resultados,MYSQLI_ASSOC)){    

		echo "Bienvenido " . $usuario . ". <br>Tus datos son: <br>";
		
		echo "<table><tr><td>";
		echo $fila['usuario'] . "</td><td>";
		echo $fila['password'] . "</td><td>";
		echo $fila['perfil'] . "</td></table>";
		echo "<br>";
		
		if ($fila['perfil']=="Administrador"){
			include ("menu_administrador.html");
		}else{
			include ("menu_usuario.html");
		}

	}
	
	mysqli_close($conexion); //liberar recursos. cerramos conexion
?>
	
	
</body>
</html>