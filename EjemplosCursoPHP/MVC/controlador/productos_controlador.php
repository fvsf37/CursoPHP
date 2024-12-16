<?php

// require_once("../modelo/productos_modelo.php");
require_once("modelo/productos_modelo.php");//HAY QUE TRATAR TODAS LAS RUTAS COMO SI APUNTARAN DESDE EL INDEX
$producto = new Productos_modelo(); // CON ESTO INSTANCIAMOS LA CLASE PRODUCTOS MODELO
$conex = $producto->conecta();
$matrizProductos = $producto->get_productos();


// require_once("../vista/productos_vista.php");
require_once("vista/productos_vista.php");//HAY QUE TRATAR TODAS LAS RUTAS COMO SI APUNTARAN DESDE EL INDEX

?>