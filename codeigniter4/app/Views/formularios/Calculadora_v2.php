<?php namespace App\Controllers\formularios;

use App\Controllers\BaseController;

class Calculadora extends BaseController
{
    public function calculadora(): string
    {

        $data_view['action'] = '/calculadora';

        $calculo = $this->request->getPost('ans');
        if( empty($calculo) )
        {
            return view('formularios/calculadora', $data_view);
        }
        else
        {
            //comprobamos que el primer carácter de la cadena sea un entero o un signo positivo o negativo
            $primer_caracter = substr($calculo, 0, 1);
            if( !( is_numeric($primer_caracter) | $primer_caracter === '+' | $primer_caracter === '-' ) )
            {
                $data_view['error']='El valor recibido no se puede calcular';
                return view('formularios/calculadora', $data_view);            
            }
        }

        $array_numeros = $this->array_numeros_con_operador($calculo);

        // Si hay algún error al extraer los números
        if( empty($array_numeros) )
        {
            $data_view['error']='El valor recibido no se puede calcular';
            return view('formularios/calculadora', $data_view);
        }

        // Si sólo tenemos 1 número, lo retornamos
        if( count($array_numeros) <=1 )
        {
            $data_view['resultado'] = $array_numeros[0];
            return view('formularios/calculadora', $data_view);
        }

        // Recorremos el array para hacer las operaciones
        // Multiplicaciones
        for( $key = 1 ; $key < count($array_numeros) ; $key++ )
        {
            if( substr($array_numeros[$key], 0, 1) === '*' )
            {  
                if( substr($array_numeros[$key-1], 0, 1) === '/' )
                {
                    $operacion = substr($array_numeros[$key-1], 1) * substr($array_numeros[$key], 1);
                    $array_numeros[$key] = '/'.$operacion;
                }
                else
                    $array_numeros[$key] = $array_numeros[$key-1] * substr($array_numeros[$key], 1);

                $array_numeros[$key-1] = null;
            }
        }
        $array_numeros = $this->ordenar_array($array_numeros);

        // Divisiones
        for( $key = 1 ; $key < count($array_numeros) ; $key++ )
        {
            if( substr($array_numeros[$key], 0, 1) === '/' )
            {  
                if( substr($array_numeros[$key-1], 0, 1) === '*' )
                {
                    $operacion = substr($array_numeros[$key-1], 1) / substr($array_numeros[$key], 1);
                    $array_numeros[$key] = '*'.$operacion;
                }
                else
                    $array_numeros[$key] = $array_numeros[$key-1] / substr($array_numeros[$key], 1);

                $array_numeros[$key-1] = null;
            }
        }
        $array_numeros = $this->ordenar_array($array_numeros);

        // Sumas y restas
        for( $key = 1 ; $key < count($array_numeros) ; $key++ )
        {
                $array_numeros[$key] = $array_numeros[$key-1] + $array_numeros[$key];
                $array_numeros[$key-1] = null;
        }

        $data_view['resultado'] = $array_numeros[count($array_numeros)-1];
        return view('formularios/calculadora', $data_view);
       
    }


    /**
     * Sobre una cadena dada, retorna un array con todos los números y su operador delante
     * Si encuentra algún error, retorna false
     */
    private function array_numeros_con_operador($cadena, $array=false)
    {
        if( empty($cadena) )
            return false;

        $contador = 0;
        do
        {
            $numero = substr($cadena, $contador, 1);
            if( $contador === 0 && ($numero === '*' | $numero === '/' | $numero === '+' | $numero === '-') )
            {
                $numero = '.';
            }
            $contador++;
        } while ( ( intval($numero) | $numero == '0' | $numero === '.' ) && $contador <= strlen($cadena) );

        /* Recortamos desde el principio (posición 0)
           la cantidad de caracteres del contador (se resta 1 para omitir el caracter que ya no cumple)
        */
        $numero = substr($cadena, 0, $contador-1 );

        if( is_numeric($numero) //si es número
            | ( substr($numero, 0, 1) === '*' && is_numeric(substr($numero, 1)) ) // si el primer caracter es *
            | ( substr($numero, 0, 1) === '/' && is_numeric(substr($numero, 1)) ) // si el primer caracter es /
        )
        {
            // Guardamos el número en el array
            $array[] = $numero;
            
            // Quitamos el número de la cadena
            $cadena = substr($cadena,$contador-1);

            // Si queda cadena, llamamos recursivamente
            if( !empty($cadena) )
                return $this->array_numeros_con_operador($cadena, $array);
            else
                return $array;

        }
        else
            return false;
    }



    private function ordenar_array($array) {
        if( empty($array) )
            return false;

        $array_ordenado = null;
        foreach( $array as $valor )
            if( !empty($valor) )
                $array_ordenado[] = $valor;
        return $array_ordenado;
    }


}
