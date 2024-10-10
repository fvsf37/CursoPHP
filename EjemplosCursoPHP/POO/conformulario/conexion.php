<?php

// Incluir el archivo "config.php" que contiene las constantes de configuración de la base de datos
require("config.php");

// Definición de la clase Conexion que maneja la conexión a la base de datos
class Conexion
{
    // Propiedad protegida para almacenar la conexión a la base de datos
    protected $conexion_db;

    // Constructor de la clase Conexion
    public function __construct()
    {
        // Crear una nueva instancia de mysqli para conectarse a la base de datos
        // Utiliza las constantes definidas en "config.php" para los parámetros de conexión
        $this->conexion_db = new mysqli(DB_HOST, DB_USUARIO, DB_CONTRA, DB_NOMBRE);

        // Verificar si hubo un error al intentar conectar
        if ($this->conexion_db->connect_errno) {
            // Si hay un error, mostrar un mensaje detallado
            echo "Fallo al conectar a MySQL: " . $this->conexion_db->connect_error;
            // Detener la ejecución del script para evitar errores posteriores
            return;
        }

        // Establecer el conjunto de caracteres para la conexión a la base de datos
        // Esto asegura que se manejen correctamente caracteres especiales como acentos
        $this->conexion_db->set_charset(DB_CHARSET);
    }
}

?>