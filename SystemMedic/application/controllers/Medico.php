<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medico extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('Paciente_model');

        if (!$this->session->userdata('usuario') || $this->session->userdata('tipo_usuario') != 'medico') {
            redirect('login');
        }
    }

    public function index() {
        $data['conteudo'] = null;
        $this->load->view('dashboard_medico', $data);
    }

    public function perfil() {
        $data['conteudo'] = 'medico/perfil';
        $this->load->view('dashboard_medico', $data);
    }

    public function pacientes() {
        $id_medico = $this->session->userdata('usuario')->Id;

        $mes = $this->input->get('mes') ?? date('m');
        $ano = $this->input->get('ano') ?? date('Y');
        $dia = $this->input->get('dia') ?? date('Y-m-d');

        // pacientes do dia selecionado
        $this->db->select('pacientes.*, consultas.Horario');
        $this->db->from('consultas');
        $this->db->join('pacientes', 'pacientes.Id = consultas.Id_Paciente');
        $this->db->where('consultas.Id_Medico', $id_medico);
        $this->db->where('consultas.Data_Consulta', $dia);
        $pacientes = $this->db->get()->result();

        // dias do mês
        $total_dias = date('t', strtotime("$ano-$mes-01"));
        $dias_mes = [];
        for ($i = 1; $i <= $total_dias; $i++) {
            $dias_mes[] = "$ano-$mes-" . str_pad($i, 2, '0', STR_PAD_LEFT);
        }

        $meses = [];
        for ($m = 1; $m <= 12; $m++) {
            $meses[$m] = date('F', mktime(0,0,0,$m,1));
        }
        $anos = range(2000, 2030);

        $data = [
            'pacientes' => $pacientes,
            'dias_mes' => $dias_mes,
            'dia_selecionado' => $dia,
            'mes' => $mes,
            'ano' => $ano,
            'meses' => $meses,
            'anos' => $anos,
            'conteudo' => 'medico/pacientes'
        ];

        $this->load->view('dashboard_medico', $data);
    }

    public function salvar_perfil() {
        $id = $this->session->userdata('usuario')->Id;
        $dias = $this->input->post('Dias_Semana');
        $dados = [
            'Dias_Semana' => implode(',', $this->input->post('Dias_Semana')),
            'Hora_Inicio' => $this->input->post('Hora_Inicio'),
            'Hora_Fim' => $this->input->post('Hora_Fim'),
            'Duracao_Consulta' => $this->input->post('Duracao_Consulta'),
        ];

        $this->db->where('Id', $this->session->userdata('usuario')->Id);
        $this->db->update('medicos', $dados);

        // Atualiza a sessão do médico logado
        $usuario = $this->db->get_where('medicos', ['Id' => $this->session->userdata('usuario')->Id])->row();
        $this->session->set_userdata('usuario', $usuario);

        $this->session->set_flashdata('msg', 'Agenda atualizada com sucesso!');
        redirect('medico/perfil');
        }


    public function ficha_paciente($id_paciente)
{
    $this->load->model('Paciente_model');
    $this->load->model('Consulta_model');

    $paciente = $this->Paciente_model->get_by_id($id_paciente);
    if (!$paciente) {
        show_404();
    }

    $consultas = $this->Consulta_model->get_consultas_paciente($id_paciente);

    $data = [
        'paciente' => $paciente,
        'consultas' => $consultas
    ];

    $data['conteudo'] = 'medico/ficha_paciente';
    $this->load->view('dashboard_medico', $data);
}



}
