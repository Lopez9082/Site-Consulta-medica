<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct(); // <-- importante!
    }

    public function autenticar_paciente($email, $senha) {
        $this->db->where('Email_Pac', $email);
        $this->db->where('Senha_Pac', $senha);
        $query = $this->db->get('pacientes');

        return $query->row(); // retorna objeto ou null
    }

    public function autenticar_balcao($nome, $senha) {
        $this->db->where('nome', $nome);
        $this->db->where('senha ', $senha); // campo com espaço!
        $query = $this->db->get('balcao');

        return $query->row();
    }

    public function autenticar_medico($nome, $senha) {
        $this->db->where('Email_Med', $nome);
        $this->db->where('Senha_Med ', $senha); // campo com espaço!
        $query = $this->db->get('medicos');

        return $query->row();
    }

    
}
