<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['codigo', 'descripcion', 'precioVenta', 'precioCompra', 'existencias'];

    public function getPaginatedProducts($limit, $offset, $search = null)
    {
        $query = $this->orderBy('id', 'ASC');

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
