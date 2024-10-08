<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio3</title>
</head>
<body>
<form action="ejercicio3.php" method="get">
        <label for="numero1">Número 1:</label>
        <input type="number" id="numero1" name="numero1" required><br><br>

        <label for="numero2">Número 2:</label>
        <input type="number" id="numero2" name="numero2" required><br><br>

        <input type="submit" name="boton" value="Enviar">
</form>
    <?php 
        if(isset($_GET["boton"])){
            $min=$_GET["numero1"];
            $max=$_GET["numero2"];

            if($min<=$max){
            echo "José Ignacio Gavilán Sánchez". "<br>";
            for ($i= $min; $i<=$max; $i++){
                echo $i . ", ";
            }
        }else{
            
        }
        }
    ?>
</body>
</html>