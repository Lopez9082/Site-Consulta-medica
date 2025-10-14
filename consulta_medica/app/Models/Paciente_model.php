<?php namespace App\Models;

use CodeIgniter\Model;

class PacienteModel extends Model {
    protected $table = 'pacientes';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'Email_Pac', 'Senha_Pac', 'Nome_Pac', 'Data_Nas',
        'CPF', 'Telefone', 'CEP', 'Endereco',
        'Estado', 'Complemento', 'Cidade', 'Pais'
    ];

    public function cadastrarPaciente($email, $senha, $nome, $data_nas, $cpf, $telefone, $cep, $endereco, $estado, $complemento, $cidade, $pais) {
        if (strlen($senha) < 10) {
            return "A senha deve ter no mínimo 10 caracteres.";
        }

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $data = [
            'Email_Pac' => $email,
            'Senha_Pac' => $senha_hash,
            'Nome_Pac' => $nome,
            'Data_Nas' => $data_nas,
            'CPF' => $cpf,
            'Telefone' => $telefone,
            'CEP' => $cep,
            'Endereco' => $endereco,
            'Estado' => $estado,
            'Complemento' => $complemento,
            'Cidade' => $cidade,
            'Pais' => $pais
        ];

        if ($this->insert($data)) {
            return "Cadastro realizado com sucesso!";
        } else {
            $error = $this->errors();  // pega erros do Model, se houver
            return "Erro ao cadastrar: " . implode(", ", $error);
        }
    }

    public function listarPacientes() {
        return $this->findAll();
    }
}
