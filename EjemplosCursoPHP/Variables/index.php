<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $a=10;
        echo "a: $a <br>";

        $a++;
        echo "a: $a <br>";

        function funcion_a(){
            $a=20;
            echo "a (en funcion): $a";
        }

        for ($i=1; $i<=5; $i++){
            $a++;
            echo "a (en for): $a <br>"; 
        }

        /*
        for ($i=1; $i<=5; $i++){
            $a++;
            echo "a (en for): $a <br>"; 
            $b=33;
        }
        echo "b: $b<br>"; // He definido $b dentro del for, pero están en el mismo ámbito, se puede utilizar fuera del bucle
        */
        funcion_a();

    ?>
</body>
</html>