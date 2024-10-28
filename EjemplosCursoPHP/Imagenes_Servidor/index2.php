<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Subir Imagen a datosimagen2.php</title>
	<style>
		table {
			margin: auto;
			width: 450px;
			border: 1px solid red;
		}
	</style>
</head>

<body>

	<!-- FORMULARIO DE SUBIDA DE IMAGEN A datosimagen2.php -->

	<form action="datosimagen2.php" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td><label for="imagen">Imagen:</label></td>
				<td><input type="file" name="imagen" size="20"></td> <!-- Selector de archivo para la imagen -->
			</tr>

			<tr>
				<td colspan="2" style="text-align: center">
					<input type="submit" value="Enviar imagen a datosimagen2.php">
					<!-- Botón de envío para datosimagen2.php -->
				</td>
			</tr>
		</table>

	</form>
</body>

</html>