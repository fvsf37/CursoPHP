<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Formulario de Login</title>
	<style>
		h1 {
			text-align: center;
			/* Centra el título en la página */
		}

<<<<<<< HEAD
		table {
			width: 25%;
			background-color: lightyellow;
=======
		/* Estilo de la tabla donde se introduce el login y la contraseña */
		table {
			width: 25%;
			/* Define el ancho de la tabla al 25% del ancho de la ventana */
			background-color: lightyellow;
			/* Fondo de la tabla color amarillo claro */
>>>>>>> 7a93cebd5afbddf3294ef3a87752beb87e361cbd
			border: 2px solid #F49118;
			/* Borde anaranjado de 2px de grosor */
			margin: auto;
			/* Centra la tabla horizontalmente */
		}

<<<<<<< HEAD
=======
		/* Clase para alinear el texto a la derecha en las celdas */
>>>>>>> 7a93cebd5afbddf3294ef3a87752beb87e361cbd
		.izq {
			text-align: right;
		}

<<<<<<< HEAD
=======
		/* Clase para alinear el texto a la izquierda en las celdas */
>>>>>>> 7a93cebd5afbddf3294ef3a87752beb87e361cbd
		.der {
			text-align: left;
		}

<<<<<<< HEAD
=======
		/* Estilo de las celdas (td) para centrar el texto dentro de ellas y agregar padding */
>>>>>>> 7a93cebd5afbddf3294ef3a87752beb87e361cbd
		td {
			text-align: center;
			/* Centra el contenido del texto en las celdas */
			padding: 10px;
			/* Añade un espacio de 10px alrededor del contenido de cada celda */
		}
	</style>
</head>

<body>

<<<<<<< HEAD
	<h1>Introduce tus datos</h1>

	<form action="comprueba_login_3.php" method="post">
		<table>
			<tr>
				<td class="izq">LOGIN:</td>
				<td class="der"><input type="text" name="login"></td>
			</tr>
			<tr>
				<td class="izq">PASSWORD:</td>
				<td class="der"><input type="password" name="password"></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" name="enviar" value="Login"></td>
			</tr>
		</table>


=======
	<!-- Título centrado -->
	<h1>Introduce tus datos</h1>

	<!-- Formulario que envía los datos a comprueba_login_3.php por método POST -->
	<form action="comprueba_login_3.php" method="post">
		<table>
			<!-- Fila para el campo LOGIN -->
			<tr>
				<!-- Etiqueta LOGIN alineada a la derecha y campo de texto alineado a la izquierda -->
				<td class="izq">LOGIN:</td>
				<td class="der"><input type="text" name="login"></td>
			</tr>

			<!-- Fila para el campo PASSWORD -->
			<tr>
				<!-- Etiqueta PASSWORD alineada a la derecha y campo de contraseña alineado a la izquierda -->
				<td class="izq">PASSWORD:</td>
				<td class="der"><input type="password" name="password"></td>
			</tr>

			<!-- Fila para el botón de envío (Login) -->
			<tr>
				<!-- Colspan="2" se usa para que esta celda ocupe ambas columnas (login y password) -->
				<td colspan="2">
					<!-- Botón de enviar para el formulario -->
					<input type="submit" name="enviar" value="Login">
				</td>
			</tr>
		</table>
>>>>>>> 7a93cebd5afbddf3294ef3a87752beb87e361cbd
	</form>

</body>

</html>