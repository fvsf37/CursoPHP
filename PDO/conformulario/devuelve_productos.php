<?php

    require("conexion.php");
    class DevuelveProductos extends Conexion{

        public function __construct(){
            parent::__construct(); //con esta linea de codigo ejecutamos el constructor de la clase Conexion. Es decir, conectar con la base de datos


        }

        public function get_productos($dato){
            $sql="SELECT * FROM productos WHERE PAISDEORIGEN='" . $dato ."'";
            $sentencia=$this->conexion_db->prepare($sql);
            $sentencia->execute(array());
            $resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);
            $sentencia->closeCursor();
            $this->conexion_db=null;
            return $resultado;
            
        }
    }

?>