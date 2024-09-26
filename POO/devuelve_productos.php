<?php

    require("conexion.php");
    class DevuelveProductos extends Conexion{

        public function __construct(){
            parent::__construct(); //con esta linea de codigo ejecutamos el constructor de la clase Conexion. Es decir, conectar con la base de datos


        }

        public function get_productos(){
            $resultados=$this->conexion_db->query('SELECT * FROM productos');
            $productos=$resultados->fetch_all(MYSQLI_ASSOC);
            return $productos;
        }
    }

?>