<?php

// Incluir el archivo de conexión que contiene la clase Conexion
require("conexion.php");

class DevuelveProductos extends Conexion
{
    // Constructor de la clase DevuelveProductos
    // Este constructor ejecuta el constructor de la clase padre (Conexion)
    public function __construct()
    {
        // Llamamos al constructor de la clase padre (Conexion) para que se realice la conexión a la base de datos
        parent::__construct();
    }

    // Método para obtener los productos de acuerdo al país de origen pasado como argumento
    public function get_productos($dato)
    {
        // Consulta SQL para seleccionar todos los productos cuyo país de origen coincida con el parámetro $dato
        $sql = "SELECT * FROM productos WHERE PAISDEORIGEN='" . $dato . "'";

        // Preparamos la consulta utilizando PDO
        $sentencia = $this->conexion_db->prepare($sql);

        // Ejecutamos la consulta. Como no estamos usando parámetros externos (el valor ya está en $sql), pasamos un array vacío.
        $sentencia->execute(array());

        // Obtenemos todos los resultados de la consulta y los almacenamos en $resultado
        // La función fetchAll() nos devuelve un array asociativo con los resultados
        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        // Cerramos el cursor para liberar recursos
        $sentencia->closeCursor();

        // Devolvemos el array con los resultados
        return $resultado;

        // Cerramos la conexión con la base de datos
        // Nota: Este código nunca se ejecutará ya que está después de un return
        $this->conexion_db = null;
    }
}

?>