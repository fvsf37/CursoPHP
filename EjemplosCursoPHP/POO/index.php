<?php
    require("devuelve_productos.php");
    $productos=new DevuelveProductos();
    $array_productos=$productos->get_productos();

    foreach ($array_productos as $elemento){
        echo "<table><tr><td>";
        echo $elemento['CODIGOARTICULO'] . "</td><td>";
        echo $elemento['SECCION'] . "</td><td>";
        echo $elemento['NOMBREARTICULO'] . "</td><td>";
        echo $elemento['PRECIO'] . "</td><td>";
        echo $elemento['FECHA'] . "</td><td>";
        echo $elemento['IMPORTADO'] . "</td><td>";
        echo $elemento['PAISDEORIGEN'] . "</td></tr></table>";
    }
    

?>