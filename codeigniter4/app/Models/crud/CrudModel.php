<?php namespace App\Models\crud;

use CodeIgniter\Model;

class CrudModel extends Model
{

    /**
     * Obtiene todos los registros según la página y registros por página pasados
     */
    public function getAll()
    {
        $sql = "SELECT * FROM productos";

        return $this->db->query($sql);
    }
}