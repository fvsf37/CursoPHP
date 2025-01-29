<?php

namespace App\Controllers;

use App\Models\ProductoModel;
use CodeIgniter\Controller;

class Producto extends Controller
{
    public function index()
    {
        $productoModel = new ProductoModel();

        // Obtener el número de elementos por página (5, 10, 20)
        $perPage = $this->request->getGet('perPage') ?? 10; // Por defecto 10
        $page = $this->request->getGet('page') ?? 1; // Página actual

        // Convertir valores a enteros
        $perPage = (int) $perPage;
        $page = (int) $page;

        // Calcular el offset
        $offset = ($page - 1) * $perPage;

        // Obtener productos paginados
        $data['productos'] = $productoModel->getPaginatedProducts($perPage, $offset);
        $data['total'] = $productoModel->countAllResults();
        $data['perPage'] = $perPage;
        $data['currentPage'] = $page;

        return view('productos/index', $data);
    }

    public function create()
    {
        return view('productos/create');
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

        return redirect()->to('/producto')->with('mensaje', 'Producto agregado correctamente.');
    }

    public function edit($id)
    {
        $productoModel = new ProductoModel();
        $data['producto'] = $productoModel->find($id);

        if (!$data['producto']) {
            return redirect()->to('/producto')->with('error', 'Producto no encontrado.');
        }

        return view('productos/edit', $data);
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

        if (!$productoModel->find($id)) {
            return redirect()->to('/producto')->with('error', 'Producto no encontrado.');
        }

        // Actualizar producto
        $productoModel->update($id, $data);

        return redirect()->to('/producto')->with('mensaje', 'Producto actualizado correctamente.');
    }

    public function delete($id)
    {
        $productoModel = new ProductoModel();

        if (!$productoModel->find($id)) {
            return redirect()->to('/producto')->with('error', 'El producto no existe.');
        }

        $productoModel->delete($id);
        return redirect()->to('/producto')->with('mensaje', 'Producto eliminado correctamente.');
    }
}
