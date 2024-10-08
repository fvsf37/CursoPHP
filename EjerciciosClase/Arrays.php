<?php
// Declaramos un array llamado $semana con los días de la semana
$semana = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");

// Usamos un bucle foreach para recorrer el array $semana e imprimir cada día seguido de una coma
foreach ($semana as $dia) {
    echo "$dia, "; // Imprime cada elemento del array, ejemplo: Lunes, Martes, ...
}

echo "<br>";

// Usamos la función sort() para ordenar el array $semana en orden alfabético
sort($semana);

// Usamos un bucle for para recorrer el array $semana ordenado e imprimir cada día en una nueva línea
for ($i = 0; $i < count($semana); $i++) {
    echo $semana[$i] . "<br>"; // Imprime los días en orden alfabético
}

echo "<br>" . "<br>"; // Salto de línea

// Declaramos un array asociativo $datos con claves y valores
$datos = array("Nombre" => "Pepe", "Apellido" => "Pérez", "Edad" => 15);

// Usamos un bucle foreach para recorrer el array asociativo e imprimir cada clave y valor
foreach ($datos as $clave => $valor) {
    echo $clave . ": " . $valor . "<br>"; // Imprime algo como: Nombre: Pepe
}

echo "<br>";

// Verificamos si $datos es un array usando la función is_array() y mostramos un mensaje
if (is_array($datos)) {
    echo "Es un array"; // Si $datos es un array, imprime este mensaje
} else {
    echo "No es un array"; // Si no lo es, imprime este mensaje
}

echo "<br>" . "<br>"; // Salto de línea

// Declaramos un array multidimensional $alimentos
$alimentos = array(
    "fruta" => array("tropical" => "kiwi", "citrico" => "mandarina", "otros" => "manzana"),
    "leche" => array("animal" => "vaca", "vegetal" => "coco"),
    "carne" => array("vacuno" => "lomo", "porcino" => "pata")
);

// Imprimimos un valor específico del array multidimensional
echo $alimentos["carne"]["vacuno"] . "<br>"; // Imprime "lomo"

// Recorremos el array $alimentos con un bucle foreach anidado
foreach ($alimentos as $clave_alim => $alim) {
    echo "$clave_alim:<br>"; // Imprime la clave principal del array (fruta, leche, carne)

    // Recorremos el subarray de cada categoría de alimentos
    foreach ($alim as $clave => $valor) {
        echo "$clave=$valor<br>"; // Imprime la clave y el valor de los subarrays, por ejemplo: tropical=kiwi
    }
    echo "<br>"; // Salto de línea
}

// Usamos var_dump() para mostrar la estructura del array $alimentos
echo var_dump($alimentos);

echo "<br><br>";

// Declaramos un array $numeros con una lista de números
$numeros = [1, 2, 3, 4, 5, 6, 7];

// Mostramos la estructura del array $numeros
var_dump($numeros);

echo "<br>";

// Agregamos un número al final del array $numeros usando array_push()
$num_agragado = 10;
array_push($numeros, $num_agragado);

// Mostramos el array después de agregar el número 10
var_dump($numeros);

echo "<br>";

// Eliminamos el primer elemento del array usando array_shift() y mostramos cuál fue eliminado
$primer_num = array_shift($numeros);
echo "Array después de eliminar $primer_num<br>";

// Mostramos el array después de eliminar el primer número
var_dump($numeros);

echo "<br>";

// Ordenamos el array de manera descendente usando rsort()
rsort($numeros);

// Mostramos el array ordenado en orden descendente
echo "Array ordenado de forma descendente:<br>";
var_dump($numeros);

echo "<br>";

// Buscamos si el número 5 existe en el array usando in_array()
$num_buscardo = 5;
if (in_array($num_buscardo, $numeros)) {
    echo "El número $num_buscardo existe"; // Si el número 5 está en el array, imprime este mensaje
} else {
    echo "El número $num_buscardo no existe"; // Si no está, imprime este mensaje
}

?>