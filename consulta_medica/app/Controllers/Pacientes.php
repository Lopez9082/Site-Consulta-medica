<?php namespace App\Controllers;

use App\Models\PacienteModel;
use CodeIgniter\Controller;

class Pacientes extends Controller {

    public function cadastro() {
        // Exibe a view de cadastro
        return view('cadastro');
    }

    public function cadastrar() {
        // Aqui vamos receber o POST (ou JSON) e processar

        $request = $this->request;

        // Se vier JSON
        if ($request->getJSON()) {
            $dados = $request->getJSON(true);  // como array
        } else {
            $dados = $request->getPost();  // dados de formulário normal
        }

        // Carrega model
        $model = new PacienteModel();

        $mensagem = $model->cadastrarPaciente(
            $dados['email'] ?? '',
            $dados['senha'] ?? '',
            $dados['nome'] ?? '',
            $dados['Data_Nas'] ?? '',
            $dados['CPF'] ?? '',
            $dados['telefone'] ?? '',
            $dados['cep'] ?? '',
            $dados['endereco'] ?? '',
            $dados['estado'] ?? '',
            $dados['complemento'] ?? '',
            $dados['cidade'] ?? '',
            'Brasil'
        );

        // Retornar JSON de resposta
        return $this->response->setJSON([
            'sucesso' => strpos($mensagem, 'sucesso') !== false,
            'mensagem' => $mensagem
        ]);
    }
}
