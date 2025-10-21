<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arquivo extends CI_Controller {
    public function index()
    {
        $data['titulo'] = 'Página Arquivo';
        $this->load->view('arquivo_view', $data);
    }

    public function outro()
    {
        echo "Método outro() acessado";
    }
}
