<?php
$busqueda = $_GET["buscar"];
require("datos_conexion.php");

$conexion = mysqli_connect($db_host, $db_usuario, $db_contra);

if (mysqli_connect_errno()) {
    echo "Fallo al conectar con la base de datos";
    exit();
}

mysqli_select_db($conexion, $db_nombre) or die("No se encuentra la base de datos");
mysqli_set_charset($conexion, "utf8");

$consulta = "SELECT * FROM productos WHERE 
CODIGOARTICULO LIKE '%$busqueda%' OR 
SECCION LIKE '%$busqueda%' OR 
NOMBREARTICULO LIKE '%$busqueda%' OR 
PRECIO LIKE '%$busqueda%' OR 
FECHA LIKE '%$busqueda%' OR 
IMPORTADO LIKE '%$busqueda%' OR 
PAISDEORIGEN LIKE '%$busqueda%'";

$resultados = mysqli_query($conexion, $consulta);

while ($fila = mysqli_fetch_array($resultados, MYSQLI_ASSOC)) {
    echo "<table><tr>";
    echo "<td>" . $fila['CODIGOARTICULO'] . "</td>";
    echo "<td>" . $fila['SECCION'] . "</td>";
    echo "<td>" . $fila['NOMBREARTICULO'] . "</td>";
    echo "<td>" . $fila['PRECIO'] . "</td>";
    echo "<td>" . $fila['FECHA'] . "</td>";
    echo "<td>" . $fila['IMPORTADO'] . "</td>";
    echo "<td>" . $fila['PAISDEORIGEN'] . "</td>";
    echo "</tr></table>";
}

mysqli_close($conexion);
?>