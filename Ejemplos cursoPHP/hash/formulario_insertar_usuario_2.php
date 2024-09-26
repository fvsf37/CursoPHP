<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<style>
	div{
		border: 1px red solid;
		background-color: yellow;
		width: 500px;
		margin: 100px auto;
		padding: 50px
	}
</style>
</head>

<body>
	<div>
	<form action="insertar_usuario_2.php" method="get">
		<h1>INSERTAR USUARIO</h1>
		<label>Usuario: </label>
		<br>
	    <input type="text" name="us">
		<br>
		<br>
		<label>Constraseña:</label>
		<br>
		<input type="text" name="con">
		<br>
		<br>
		<input type="submit" name="enviando" value="Registro">
	</form>
</div>
	
</body>
</html>