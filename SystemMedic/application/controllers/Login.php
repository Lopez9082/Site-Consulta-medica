<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
    parent::__construct();
    $this->load->model('Paciente_model');
    $this->load->library('session');
    $this->load->helper('url'); // ← ISSO É ESSENCIAL!
}


    public function index() {
        $this->load->view('login_view');
    }

    public function autenticar() {
        $email = $this->input->post('email');
        $senha = $this->input->post('senha');

        $paciente = $this->Paciente_model->autenticar($email, $senha);

        if ($paciente) {
            $this->session->set_userdata('paciente', $paciente);
            redirect('login/dashboard');
        } else {
            $data['erro'] = "Email ou senha inválidos.";
            $this->load->view('login_view', $data);
        }
    }

    public function dashboard() {
        if (!$this->session->userdata('paciente')) {
            redirect('login');
        }

        $this->load->view('dashboard_view');
    }

    public function sair() {
        $this->session->unset_userdata('paciente');
        redirect('login');
    }
}
