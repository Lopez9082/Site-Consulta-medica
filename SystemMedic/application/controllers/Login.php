<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
    parent::__construct();
    $this->load->model('Paciente_model');
    $this->load->model('Login_model');
    $this->load->library('session');
    $this->load->helper('url'); // ← ISSO É ESSENCIAL!
}


    public function index() {
        $this->load->view('login_view');
    }

public function autenticar() {
    $email = $this->input->post('email');
    $senha = $this->input->post('senha');

    // Paciente
    $paciente = $this->Login_model->autenticar_paciente($email, $senha);
    if ($paciente) {
        $this->session->set_userdata([
            'usuario' => $paciente,
            'tipo_usuario' => 'paciente'
        ]);
        redirect('login/dashboard');
        return;
    }

    // Balcão
    $balcao = $this->Login_model->autenticar_balcao($email, $senha);
    if ($balcao) {
        $this->session->set_userdata([
            'usuario' => $balcao,
            'tipo_usuario' => 'balcao'
        ]);
        redirect('login/dashboard');
        return;
    }

    // Médico 👇
    $medico = $this->Login_model->autenticar_medico($email, $senha);
    if ($medico) {
        $this->session->set_userdata([
            'usuario' => $medico,
            'tipo_usuario' => 'medico'
        ]);
        redirect('medico');;
        return;
    }

    // Nenhum encontrado
    $data['erro'] = "Email ou senha inválidos.";
    $this->load->view('login_view', $data);
}



    public function dashboard() {
    if (!$this->session->userdata('usuario')) {
        redirect('login');
    }

    $tipo = $this->session->userdata('tipo_usuario');

    switch ($tipo) {
        case 'paciente':
            $this->load->view('dashboard_paciente');
            break;
        case 'balcao':
            $this->load->view('dashboard_balcao');
            break;
        case 'medico':
            $this->load->view('dashboard_medico');
            break;
        default:
            redirect('login');
    }
}


    public function sair() {
        $this->session->unset_userdata('paciente');
        redirect('login');
    }
}
