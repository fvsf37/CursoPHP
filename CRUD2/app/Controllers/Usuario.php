<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuario extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usuario_model');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['usuarios'] = $this->Usuario_model->obtener_usuarios();
        $this->load->view('usuario/index', $data);
    }

    public function agregar()
    {
        if ($this->input->post()) {
            $datos = array(
                'nombre' => $this->input->post('nombre'),
                'email' => $this->input->post('email'),
                'telefono' => $this->input->post('telefono')
            );
            $this->Usuario_model->agregar_usuario($datos);
            redirect('usuario');
        } else {
            $this->load->view('usuario/agregar');
        }
    }

    public function editar($id)
    {
        if ($this->input->post()) {
            $datos = array(
                'nombre' => $this->input->post('nombre'),
                'email' => $this->input->post('email'),
                'telefono' => $this->input->post('telefono')
            );
            $this->Usuario_model->actualizar_usuario($id, $datos);
            redirect('usuario');
        } else {
            $data['usuario'] = $this->Usuario_model->obtener_usuario($id);
            $this->load->view('usuario/editar', $data);
        }
    }

    public function eliminar($id)
    {
        $this->Usuario_model->eliminar_usuario($id);
        redirect('usuario');
    }
}
