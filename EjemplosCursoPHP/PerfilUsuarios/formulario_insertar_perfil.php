<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
	<form action="insertar_registro_perfil.php" method="get">
		<label>Usuario: <input type="text" name="us"></label>
		<label>Constraseña: <input type="text" name="con"></label>
		<select name="per" id="per">
			<option>Administrador</option>
			<option>Usuario</option>
		</select>
		<input type="submit" name="enviando" value="Registro">
	</form>
	
</body>
</html>