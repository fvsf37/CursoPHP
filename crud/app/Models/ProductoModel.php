<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['codigo', 'descripcion', 'precioVenta', 'precioCompra', 'existencias'];

    public function getPaginatedProducts($limit, $offset)
    {
        return $this->orderBy('id', 'DESC')->findAll($limit, $offset);
    }
}
