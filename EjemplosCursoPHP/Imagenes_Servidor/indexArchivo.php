<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
	<style>
		/* Estilo para la tabla de formulario */
		table {
			margin: auto;
			/* Centra la tabla en la página */
			width: 450px;
			/* Define un ancho fijo */
			border: 1px solid red;
			/* Borde rojo alrededor de la tabla */
		}
	</style>
</head>

<body>

	<!-- CONSTRUIMOS UN FORMULARIO PARA SUBIR ARCHIVOS -->

	<form action="datosArchivo.php" method="post" enctype="multipart/form-data">
		<!-- IMPORTANTE: El método POST es necesario al manejar archivos en formularios 
	y se debe incluir `enctype="multipart/form-data"` para que el archivo se envíe correctamente -->

		<table style="background-color: orange;">
			<tr>
				<!-- Etiqueta y campo de entrada para seleccionar el archivo a subir -->
				<td><label for="archivo">ARCHIVO:</label></td>
				<td><input type="file" name="archivo" size="20"></td> <!-- Selecciona el archivo para cargar -->
			</tr>

			<tr>
				<!-- Botón de envío para cargar el archivo al servidor -->
				<td colspan="2" style="text-align: center">
					<input type="submit" value="Enviar archivo"> <!-- Envía el formulario -->
				</td>
			</tr>
		</table>

	</form>
</body>

</html>