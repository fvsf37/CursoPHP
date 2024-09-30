<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    $array = array(1, 2, 3, 4, 5);
    echo '<pre>';
    var_dump($array);
    echo '<hr>';
    $array[] = 6;
    echo '<pre>';
    var_dump($array);
    ?>
</body>

</html>