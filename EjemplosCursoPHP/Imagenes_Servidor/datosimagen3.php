<?php
//RECIBIMOS LOS DATOS DE LA IMAGEN

//con esto almacenamos: nombre, tipo y tamaño de imagen
$nombre_imagen=$_FILES["imagen"]["name"];
$tipo_imagen=$_FILES["imagen"]["type"];
$size_imagen=$_FILES["imagen"]["size"];


//CUANDO SUBIMOS UNA IMAGEN EL TYPE ES: image/ y luego el formato: gif, jpeg....
// Tamaño en bytes. 1Millon bytes es aprox 1 Mb 
if ($size_imagen<=1000000){  
	if ($tipo_imagen=="image/jpeg" || $tipo_imagen=="image/jpg" || $tipo_imagen=="image/png" || $tipo_imagen=="image/gif"){
	
		$carpeta_destino=$_SERVER['DOCUMENT_ROOT'] . '/cursoPHP/ejemploscursophp/Imagenes_Servidor/carpeta_imagenes_subidas/';
		move_uploaded_file($_FILES["imagen"]["tmp_name"],$carpeta_destino.$nombre_imagen);

		echo "Nombre de la imagen en bytes: " . $nombre_imagen;
		echo "<br>";
		echo "Tipo de la imagen: " . $tipo_imagen;
		echo "<br>";
		echo "Tamaño de la imagen: " . $size_imagen;
		echo "<br>";
		
	}else{
		echo "Solo se pueden subir imágenes, es decir formatos: jpeg, jpg, png, gif";
	}
}else{
	echo "El tamaño es demasiado grande";
}
//----------------------CONEXION BASE DATOS y ALMACENAMIENTO DE ESA IMAGEN EN ESE CAMPO
	require("datos_conexion.php");

	$conexion = mysqli_connect($servername, $username, $password, $database);
		if (!$conexion) {
			die("Connection failed: " . mysqli_connect_error());
		}
	echo "Connected successfully" . "<br>";
//insertamos en el campo foto de la tabla productos la ruta de la imagen que está en $nombre_imagen
//	$sql="INSERT INTO productos (FOTO) VALUES ('$nombre_imagen')"; 
	$sql="UPDATE productos SET FOTO='$nombre_imagen' WHERE CODIGOARTICULO='AR01'";
	$resultado=mysqli_query($conexion,$sql);





	
//--------------------------- FIN CONEXION BASE DATOS
?>
