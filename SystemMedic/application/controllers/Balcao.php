<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Balcao extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // Garante que só usuários do tipo "balcao" possam acessar
        if (!$this->session->userdata('usuario') || $this->session->userdata('tipo_usuario') != 'balcao') {
            redirect('login');
        }

        $this->load->model('Paciente_model');
        $this->load->model('Medico_model');
        $this->load->model('Colaborador_model');
        $this->load->model('Consulta_model');
        $this->load->library('form_validation');
    }

    // Dashboard do balcão
    public function index()
    {
        $this->load->view('dashboard_balcao');
    }

    // ---------- PACIENTES ----------
    public function pacientes()
    {
        $data['conteudo'] = 'balcao/pacientes';
        $data['pacientes'] = $this->Paciente_model->listar();
        $this->load->view('dashboard_balcao', $data);
    }

    public function salvar_paciente()
    {
        $this->form_validation->set_rules('Nome_Pac', 'Nome', 'required');
        $this->form_validation->set_rules('Email_Pac', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('Senha_Pac', 'Senha', 'required');
        $this->form_validation->set_rules('Cpf_cnpj', 'CPF/CNPJ', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['pacientes'] = $this->Paciente_model->listar();
            $data['conteudo'] = 'balcao/pacientes';
            $this->load->view('dashboard_balcao', $data);
        } else {
            $dados = [
                'Nome_Pac'      => $this->input->post('Nome_Pac'),
                'Data_Nas'      => $this->input->post('Data_Nas'),
                'Cpf_cnpj'      => $this->input->post('Cpf_cnpj'),
                'Sexo'          => $this->input->post('Sexo'),
                'Email_Pac'     => $this->input->post('Email_Pac'),
                'Senha_Pac'     => password_hash($this->input->post('Senha_Pac'), PASSWORD_DEFAULT),
                'Telefone'      => $this->input->post('Telefone'),
                'Celular'       => $this->input->post('Celular'),
                'Endereço_Pac'  => $this->input->post('Endereço_Pac'),
                'CEP'           => $this->input->post('CEP'),
                'Municipio'     => $this->input->post('Municipio'),
                'UF'            => $this->input->post('UF'),
            ];

            $this->Paciente_model->inserir($dados);
            $this->session->set_flashdata('sucesso', 'Paciente cadastrado com sucesso!');
            redirect('balcao/pacientes');
        }
    }

    // ---------- MÉDICOS ----------
    public function medicos()
    {
        $data['conteudo'] = 'balcao/medicos';
        $data['medicos'] = $this->Medico_model->listar();
        $this->load->view('dashboard_balcao', $data);
    }

    public function salvar_medico()
    {
        $dados = [
            'Nome_Med'      => $this->input->post('Nome_Med'),
            'CRM'           => $this->input->post('CRM'),
            'Especialidade' => $this->input->post('Especialidade'),
            'Email_Med'     => $this->input->post('Email_Med'),
            'Senha_Med'     => password_hash($this->input->post('Senha_Med'), PASSWORD_DEFAULT),
            'Telefone'      => $this->input->post('Telefone'),
            'Celular'       => $this->input->post('Celular'),
            'Endereco_Med'  => $this->input->post('Endereco_Med'),
            'CEP'           => $this->input->post('CEP'),
            'Municipio'     => $this->input->post('Municipio'),
            'UF'            => $this->input->post('UF')
        ];

        if ($this->Medico_model->inserir($dados)) {
            $this->session->set_flashdata('sucesso', 'Médico cadastrado com sucesso!');
        } else {
            $db_error = $this->db->error();
            $this->session->set_flashdata('erro', 'Erro ao cadastrar médico: ' . $db_error['message']);
        }

        redirect('balcao/medicos');
    }

    // ---------- COLABORADORES ----------


    // Perfil do colaborador
    public function perfil_colaborador($id) {
        // Busca o colaborador pelo ID
        $data['colaborador'] = $this->Colaborador_model->get_by_id($id);
        
        // Se não encontrou, mostra 404
        if (!$data['colaborador']) {
            show_404();
        }

        $data['conteudo'] = 'balcao/perfil_colaborador';
        $this->load->view('dashboard_balcao', $data);
    }

    // Salvar edição do colaborador
    public function salvar_edicao_colaborador($id) {
        $dados = $this->input->post();

        // Atualiza os dados no banco
        $this->Colaborador_model->update_colaborador($id, $dados);

        // Redireciona para lista de colaboradores
        redirect('balcao/colaboradores');
    }

    // Lista de colaboradores
    public function colaboradores() {
        $data['colaboradores'] = $this->Colaborador_model->get_all();
        $data['conteudo'] = 'balcao/colaboradores';
        $this->load->view('dashboard_balcao', $data);
    }

    public function cadastrar_colaborador() {
        $data['colaboradores'] = $this->Colaborador_model->get_all();
        $data['conteudo'] = 'cadastro/cadastrar_colaborador';
        $this->load->view('dashboard_balcao', $data);
    }


    

    // ---------- CONSULTAS ----------
    // Exibe a lista de médicos para escolher
public function consultas() {
    $this->load->model('Consulta_model');
    $data['medicos'] = $this->Consulta_model->listar_medicos();
    $data['conteudo'] = 'balcao/consultas';
    $this->load->view('dashboard_balcao', $data);
}

    // Mostra agenda e formulário de agendamento
    public function agenda_medico($id_medico = null)
{
    $this->load->model('Medico_model');
    $this->load->model('Paciente_model');
    $this->load->model('Consulta_model');

    $medico = $this->Medico_model->buscar($id_medico);
    if (!$medico) {
        show_404();
    }

    $pacientes = $this->Paciente_model->get_all();

    // 1️⃣ Gera horários do dia com base em Hora_Inicio e Hora_Fim
    $horarios_disponiveis = [];
    if (!empty($medico->Hora_Inicio) && !empty($medico->Hora_Fim)) {
        $horaAtual = strtotime($medico->Hora_Inicio);
        $horaFim = strtotime($medico->Hora_Fim);
        $duracao = $medico->Duracao_Consulta ?? 15;

        while ($horaAtual < $horaFim) {
            $horarios_disponiveis[] = date('H:i', $horaAtual);
            $horaAtual = strtotime("+{$duracao} minutes", $horaAtual);
        }
    }

    // 2️⃣ Gera dias do mês que o médico trabalha
    $dias_trabalho = explode(',', $medico->Dias_Semana ?? '');
    $mes = date('m');
    $ano = date('Y');
    $total_dias = date('t', strtotime("$ano-$mes-01"));
    $dias_semana_port = [
        'Monday' => 'Segunda',
        'Tuesday' => 'Terça',
        'Wednesday' => 'Quarta',
        'Thursday' => 'Quinta',
        'Friday' => 'Sexta',
        'Saturday' => 'Sábado',
        'Sunday' => 'Domingo'
    ];

    $dias_mes = [];
    for ($i = 1; $i <= $total_dias; $i++) {
        $data = "$ano-$mes-" . str_pad($i, 2, '0', STR_PAD_LEFT);
        $dia_semana = date('l', strtotime($data));
        $dia_port = $dias_semana_port[$dia_semana] ?? '';
        if (in_array($dia_port, $dias_trabalho)) {
            $dias_mes[] = [
                'data' => $data,
                'dia_semana' => $dia_port
            ];
        }
    }

    // 3️⃣ Consultas já agendadas
    $consultas = $this->Consulta_model->get_agenda_medico($id_medico);

    // 4️⃣ Monta horários disponíveis por dia
    $horarios_por_dia = [];
    foreach ($dias_mes as $dia) {
        $diaData = $dia['data'];
        $ocupados = [];
        foreach ($consultas as $c) {
            if ($c->Data_Consulta == $diaData && !empty($c->Horario)) {
                $ocupados[] = $c->Horario;
            }
        }
        $horarios_por_dia[$diaData] = array_values(array_diff($horarios_disponiveis, $ocupados));
    }

    // 5️⃣ Passa para a view
    $data_view = [
        'medico' => $medico,
        'pacientes' => $pacientes,
        'dias_mes' => $dias_mes,
        'horarios_por_dia' => $horarios_por_dia,
        'agenda' => $consultas,
        'conteudo' => 'balcao/agenda_medico'
    ];

    $this->load->view('dashboard_balcao', $data_view);
}





// Salva uma nova consulta
public function agendar_consulta()
{
    $this->load->model('Consulta_model');

    $dados = [
        'Id_Medico' => $this->input->post('Id_Medico'),
        'Id_Paciente' => $this->input->post('Id_Paciente'),
        'Data_Consulta' => $this->input->post('Data_Consulta'),
        'Horario' => $this->input->post('Hora_Consulta') ?? null
    ];

    // Verifica se o médico trabalha nesse dia
    $medico = $this->db->get_where('medicos', ['Id' => $dados['Id_Medico']])->row();
    $dias_trabalho = explode(',', $medico->Dias_Semana);

    $dia_semana = date('l', strtotime($dados['Data_Consulta']));
    $dias_semana_port = [
        'Monday' => 'Segunda',
        'Tuesday' => 'Terça',
        'Wednesday' => 'Quarta',
        'Thursday' => 'Quinta',
        'Friday' => 'Sexta',
        'Saturday' => 'Sábado',
        'Sunday' => 'Domingo'
    ];
    $dia_port = $dias_semana_port[$dia_semana];

    if (!in_array($dia_port, $dias_trabalho)) {
        $this->session->set_flashdata('erro', 'O médico não trabalha neste dia!');
    } else {
        // Salva a consulta
        $this->Consulta_model->agendar($dados);
        $this->session->set_flashdata('sucesso', 'Consulta agendada com sucesso!');
    }

    // Recarrega a mesma tela passando novamente os dados do médico
    $this->agenda_medico($dados['Id_Medico']);
}

// Página de cadastro de paciente
public function cadastrar_paciente()
{
     $data['conteudo'] = 'cadastro/cadastrar_paciente';
    $this->load->view('dashboard_balcao', $data);
}

// Página de cadastro de médico
public function cadastrar_medico()
{
     $data['conteudo'] = 'cadastro/cadastrar_medico';
     $this->load->view('dashboard_balcao', $data);
}


// Salvar colaborador
public function salvar_colaborador()
{
    $this->load->model('Colaborador_model');
    $dados = $this->input->post();
    $this->Colaborador_model->insert($dados);
    redirect('balcao/lista_colaboradores');
}

public function perfil_medico($id)
{
    $this->load->model('Medico_model');

    $data['medico'] = $this->Medico_model->get_by_id($id);
    $data['conteudo'] = 'balcao/perfil_medico';

    if (!$data['medico']) {
        show_404();
    }

    $this->load->view('dashboard_balcao', $data);
}


public function salvar_edicao_medico($id)
{
    $this->load->model('Medico_model');

    $dados = $this->input->post();
    $this->Medico_model->update_medico($id, $dados);

    redirect('balcao/medicos');
}


public function perfil_paciente($id)
{
    $this->load->model('Paciente_model');
    $this->load->model('Consulta_model');

    $data['paciente'] = $this->Paciente_model->get_by_id($id);
    $data['consultas'] = $this->Consulta_model->get_consultas_paciente($id);

    $data['paciente'] = $this->Paciente_model->get_by_id($id);
    $data['conteudo'] = 'balcao/perfil_paciente';

    if (!$data['paciente']) {
        show_404();
    }

    $this->load->view('dashboard_balcao', $data);
}

public function editar_paciente($id)
{
    $this->load->model('Paciente_model');
    $data['paciente'] = $this->Paciente_model->get_by_id($id);

    $data['conteudo'] = 'balcao/editar_paciente';

    if (!$data['paciente']) {
        show_404();
    }

    $this->load->view('dashboard_balcao', $data);
   


}


public function editar($id)
{
    $this->load->model('Paciente_model');

    $dados = array(
        'Nome_Pac'      => $this->input->post('Nome_Pac'),
        'Data_Nas'      => $this->input->post('Data_Nas'),
        'Cpf_cnpj'      => $this->input->post('Cpf_cnpj'),
        'Telefone'      => $this->input->post('Telefone'),
        'Celular'       => $this->input->post('Celular'),
        'Email_Pac'     => $this->input->post('Email_Pac'),
        'Endereco_Pac'  => $this->input->post('Endereco_Pac'),
        'Municipio'     => $this->input->post('Municipio'),
        'UF'            => $this->input->post('UF')
    );

    $this->Paciente_model->update($id, $dados);
    redirect('balcao/perfil_paciente/' . $id);
}


}
