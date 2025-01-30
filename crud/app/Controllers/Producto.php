<?php

namespace App\Controllers;

use App\Models\ProductoModel;
use CodeIgniter\Controller;

class Producto extends Controller
{
    public function index()
    {
        $productoModel = new ProductoModel();

        // Obtener parámetros de búsqueda y ordenación
        $search = $this->request->getGet('search') ?? '';
        $perPage = $this->request->getGet('perPage') ?? 10; // Productos por página (por defecto 10)
        $page = $this->request->getGet('page') ?? 1; // Página actual
        $orderBy = $this->request->getGet('orderBy') ?? 'id'; // Campo de ordenación (por defecto 'id')
        $orderDirection = $this->request->getGet('orderDirection') ?? 'ASC'; // Dirección ASC/DESC

        // Convertir valores a enteros donde corresponda
        $perPage = (int) $perPage;
        $page = (int) $page;
        $offset = ($page - 1) * $perPage;

        // Obtener productos paginados con búsqueda y ordenación
        $data['productos'] = $productoModel->getPaginatedProducts($perPage, $offset, $search, $orderBy, $orderDirection);
        $data['total'] = $productoModel->getTotalProducts($search);
        $data['perPage'] = $perPage;
        $data['currentPage'] = $page;
        $data['search'] = $search;
        $data['orderBy'] = $orderBy;
        $data['orderDirection'] = $orderDirection;

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
