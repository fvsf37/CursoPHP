<?php

/* ESTE ARCHIVO CONECTA CON LA BASE DE DATOS Y DEVUELVE LA CONEXION*/
	class Conectar{
		
		public static function conexion (){
			
				
			try{
				$conexion=new PDO("mysql:host=localhost; dbname=pruebas", "root", "");
				$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$conexion->exec("SET CHARACTER SET utf8");

			}catch (Exception $e){
				die ("Error: " . $e->getMessage());
				echo "Linea del Error: " . $e->getLine();

			}
			return $conexion; /* importante devolver la conexion*/
			
		}
		
	}

?>
