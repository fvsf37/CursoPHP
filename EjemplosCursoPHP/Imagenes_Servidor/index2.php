<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
	<style>
		table{
			margin:auto;
			width: 450px;
			border: 1px solid red;
			
		}
	</style>
</head>

<body>
	
<!--CONSTRUIMOS UN FORMULARIO-->
	
<form action="datosimagen2.php" method="post" enctype="multipart/form-data">
<!--OBLIGATORIAMENTE CON ARCHIVOS O IMAGENES EL MÉTODO TIENE QUE SER TIPO POST-->	

	<table>
		<tr>
			<td><label for="imagen">Imagen:</label></td>
			<td><input type="file" name="imagen" size="20"></td>
		</tr>
		
		<tr>
			<td colspan="2" style="text-align: center">
				<input type="submit" value="Enviar imagen">
			</td>
		</tr>
	</table>
	
</form>
</body>
</html>