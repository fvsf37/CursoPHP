<?php

namespace App\Controllers;

use App\Models\ProductoModel;
use CodeIgniter\Controller;

class Producto extends Controller
{
    public function index()
    {
        $productoModel = new ProductoModel();
        $data['productos'] = $productoModel->findAll(); // Obtener todos los productos

        return view('productos/index', $data);
    }

    public function create()
    {
        return view('productos/create'); // Mostrar formulario de agregar producto
    }

    public function store()
    {
        $productoModel = new ProductoModel();

        // Obtener datos del formulario
        $data = [
            'codigo' => $this->request->getPost('codigo'),
            'descripcion' => $this->request->getPost('descripcion'),
            'precioVenta' => $this->request->getPost('precioVenta'),
            'precioCompra' => $this->request->getPost('precioCompra'),
            'existencias' => $this->request->getPost('existencias'),
        ];

        // Insertar en la base de datos
        $productoModel->insert($data);

        // Redirigir con mensaje de éxito
        return redirect()->to('/producto')->with('mensaje', 'Producto agregado correctamente.');
    }

    public function edit($id)
    {
        $productoModel = new ProductoModel();
        $data['producto'] = $productoModel->find($id); // Buscar producto por ID

        if (!$data['producto']) {
            return redirect()->to('/producto')->with('error', 'Producto no encontrado.');
        }

        return view('productos/edit', $data); // Mostrar formulario de edición
    }

    public function update($id)
    {
        $productoModel = new ProductoModel();

        // Obtener datos actualizados del formulario
        $data = [
            'codigo' => $this->request->getPost('codigo'),
            'descripcion' => $this->request->getPost('descripcion'),
            'precioVenta' => $this->request->getPost('precioVenta'),
            'precioCompra' => $this->request->getPost('precioCompra'),
            'existencias' => $this->request->getPost('existencias'),
        ];

        // Verificar si el producto existe antes de actualizar
        if (!$productoModel->find($id)) {
            return redirect()->to('/producto')->with('error', 'Producto no encontrado.');
        }

        // Actualizar producto en la base de datos
        $productoModel->update($id, $data);

        return redirect()->to('/producto')->with('mensaje', 'Producto actualizado correctamente.');
    }

    public function delete($id)
    {
        $productoModel = new ProductoModel();

        // Verificar si el producto existe antes de eliminar
        if (!$productoModel->find($id)) {
            return redirect()->to('/producto')->with('error', 'El producto no existe.');
        }

        $productoModel->delete($id);
        return redirect()->to('/producto')->with('mensaje', 'Producto eliminado correctamente.');
    }
}
