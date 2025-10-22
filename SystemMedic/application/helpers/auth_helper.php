<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function verificar_login() {
    $CI =& get_instance(); // Pega a instância do CodeIgniter
    if (!$CI->session->userdata('paciente')) {
        redirect('login');
    }
}
