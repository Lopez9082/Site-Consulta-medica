<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paciente extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Paciente_model');
        $this->load->model('Consulta_model');
        $this->load->library('session');

        // Verifica se o paciente está logado
        if (!$this->session->userdata('usuario') || $this->session->userdata('tipo_usuario') != 'paciente') {
            redirect('login');
        }
    }

    public function index() {
        $paciente = $this->session->userdata('usuario');

        // Pega as consultas futuras e passadas
        $consultas_futuras = $this->Consulta_model->get_consultas_futuras($paciente->Id);
        $consultas_passadas = $this->Consulta_model->get_consultas_passadas($paciente->Id);

        $dados = [
            'paciente' => $paciente,
            'consultas_futuras' => $consultas_futuras,
            'consultas_passadas' => $consultas_passadas
        ];

        $this->load->view('dashboard_paciente', $dados);
    }

    public function perfil()
    {
        $dados['conteudo'] = 'pacientes/perfil';
        $dados['paciente'] = $this->session->userdata('usuario');
        $this->load->view('dashboard_paciente', $dados);
    }

    public function atualizar_perfil()
{
    $usuario = $this->session->userdata('usuario');
    $id = $usuario->Id; // Ajuste conforme o nome do campo da tabela pacientes

    $email = $this->input->post('Email_Pac');
    $senha = $this->input->post('Senha_Pac');

    $dados = ['Email_Pac' => $email];

    if (!empty($senha)) {
        $dados['Senha_Pac'] = $senha;
    }

    $this->db->where('Id', $id);
    $this->db->update('pacientes', $dados);

    // Atualiza sessão
    $usuario->Email_Pac = $email;
    $this->session->set_userdata('usuario', $usuario);

    $this->session->set_flashdata('sucesso', 'Perfil atualizado com sucesso!');
    redirect('pacientes/perfil');
}

public function consultas()
{
    $this->load->model('Consulta_model');
    $usuario = $this->session->userdata('usuario');
    $id_paciente = $usuario->Id_Pac ?? $usuario->Id ?? null;

    if (!$id_paciente) {
        show_error("ID do paciente não encontrado na sessão.", 500);
        return;
    }

    $todas_consultas = $this->Consulta_model->get_consultas_paciente($id_paciente);

    $consultas_passadas = [];
    $consultas_futuras = [];

    $hoje = date('Y-m-d');
    foreach ($todas_consultas as $c) {
        if ($c->Data_Consulta < $hoje) {
            $consultas_passadas[] = $c;
        } else {
            $consultas_futuras[] = $c;
        }
    }

    $dados = [
        'conteudo' => 'pacientes/consultas',
        'consultas_passadas' => $consultas_passadas,
        'consultas_futuras' => $consultas_futuras
    ];

    $this->load->view('dashboard_paciente', $dados);
}

}
