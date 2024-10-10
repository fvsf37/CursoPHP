<?php

// Incluir el archivo "conexion.php" que contiene la clase Conexion, que maneja la conexión a la base de datos
require("conexion.php");

// Definición de la clase DevuelveProductos que extiende de la clase Conexion
class DevuelveProductos extends Conexion
{

    // Constructor de la clase DevuelveProductos
    public function __construct()
    {
        // Ejecutamos el constructor de la clase padre (Conexion) que establece la conexión con la base de datos
        parent::__construct();
    }

    // Método para obtener los productos en función del país de origen
    public function get_productos($dato)
    {
        // Ejecutamos una consulta SQL que selecciona todos los productos cuyo país de origen coincida con el valor pasado como argumento ($dato)
        $resultados = $this->conexion_db->query('SELECT * FROM productos WHERE PAISDEORIGEN="' . $dato . '"');

        // Usamos fetch_all() para obtener todos los resultados en forma de un array asociativo
        $productos = $resultados->fetch_all(MYSQLI_ASSOC);

        // Devolvemos el array de productos
        return $productos;
    }
}

?>