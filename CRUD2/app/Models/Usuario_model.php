<?php
class Usuario_model extends CI_Model
{
    public function obtener_usuarios()
    {
        return $this->db->get('usuarios')->result_array();
    }

    public function obtener_usuario($id)
    {
        return $this->db->get_where('usuarios', array('id' => $id))->row_array();
    }

    public function agregar_usuario($data)
    {
        return $this->db->insert('usuarios', $data);
    }

    public function actualizar_usuario($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('usuarios', $data);
    }

    public function eliminar_usuario($id)
    {
        return $this->db->delete('usuarios', array('id' => $id));
    }
}
