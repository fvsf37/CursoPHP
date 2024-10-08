<?php namespace App\Controllers\formularios; 

use App\Controllers\BaseController; 


class Basicos extends BaseController
{

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

    public function calculo_edad()
    {
        $data_view['edad'] = $this->request->getPost('edad', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if( !is_numeric($data_view['edad']) )
        {
            return redirect()->to('/formularios/edad/?error=edad incorrecta'); 
        }

        return view('template/header')
              .view('formularios/calculo_edad', $data_view)
              .view('template/footer');
    }


    public function calculadora(): string
    {
        $data_view['resultado'] = '';
        $calculo = $this->request->getPost('ans');
        
        if( !empty($calculo) )
        {
            $data_view['resultado'] = math_eval($calculo);
        }
        
        return view('formularios/calculadora', $data_view);
    }


}

?>