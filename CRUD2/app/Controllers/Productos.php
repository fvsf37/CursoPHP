<?php

namespace App\Controllers;

use App\Models\ProductoModel;

class Productos extends BaseController
{
    protected $productoModel;

    public function __construct()
    {
        // Inicializa el modelo
        $this->productoModel = new ProductoModel();
    }

    // Método para listar productos con paginación y búsqueda
    public function index()
    {
        $search = $this->request->getVar('search'); // Captura el término de búsqueda
        $perPage = $this->request->getVar('perPage') ?? 10; // Número de productos por página

        // Filtrar por término de búsqueda si está presente
        if ($search) {
            $this->productoModel->like('nombre', $search)
                ->orLike('descripcion', $search)
                ->orLike('categoria', $search);
        }

        // Configura los datos para la vista
        $data = [
            'productos' => $this->productoModel->paginate($perPage, 'productos'),
            'pager' => $this->productoModel->pager, // Paginador
            'search' => $search,
            'perPage' => $perPage,
        ];

        // Retorna la vista con los datos
        return view('productos/index', $data);
    }

    // Método para mostrar el formulario de agregar producto
    public function agregar()
    {
        // Si el formulario fue enviado
        if ($this->request->getMethod() === 'post') {
            $datos = [
                'nombre' => $this->request->getPost('nombre'),
                'descripcion' => $this->request->getPost('descripcion'),
                'categoria' => $this->request->getPost('categoria'),
                'precio' => $this->request->getPost('precio'),
                'stock' => $this->request->getPost('stock'),
                'id_productor' => $this->request->getPost('id_productor'),
            ];

            // Validar los datos antes de insertar
            if ($this->productoModel->save($datos)) {
                return redirect()->to('/productos')->with('success', 'Producto agregado correctamente.');
            } else {
                return redirect()->back()->with('errors', $this->productoModel->errors())->withInput();
            }
        }

        // Carga la vista para agregar
        return view('productos/agregar');
    }

    // Método para mostrar el formulario de edición de producto
    public function editar($id)
    {
        // Si el formulario fue enviado
        if ($this->request->getMethod() === 'post') {
            $datos = [
                'id' => $id,
                'nombre' => $this->request->getPost('nombre'),
                'descripcion' => $this->request->getPost('descripcion'),
                'categoria' => $this->request->getPost('categoria'),
                'precio' => $this->request->getPost('precio'),
                'stock' => $this->request->getPost('stock'),
                'id_productor' => $this->request->getPost('id_productor'),
            ];

            // Validar los datos antes de actualizar
            if ($this->productoModel->save($datos)) {
                return redirect()->to('/productos')->with('success', 'Producto actualizado correctamente.');
            } else {
                return redirect()->back()->with('errors', $this->productoModel->errors())->withInput();
            }
        }

        // Configura los datos para la vista
        $data = [
            'producto' => $this->productoModel->find($id),
        ];

        // Si no se encuentra el producto, redirige con un mensaje de error
        if (!$data['producto']) {
            return redirect()->to('/productos')->with('error', 'Producto no encontrado.');
        }

        // Carga la vista para editar
        return view('productos/editar', $data);
    }

    // Método para eliminar un producto
    public function eliminar($id)
    {
        // Verifica si el producto existe antes de eliminarlo
        if ($this->productoModel->find($id)) {
            $this->productoModel->delete($id);
            return redirect()->to('/productos')->with('success', 'Producto eliminado correctamente.');
        } else {
            return redirect()->to('/productos')->with('error', 'Producto no encontrado.');
        }
    }
}
