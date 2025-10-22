<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paciente_model extends CI_Model {

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
}
