<?php
$semana = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
foreach ($semana as $dia) {
    echo "$dia, ";
}
echo "<br>" . "<br>";

//echo $semana[2] . "<br>";

$datos = array("Nombre" => "Pepe", "Apellido" => "Pérez", "Edad" => 15);
foreach ($datos as $clave => $valor) {
    echo $clave . ": " . $valor . "<br>";
}
echo "<br>";
if (is_array($datos)) {
    echo "Es un array";
} else {
    echo "No es un array";
}

?>