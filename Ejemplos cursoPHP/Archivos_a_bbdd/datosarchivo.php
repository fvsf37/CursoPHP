<?php
//RECIBIMOS LOS DATOS DE LA IMAGEN

//con esto almacenamos: nombre, tipo y tamaño de imagen
$nombre_archivo=$_FILES["archivo"]["name"];
$tipo_archivo=$_FILES["archivo"]["type"];
$size_archivo=$_FILES["archivo"]["size"];


//CUANDO SUBIMOS UNA IMAGEN EL TYPE ES: image/ y luego el formato: gif, jpeg....
// Tamaño en bytes. 1Millon bytes es aprox 1 Mb 
if ($size_archivo<=1000000){  
	
	
		$carpeta_destino=$_SERVER['DOCUMENT_ROOT'] . '/cursoArchivos_a_bbdd/carpeta_archivos_subidos/';
		move_uploaded_file($_FILES["archivo"]["tmp_name"],$carpeta_destino.$nombre_archivo);

		echo "Nombre de la imagen en bytes: " . $nombre_archivo;
		echo "<br>";
		echo "Tipo de la imagen: " . $tipo_archivo;
		echo "<br>";
		echo "Tamaño de la imagen: " . $size_archivo;
		echo "<br>";
		

}else{
	echo "El tamaño es demasiado grande";
}
//----------------------CONEXION BASE DATOS y ALMACENAMIENTO DE ESA IMAGEN EN ESE CAMPO
	require("datos_conexIon.php");

	$conexion = mysqli_connect($servername, $username, $password, $database);
		if (!$conexion) {
			die("Connection failed: " . mysqli_connect_error());
		}
	echo "Connected successfully" . "<br>";


	$archivo_objetivo=fopen($carpeta_destino.$nombre_archivo,"r"); //SOLO LECTURA
	$contenido=fread($archivo_objetivo, $size_archivo);
	$contenido=addslashes($contenido); //PARA ESCAPAR LAS BARRAS INVERTIDAS QUE HAY EN LA RUTA...PARA QUE LAS COJA
	fclose($archivo_objetivo);


	$sql="INSERT INTO archivos (id, nombre, tipo, contenido) VALUES (null, '$nombre_archivo', '$tipo_archivo', '$contenido')"; 

	$resultado=mysqli_query($conexion,$sql); //EJECUCION DE LA CONSULTA

	if (mysqli_affected_rows($conexion)>0){
		echo  "Se ha insertado el registro con éxito";
	}else{
		echo "No se ha podido insertar el registro";
	}



	
//--------------------------- FIN CONEXION BASE DATOS
?>
