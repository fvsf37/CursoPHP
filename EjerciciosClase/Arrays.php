<?php
$semana = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
foreach ($semana as $dia) {
    echo "$dia, ";
}

sort($semana);
echo "<br>";
for ($i = 0; $i < count($semana); $i++) {
    echo $semana[$i] . "<br>";
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
echo "<br>" . "<br>";

$alimentos = array(
    "fruta" => array("tropical" => "kiwi", "citrico" => "mandarina", "otros" => "manzana"),
    "leche" => array("animal" => "vaca", "vegetal" => "coco"),
    "carne" => array("vacuno" => "lomo", "porcino" => "pata")
);
echo $alimentos["carne"]["vacuno"] . "<br>";
foreach ($alimentos as $clave_alim => $alim) {
    echo "$clave_alim:<br>";
    foreach ($alim as $clave => $valor) {
        echo "$clave=$valor<br>";
    }
    echo "<br>";
}
echo var_dump($alimentos);
?>