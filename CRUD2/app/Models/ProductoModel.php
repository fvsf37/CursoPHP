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

    // Validación opcional (agrega reglas si deseas validar datos antes de insertarlos)
    protected $validationRules = [
        'nombre' => 'required|max_length[255]',
        'descripcion' => 'max_length[1000]',
        'categoria' => 'required|max_length[100]',
        'precio' => 'required|decimal',
        'stock' => 'required|integer',
        'id_productor' => 'integer|permit_empty'
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;
}
