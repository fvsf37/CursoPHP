<?php
//RECIBIMOS LOS DATOS DE LA IMAGEN

//con esto almacenamos: nombre, tipo y tamaño de imagen
$nombre_archivo=$_FILES["archivo"]["name"];
$tipo_archivo=$_FILES["archivo"]["type"];
$size_archivo=$_FILES["archivo"]["size"];


//CUANDO SUBIMOS UNA IMAGEN EL TYPE ES: image/ y luego el formato: gif, jpeg....
// Tamaño en bytes. 1Millon bytes es aprox 1 Mb 
if ($size_archivo<=1000000){  
	$carpeta_destino=$_SERVER['DOCUMENT_ROOT'] . '/cursoPHP/Imagenes_Servidor/carpeta_imagenes_subidas/';
	move_uploaded_file($_FILES["archivo"]["tmp_name"],$carpeta_destino.$nombre_archivo);

	echo "Nombre DEL ARCHIVO en bytes: " . $nombre_archivo;
	echo "<br>";
	echo "Tipo DEL ARCHIVO: " . $tipo_archivo;
	echo "<br>";
	echo "Tamaño DEL ARCHIVO: " . $size_archivo;
	echo "<br>";
	echo "<br>";
	
}else{
	echo "El tamaño del ARCHIVO es demasiado grande";
	echo "<br>";
	echo "<br>";
}
//----------------------CONEXION BASE DATOS y ALMACENAMIENTO DE ESA IMAGEN EN ESE CAMPO
	require("datos_conexion.php");

	$conexion = mysqli_connect($servername, $username, $password, $database);
		if (!$conexion) {
			die("Connection failed: " . mysqli_connect_error());
		}
	echo "Connected successfully" . "<br>";

	$archivo_objetivo=fopen($carpeta_destino.$nombre_archivo,"r");
	$contenido_archivo_en_bytes=fread($archivo_objetivo,$size_archivo);
	$contenido_archivo_en_bytes=addslashes($contenido_archivo_en_bytes);
	fclose($archivo_objetivo);

	$sql="INSERT INTO archivos (id, nombre, tipo, contenido) VALUES ('', '$nombre_archivo', '$tipo_archivo', '$contenido_archivo_en_bytes')"; 

	$resultado=mysqli_query($conexion,$sql);

	if (mysqli_affected_rows($conexion)>0){
		echo "Se ha INSERTADO el registro con exito";
	}else{
		echo "NO Se ha INSERTADO el registro con exito";
	}



	
//--------------------------- FIN CONEXION BASE DATOS
?>
