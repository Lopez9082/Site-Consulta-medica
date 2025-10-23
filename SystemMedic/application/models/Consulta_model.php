<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consulta_model extends CI_Model {

    protected $table = 'consultas'; // substitua pelo nome real da tabela

    public function __construct() {
        parent::__construct();

    }

    // Lista todos os médicos
    public function listar_medicos() {
        return $this->db->get('medicos')->result();
    }

    // Retorna a agenda de um médico
    public function agenda_medico($id_medico) {
        $this->db->select('consultas.*, pacientes.Nome_Pac');
        $this->db->from('consultas');
        $this->db->join('pacientes', 'pacientes.Id = consultas.Id_Paciente', 'left');
        $this->db->where('consultas.Id_Medico', $id_medico);
        $this->db->order_by('consultas.Data_Consulta', 'ASC');
        $this->db->order_by('consultas.Horario', 'ASC');
        return $this->db->get()->result();
    }

    // Agenda uma nova consulta
    public function agendar($dados) {
        return $this->db->insert('consultas', $dados);
    }

    public function get_agenda_medico($id_medico)
{
    $this->db->select('consultas.*, pacientes.Nome_Pac');
    $this->db->from('consultas');
    $this->db->join('pacientes', 'pacientes.Id = consultas.Id_Paciente', 'left');
    $this->db->where('consultas.Id_Medico', $id_medico);
    $this->db->order_by('consultas.Data_Consulta', 'ASC');
    return $this->db->get()->result();
}

public function get_consultas_paciente($id_paciente)
{
    $this->db->select('
        consultas.Id,
        consultas.Data_Consulta,
        medicos.Id,
        medicos.Especialidade,
        consultas.Horario,
        medicos.Nome_Med
    ');
    $this->db->from('consultas');
    $this->db->join('medicos', 'medicos.Id = consultas.Id_Medico', 'left');
    $this->db->where('consultas.Id_Paciente', $id_paciente);
    $this->db->order_by('consultas.Data_Consulta', 'DESC');

    return $this->db->get()->result();
}



}
