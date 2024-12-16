<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
</head>
	
<?php

// LO PRIMERO CONECTAR CON LA BASE DE DATOS
	
	require("datos_conexion.php");
	$conexion = mysqli_connect($servername, $username, $password, $database);
		if (!$conexion) {
			die("Connection failed: " . mysqli_connect_error());
		}
	$consulta="SELECT FOTO FROM archivos WHERE id=2";
	$resultado=mysqli_query($conexion,$consulta);
	while ($fila=mysqli_fetch_array($resultado)){
		$ruta_imagen=$fila["FOTO"];
	}
	
?>
<div>
	<img src="carpeta_imagenes_subidas/<?php echo $ruta_imagen;?>" alt="Imagen del primer artículo" width="15%">
</div>
	
<body>
</body>
</html>