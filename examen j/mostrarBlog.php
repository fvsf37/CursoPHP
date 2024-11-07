<!DOCTYPE html>
<html lang="en">
<head>
  <title>Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php
$link = new PDO('mysql:host=localhost;dbname=pruebas', 'root', ''); 

?>

<table class="table table-striped">
  	
		<thead>
		<tr>
			<th>Titulo</th>
			<th>Descripción</th>
            <th>Imagen</th>
			
		</tr>
		</thead>
<?php foreach ($link->query('SELECT * from blog') as $row){ ?> 
<tr>
    <td><?php echo $row['titulo'] ?></td>
    <td><?php echo $row['descripcion'] ?></td>
    <td><?php echo $row['imagen'] ?></td>
 </tr>
<?php
	}
?>
</table>
</body>
</html>