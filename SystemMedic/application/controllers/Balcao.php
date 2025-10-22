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
    }

    public function index()
    {
        $this->load->view('dashboard_balcao');
    }

    public function pacientes()
    {
        $this->load->view('balcao/pacientes');
    }

    public function medicos()
    {
        $this->load->view('balcao/medicos');
    }

    public function consultas()
    {
        $this->load->view('balcao/consultas');
    }
}
