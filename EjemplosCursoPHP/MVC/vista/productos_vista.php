<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
	<style>
		td {
			border: 1px dotted red;

		}

		#titulo {
			font-weight: bold;
			color: blue;
			text-align: center;
		}
	</style>
</head>

<body>

	<table>
		<tr id="titulo">
			<td>CODIGOARTICULO</td>
			<td>SECCION</td>
			<td>NOMBREARTICULO</td>
			<td>PRECIO</td>
			<td>FECHA</td>
			<td>IMPORTADO</td>
			<td>PAISDEORIGEN</td>
		</tr>

		<?php

		foreach ($matrizProductos as $registro) {

			//echo "<tr><td>" . $registro['NOMBREARTICULO'] . "</td></tr>";
		
			echo "<tr><td>" . $registro['CODIGOARTICULO'] . "</td>";
			echo "<td>" . $registro['SECCION'] . "</td>";
			echo "<td>" . $registro['NOMBREARTICULO'] . "</td>";
			echo "<td>" . $registro['PRECIO'] . "</td>";
			echo "<td>" . $registro['FECHA'] . "</td>";
			echo "<td>" . $registro['IMPORTADO'] . "</td>";
			echo "<td>" . $registro['PAISDEORIGEN'] . "</td></tr>";

		}

		?>
	</table>

</body>

</html>