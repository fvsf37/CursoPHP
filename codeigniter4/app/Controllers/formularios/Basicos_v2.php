<?php namespace App\Controllers\formularios;

use App\Controllers\BaseController;

class Basicos extends BaseController
{

    /**
     * Muestra formulario para cálculo de edad
     */
    public function formulario_edad(): string
    {
        $data_view['error'] = '';
        $error = $this->request->getGet('error');
        if( !empty( $error ) )
        {
            $data_view['error'] = $error;
        }

        return view('formularios/edad', $data_view);
    }

    /**
     * Calcula edad y muestra resultado
     */
    public function calculo_edad()
    {
        $data_view['edad'] = $this->request->getPost('edad', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if( !is_numeric($data_view['edad']) )
        {
            return redirect()->to('/formularios/edad/?error=edad incorrecta'); 
        }

        return view('formularios/calculo_edad', $data_view);
    }


    public function calculadora(): string
    {

        $calculo = $this->request->getPost('ans');
        if( empty($calculo) )
        {
            return view('formularios/calculadora');
        }
 
        // hacemos las multiplicaciones y divisiones
        $calculo = $this->calcular($calculo, '*');
        $calculo = $this->calcular($calculo, '/');

        if( !$calculo )
        {
            $data_view['error']='El valor recibido no se puede calcular';
            return view('formularios/calculadora', $data_view);
        }

        // guardamos en un array todos los números que quedan con su signo
        $contador = 0;
        do
        {
            $numero = $this->numero_inicial($calculo, true);
            $sumas_y_restas[] = $numero;
            $calculo = substr($calculo, strlen($numero) );
            $contador++;
        
        } while( strlen($calculo) > 0 );

        // sumamos todos los números
        $count_sumas_y_restas = count($sumas_y_restas);
        if( $count_sumas_y_restas > 1 )
        {
            // Si hay más de 1 resultado, hay que sumarlos todos (las restas se consideran operador negativo)
            $resultado = $sumas_y_restas[0] + $sumas_y_restas[1];
            for( $i=2 ; $i < $count_sumas_y_restas ; $i++ ) {
                $resultado = $resultado + $sumas_y_restas[$i];
            }

        }
        else if( $count_sumas_y_restas == 1 )
        {
            // sólo hay un resultado
            $resultado = $sumas_y_restas[0];
        }
        else
        {
            $data_view['error']='El valor recibido no se puede calcular';
            return view('formularios/calculadora', $data_view);
        }

        $data_view['resultado'] = $resultado;
        return view('formularios/calculadora', $data_view);
    }

    /**
     * Sobre una cadena dada, calcula el operador indicado (sólo para multiplicación y división)
     */
    private function calcular($cadena, $operador) {

        if( empty($cadena) | empty($operador) )
        {
            return false;
        }
        
        $multiplicaciones = explode($operador,$cadena);
        if( count($multiplicaciones) > 1 ) {

            //duplicamos el array para trabajar sobre el duplicado las sustituciones de los cálculos
            $multiplicaciones_sustituidas = $multiplicaciones;

            foreach( $multiplicaciones as $indice => $rango )
            {
                // si es el último registro, salimos ya que no hay que hacer más cálculos
                if( $indice >= count($multiplicaciones)-1 ) {
                    break;
                }
                
                // obtenemos el último número completo (hasta el signo) de este rango
                $numero_final = $this->numero_final($rango);
                if( !$numero_final ) // error
                {
                    return false;
                }
                
                // obtenemos el primer número completo (hasta el signo) de este rango
                $numero_inicial = $this->numero_inicial($multiplicaciones[$indice+1]);
                if( !$numero_inicial ) // error
                {
                    return false;
                }

                switch( $operador )
                {
                    case '*':
                        $numero_calculado = $numero_final * $numero_inicial;
                        break;
                    case '/':
                        $numero_calculado = $numero_final / $numero_inicial;
                        break;
                }
                
                // Sustituimos en el array los valores calculados
                $multiplicaciones_sustituidas[$indice] = substr($multiplicaciones_sustituidas[$indice], 0 , -1*strlen($numero_final) ).$numero_calculado;
                $multiplicaciones_sustituidas[$indice+1] = substr($multiplicaciones_sustituidas[$indice+1], strlen($numero_inicial) );

            }
            
            // concatenamos en un string las multplicaciones sustituidas
            $calculo = '';
            foreach( $multiplicaciones_sustituidas as $valor )
            {
                $calculo.=$valor;
            }
            
            return $calculo;
        }
        else
        {
            // no hay esa operación
            return $cadena;
        }

    }

    /**
     * Sobre una cadena dada, retorna el número entero empezando por el final
     */
    private function numero_final($cadena) {
        
        if( empty($cadena) )
        {
            return false;
        }

        $contador = 0;
        do
        {
            $contador--;
            $numero = substr($cadena, $contador, 1);
        } while ( ( intval($numero) | $numero == '0' | $numero === '.' ) && (-1 * $contador) <= strlen($cadena) );

        /* Recortamos desde una posición de antes del contador
           (se suma uno porque vamos en negativo y hay que omitir el caracter que ya no cumple [numero, 0 ó .])
           la cantidad de caracteres del contador (se omite el caracter que ya no cumple sumando 1 y se pasa a positivo)
        */
        $numero = substr($cadena, $contador+1, -1*($contador+1) );

        if( is_numeric($numero) )
        {
            return $numero;
        }
        else
        {
            return false;
        }
    }

    /**
     * Sobre una cadena dada, retorna el número entero empezando por el principio
     */
    private function numero_inicial($cadena, $signo = false) {
        
        if( empty($cadena) )
        {
            return false;
        }

        $contador = 0;
        do
        {
            $numero = substr($cadena, $contador, 1);
            if( $signo && $contador === 0 && ($numero === '+' | $numero === '-') )
            {
                $numero = '.';
            }
            $contador++;
        } while ( ( intval($numero) | $numero == '0' | $numero === '.' ) && $contador <= strlen($cadena) );

        /* Recortamos desde el principio (posición 0)
           la cantidad de caracteres del contador (se resta 1 para omitir el caracter que ya no cumple)
        */
        $numero = substr($cadena, 0, $contador-1 );

        if( is_numeric($numero) )
        {
            return $numero;
        }
        else
        {
            return false;
        }
    }


}
