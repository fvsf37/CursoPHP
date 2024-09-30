<?php

/* ESTE ARCHIVO SE ENCARGA DE EXTAER LA INFORMACION DE LA TABLA DE PRODUCTOS*/
class Productos_modelo{
	
	private $db; /*aqui almacenaremos la conexion*/ 
	private $productos;/*aqui almacenaremos los productos*/
	
/*	public function _construct(){
		// require_once("conectar.php");
		require_once("modelo/conectar.php");//HAY QUE TRATAR TODAS LAS RUTAS COMO SI APUNTARAN DESDE EL INDEX
		$this->db=Conectar::conexion(); // De esta manera almacenamos la conexion dentro de la variable $db
		$this->productos= array();
		
	}
*/
	public function conecta(){
		// require_once("conectar.php");
		require_once("modelo/conectar.php");//HAY QUE TRATAR TODAS LAS RUTAS COMO SI APUNTARAN DESDE EL INDEX
		$this->db=Conectar::conexion(); // De esta manera almacenamos la conexion dentro de la variable $db, llamando a la Clase Conectar, poniendo :: y el método conexión()
		$this->productos= array();
		
		return $this->db;
	}

	public function get_productos(){
		$this->productos=$this->db->query("SELECT * FROM productos");
/*		while ($filas=$consulta->fetch(PDO::FETCH_ASSOC)){
			$this->productos=$filas;
				
		}
		*/

		return $this->productos;
		
	}
}

?>