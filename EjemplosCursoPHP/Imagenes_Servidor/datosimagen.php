<?php
//RECIBIMOS LOS DATOS DE LA IMAGEN

//con esto almacenamos: nombre, tipo y tamaño de imagen
$nombre_imagen=$_FILES["imagen"]["name"];
$tipo_imagen=$_FILES["imagen"]["type"];
$size_imagen=$_FILES["imagen"]["size"];


//aqui decimos el directorio o carpeta donde queremos guardar la imagen.
// DOCUMENT_ROOT ES C:\xampp\htdocs\
//lUEGO LE SEGUIMOS INDICANDO EL RESTO DE LA RUTA

//                 RUTA DE LA CARPETA DESTINO DEL SERVIDOR
$carpeta_destino=$_SERVER['DOCUMENT_ROOT'] . '/cursoPHP/ejemploscursophp/Imagenes_Servidor/carpeta_imagenes_subidas/';


//                 AHORA MOVEMOS EL ARCHIVO DE LA CARPETA TEMPORAL A LA CARPETA DESTINO

move_uploaded_file($_FILES["imagen"]["tmp_name"],$carpeta_destino.$nombre_imagen);

//  FALTARIA CONTROLAR QUE NO SUBA MAS DE UN TAMAÑO INDICADO, QUE NO DEJE SUBIR COSAS QUE NO SEAN IMAGENES...ETC

echo "Nombre de la imagen: " . $nombre_imagen;
echo "<br>";
echo "Tipo de la imagen: " . $tipo_imagen;
echo "<br>";
echo "Tamaño de la imagen en bytes: " . $size_imagen;
echo "<br>";
	

?>
