<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
       $view_data['titulo'] = "Título de mi aplicación";
        $view_data['fecha'] = $this->dime_fecha();

        return  view('template/header', ['titulo'=>'Home'])
               .view('inicio/inicio', $view_data)
               .view('template/footer');
      

    }


    public function sobre_mi(): string
    {
        return  view('template/header', ['titulo'=>'Sobre mi'])
               .view('inicio/sobre_mi')
               .view('template/footer');
    }



    private function dime_fecha(): string
    {
        return date('l \t\h\e jS');
    }
}
