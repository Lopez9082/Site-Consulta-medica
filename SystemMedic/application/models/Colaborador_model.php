<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Colaborador_model extends CI_Model {

    protected $table = 'colaboradores';

    public function __construct() {
        parent::__construct();
    }

    public function listar() {
        return $this->db->get($this->table)->result();
    }

    public function inserir($dados) {
        return $this->db->insert($this->table, $dados);
    }

    public function get_by_id($id)
{
    return $this->db->get_where('colaboradores', ['Id' => $id])->row();
}

public function get_all()
    {
        return $this->db->get('colaboradores')->result();
    }

    public function update_colaborador($id, $dados)
{
    $this->db->where('Id', $id);
    return $this->db->update('colaboradores', $dados);
}

}
