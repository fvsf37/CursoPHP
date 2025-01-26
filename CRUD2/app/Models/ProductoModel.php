<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model
{
    protected $table = 'productos_alimentacion'; // Nombre de la tabla
    protected $primaryKey = 'id'; // Clave primaria

    // Campos permitidos para operaciones de inserción y actualización
    protected $allowedFields = [
        'nombre',
        'descripcion',
        'categoria',
        'precio',
        'stock',
        'id_productor'
    ];

    // Habilitar timestamps automáticos (si usas fecha_creacion y fecha_actualizacion)
    public $useTimestamps = false; // Cambia a true si necesitas manejar estos campos
    protected $createdField = 'fecha_creacion'; // Nombre de la columna de creación (si aplicable)
    protected $updatedField = 'fecha_actualizacion'; // Nombre de la columna de actualización (si aplicable)

    // Validación opcional (reglas para validar datos antes de guardarlos)
    protected $validationRules = [
        'nombre' => 'required|max_length[255]',
        'descripcion' => 'max_length[1000]',
        'categoria' => 'required|max_length[100]',
        'precio' => 'required|decimal',
        'stock' => 'required|integer',
        'id_productor' => 'integer|permit_empty'
    ];
    protected $validationMessages = [
        'nombre' => [
            'required' => 'El campo Nombre es obligatorio.',
            'max_length' => 'El Nombre no puede superar los 255 caracteres.',
        ],
        'categoria' => [
            'required' => 'El campo Categoría es obligatorio.',
            'max_length' => 'La Categoría no puede superar los 100 caracteres.',
        ],
        'precio' => [
            'required' => 'El campo Precio es obligatorio.',
            'decimal' => 'El Precio debe ser un valor decimal válido.',
        ],
        'stock' => [
            'required' => 'El campo Stock es obligatorio.',
            'integer' => 'El Stock debe ser un número entero.',
        ],
    ];
    protected $skipValidation = false;

    // Función personalizada para buscar productos con filtros
    public function buscarProductos($search = null, $perPage = 10)
    {
        if ($search) {
            $this->like('nombre', $search)
                ->orLike('descripcion', $search)
                ->orLike('categoria', $search);
        }

        return $this->paginate($perPage, 'productos'); // Devuelve los productos paginados
    }
}
