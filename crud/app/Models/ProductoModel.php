<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['codigo', 'descripcion', 'precioVenta', 'precioCompra', 'existencias'];

    /**
     * Obtiene productos con paginación, búsqueda y ordenación.
     *
     * @param int $limit Cantidad de productos por página.
     * @param int $offset Offset para la paginación.
     * @param string|null $search Término de búsqueda.
     * @param string $orderBy Campo por el cual ordenar.
     * @param string $orderDirection Dirección de orden (ASC/DESC).
     * @return array Lista de productos.
     */
    public function getPaginatedProducts($limit, $offset, $search = null, $orderBy = 'id', $orderDirection = 'ASC')
    {
        // Validar que el campo de ordenación sea seguro
        $validColumns = ['id', 'codigo', 'descripcion', 'precioVenta', 'precioCompra', 'existencias'];
        if (!in_array($orderBy, $validColumns)) {
            $orderBy = 'id';
        }

        // Validar dirección de ordenación
        $orderDirection = strtoupper($orderDirection) === 'DESC' ? 'DESC' : 'ASC';

        $query = $this->orderBy($orderBy, $orderDirection);

        if ($search) {
            $query->groupStart()
                ->like('codigo', $search)
                ->orLike('descripcion', $search)
                ->orLike('precioVenta', $search)
                ->orLike('precioCompra', $search)
                ->orLike('existencias', $search)
                ->groupEnd();
        }

        return $query->findAll($limit, $offset);
    }

    /**
     * Obtiene el total de productos considerando la búsqueda.
     *
     * @param string|null $search Término de búsqueda.
     * @return int Número total de productos encontrados.
     */
    public function getTotalProducts($search = null)
    {
        if ($search) {
            return $this->groupStart()
                ->like('codigo', $search)
                ->orLike('descripcion', $search)
                ->orLike('precioVenta', $search)
                ->orLike('precioCompra', $search)
                ->orLike('existencias', $search)
                ->groupEnd()
                ->countAllResults();
        }

        return $this->countAllResults();
    }
}
