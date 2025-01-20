<?php
namespace App\Controllers;

use App\Models\ProductoModel;

class Productos extends BaseController
{
    protected $productoModel;

    public function __construct()
    {
        $this->productoModel = new ProductoModel();
    }

    // Método para listar productos con paginación y búsqueda
    public function index()
    {
        $search = $this->request->getVar('search'); // Captura el término de búsqueda
        $perPage = $this->request->getVar('perPage') ?? 10; // Número de productos por página

        if ($search) {
            $this->productoModel->like('nombre', $search)
                ->orLike('descripcion', $search)
                ->orLike('categoria', $search);
        }

        $data['productos'] = $this->productoModel->paginate($perPage, 'productos');
        $data['pager'] = $this->productoModel->pager;
        $data['search'] = $search;
        $data['perPage'] = $perPage;

        return view('productos/index', $data);
    }

    // Método para mostrar el formulario de agregar producto
    public function agregar()
    {
        if ($this->request->getMethod() === 'post') {
            $datos = [
                'nombre' => $this->request->getPost('nombre'),
                'descripcion' => $this->request->getPost('descripcion'),
                'categoria' => $this->request->getPost('categoria'),
                'precio' => $this->request->getPost('precio'),
                'stock' => $this->request->getPost('stock'),
                'id_productor' => $this->request->getPost('id_productor'),
            ];
            $this->productoModel->insert($datos);
            return redirect()->to('/productos');
        }
        return view('productos/agregar');
    }

    // Método para mostrar el formulario de edición de producto
    public function editar($id)
    {
        if ($this->request->getMethod() === 'post') {
            $datos = [
                'nombre' => $this->request->getPost('nombre'),
                'descripcion' => $this->request->getPost('descripcion'),
                'categoria' => $this->request->getPost('categoria'),
                'precio' => $this->request->getPost('precio'),
                'stock' => $this->request->getPost('stock'),
                'id_productor' => $this->request->getPost('id_productor'),
            ];
            $this->productoModel->update($id, $datos);
            return redirect()->to('/productos');
        }
        $data['producto'] = $this->productoModel->find($id);
        return view('productos/editar', $data);
    }

    // Método para eliminar un producto
    public function eliminar($id)
    {
        $this->productoModel->delete($id);
        return redirect()->to('/productos');
    }
}
