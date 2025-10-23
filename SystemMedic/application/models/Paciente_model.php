<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paciente_model extends CI_Model {

        protected $table = 'pacientes';

    public function __construct() {
        parent::__construct();
    }

    public function autenticar($email, $senha) {
        $this->db->where('Email_Pac', $email);
        $this->db->where('Senha_Pac', $senha); // DICA: use hash depois
        $query = $this->db->get('pacientes');

        if ($query->num_rows() === 1) {
            return $query->row(); // retorna o paciente autenticado
        } else {
            return false;
        }
    }

    public function inserir($dados)
    {
        return $this->db->insert($this->table, $dados);
    }

    public function listar()
    {
        return $this->db->get($this->table)->result();
    }

    public function get_all()
    {
        return $this->db->get('pacientes')->result();
    }

    public function get_by_id($id) 
    {
        return $this->db->get_where($this->table, ['Id' => $id])->row();
    }

    public function update($id, $dados)
{
    $this->db->where('Id', $id);
    return $this->db->update('pacientes', $dados);
}

}
