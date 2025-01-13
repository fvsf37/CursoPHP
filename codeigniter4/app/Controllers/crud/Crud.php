<?php namespace App\Controllers\Crud;

use App\Controllers\BaseController;
use App\Models\crud\CrudModel;

class Crud extends BaseController
{
    public function listado()
    {
        //Cargamos el modelo
        $crud_model = new CrudModel();

        //Obtenemos los datos
        $resultado = $crud_model->getAll();
        $view_data['productos'] = $resultado->getResultArray();

        return view('crud/listado', $view_data);
    }
}
