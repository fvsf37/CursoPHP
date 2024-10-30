<!doctype html>
<html>
<head>
    <meta charset="utf-8">
       <title>Documento sin título</title>
       <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        h1 {
            color: #555;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Estilos del contenedor de cada archivo */
        .archivo-container {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
            width: 80%;
            max-width: 600px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Estilos para el ID y tipo de archivo */
        .archivo-info {
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* Estilos para la imagen */
        .archivo-imagen img {
            max-width: 100%;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>

<h1>Visualización de Archivos</h1>

<?php
$Id = "";
$contenido = "";
$tipo = "";

// Conectar con la base de datos
require("datos_conexion.php");
$conexion = mysqli_connect($servername, $username, $password, $database);
if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}
$consulta = "SELECT * FROM archivos";
$resultado = mysqli_query($conexion, $consulta);

while ($fila = mysqli_fetch_array($resultado)) {
    $Id = $fila["id"];
    $tipo = $fila["tipo"];
    $contenido = $fila["contenido"];

    echo "<div class='archivo-container'>";
    echo "<div class='archivo-info'>ID: " . $Id . "</div>";
    echo "<div class='archivo-info'>Tipo: " . $tipo . "</div>";

    // Mostrar la imagen decodificada
    echo "<div class='archivo-imagen'><img src='data:image/jpeg;base64," . base64_encode($contenido) . "' alt='Imagen'></div>";
    echo "</div>";
}
?>

</body>
</html>
