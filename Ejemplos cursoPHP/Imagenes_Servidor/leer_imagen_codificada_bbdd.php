<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
</head>
	
<?php
	$Id="";
	$contenido="";
	$tipo="";
		
// LO PRIMERO CONECTAR CON LA BASE DE DATOS
	
	require("datos_conexIon.php");
	$conexion = mysqli_connect($servername, $username, $password, $database);
		if (!$conexion) {
			die("Connection failed: " . mysqli_connect_error());
		}
	$consulta="SELECT * FROM archivos WHERE id=14";
	$resultado=mysqli_query($conexion,$consulta);
	
	while ($fila=mysqli_fetch_array($resultado)){
		$Id=$fila["id"];
		$tipo=$fila["tipo"];
		$contenido=$fila["contenido"];
	}

	
/* AHORA VISUALIZAMOS EN LA PAGINA WEB ESA INFORMACION */
	echo "ID: " . $Id . "<br>";
	echo "Tipo: " . $tipo . "<br>";
	
/*ESTO ASI TAL CUAL NO FUNCIONARIA, HAY QUE DECODIFICARLA*/
	
 echo "Contenido" . $contenido . "<br>". "<br>";
	
/*PARA DECODIFICARLA TENEMOS QUE METER LA IMAGEN EN UN CONTENEDOR EN CUAL? EN <img src>*/

 echo "<img src='data:image/jpeg; base64," . base64_encode($contenido) . "'>";

?>
	
<!--<div>
	<img src="carpeta_imagenes_subidas/<?php echo $ruta_imagen;?>" alt="Imagen del primer artículo" width="15%">
</div>-->
	
<body>
</body>
</html>