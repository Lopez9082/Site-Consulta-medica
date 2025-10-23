<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medico_model extends CI_Model {

    protected $table = 'medicos';

    public function __construct() {
        parent::__construct();
    }

    public function listar() {
        return $this->db->get($this->table)->result();
    }

    public function inserir($dados) {
        return $this->db->insert($this->table, $dados);
    }
    
    public function buscar($id) {
        return $this->db->get_where('medicos', ['Id' => $id])->row();
    }

    public function get_by_id($id)
{
    return $this->db->get_where('medicos', ['Id' => $id])->row();
}

public function update_medico($id, $dados)
{
    $this->db->where('Id', $id);
    return $this->db->update('medicos', $dados);
}


}
