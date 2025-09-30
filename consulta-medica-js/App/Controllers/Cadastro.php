<?php

namespace App\Controllers;

use App\Models\Paciente_model;

class Cadastro extends BaseController
{
    public function salvar()
    {
        helper(['form']);

        $usuarioModel = new Paciente_model();

        $data = [
            'email'           => $this->request->getPost('email'),
            'senha'           => password_hash($this->request->getPost('senha'), PASSWORD_DEFAULT),
            'nome'            => $this->request->getPost('nome'),
            'data_nascimento' => $this->request->getPost('Data_Nas'),
        ];

        $usuarioModel->insert($data);

        return redirect()->to('/')->with('msg', 'Usuário cadastrado com sucesso!');
    }
}
