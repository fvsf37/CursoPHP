<?php

	class Compra_vehiculo{
		
		private $precio_base;
		static $ayuda;
		
		//static $ayuda=4500;
		//private static $ayuda=4500;
		
				
		function Compra_vehiculo($gama){
			
			if($gama=="urbano"){
				
					$this->precio_base=10000;
				
			}else if($gama=="compacto"){
				
				
					$this->precio_base=20000;	
				
			}
			
			else if($gama=="berlina"){
				
					$this->precio_base=30000;	
				
			}		
			
			
		}// fin constructor
		
		
		
		
		function climatizador(){		
			
			
				$this->precio_base+=2000;					
			
			
		}// fin climatizador
		
		
		function navegador_gps(){
			
			$this->precio_base+=2500;	
			
		}//fin navegador gps
		
		
		
		function tapiceria_cuero($color){
			
			if($color=="blanco"){
			
				$this->precio_base+=3000;
			}
			
			else if($color=="beige"){
				
				$this->precio_base+=3500;
				
			}
			
			else{
				
				$this->precio_base+=5000;
				
			}
			
		}// fin tapicería
		
		
		
		function precio_final(){
			
			$valor_final=$this->precio_base-self::$ayuda;
			
			return $valor_final;	
			
		}// fin precio final
		
		static function descuento_gobierno(){
			$date1 = new DateTime("now");
			$date2 = new DateTime("2023-09-25");
			if ($date1 > $date2){
				self::$ayuda=4500;
			}
			//echo var_dump($date1) . "<br>";
			//echo var_dump($date2) . "<br>";
		}


		
	}// fin clase


?>