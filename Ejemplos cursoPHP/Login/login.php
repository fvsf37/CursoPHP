<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
	<style>
	
		h1{
			text-align: center;
		}
		
		table{
			width: 25%;
			background-color:lightyellow;
			border: 2px solid #F49118;
			margin: auto;
		}
		.izq{
			text-align: right;
		}
		.der{
			text-align: left;
		}
		td{
			text-align: center;
			padding: 10px;
		}
	
	</style>
</head>

<body>
	
<h1>Introduce tus datos</h1>
	
<form action="comprueba_login.php" method="post">
	<table>
	<tr><td class="izq">LOGIN:</td><td class="der"><input type="text" name="login"></td></tr>
	<tr><td class="izq">PASSWORD:</td><td class="der"><input type="password" name="password"></td></tr>
	<tr><td colspan="2"><input type="submit" name="enviar" value="Login"></td></tr>
	</table>
		
	
</form> 
	
</body>
</html>