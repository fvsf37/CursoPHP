<?php

// Incluir el archivo "config.php", que contiene las constantes de configuración de la base de datos.
require("config.php");

class Conexion
{
    // Definimos una propiedad protegida llamada $conexion_db que almacenará el objeto de conexión a la base de datos.
    protected $conexion_db;

    // Constructor de la clase, se ejecuta cuando se crea una nueva instancia de la clase Conexion.
    public function __construct()
    {

        try {
            // Crear una nueva instancia de PDO para conectarse a la base de datos.
            // Actualmente, los valores de host, base de datos, usuario y contraseña están codificados.
            $this->conexion_db = new PDO('mysql:host=localhost; dbname=pruebas', 'root', '');

            // Si quieres usar las constantes definidas en "config.php", puedes descomentar esta línea y usar las constantes
            // $this->conexion_db = new PDO('mysql:host=' . DB_HOST . '; dbname=' . DB_NOMBRE, DB_USUARIO, DB_CONTRA);

            // Configurar PDO para que lance excepciones en caso de errores (esto facilita la gestión de errores).
            $this->conexion_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Establecer el conjunto de caracteres UTF-8 para manejar correctamente los caracteres especiales.
            $this->conexion_db->exec("SET CHARACTER SET utf8");

            // Devolvemos el objeto de conexión.
            return $this->conexion_db;

        } catch (Exception $e) {
            // Si ocurre un error en la conexión, se captura la excepción y se muestra un mensaje con la descripción del error.
            echo "La línea de error es: " . $e->getMessage(); // Mostrar el mensaje de error
        }
    }
}

?>