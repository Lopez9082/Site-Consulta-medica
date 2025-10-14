<?php
require_once __DIR__ . '/../conexao.php';

class PacienteModel {
    private $conn;

    public function __construct() {
        $this->conn = conectar(); // função em conexao.php
    }

    public function cadastrarPaciente($email, $senha, $nome, $data_nas, $cpf, $telefone, $cep, $endereco, $estado, $complemento, $cidade, $pais) {
        if (strlen($senha) < 10) {
            return "A senha deve ter no mínimo 10 caracteres.";
        }

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO pacientes (Email_Pac, Senha_Pac, Nome_Pac, Data_Nas, CPF, Telefone, CEP, Endereco, Estado, Complemento, Cidade, Pais)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssssssss", $email, $senha_hash, $nome, $data_nas, $cpf, $telefone, $cep, $endereco, $estado, $complemento, $cidade, $pais);

        if ($stmt->execute()) {
            return "Cadastro realizado com sucesso!";
        } else {
            return "Erro ao cadastrar: " . $stmt->error;
        }
    }

    public function listarPacientes() {
        $sql = "SELECT * FROM pacientes";
        $res = $this->conn->query($sql);
        return $res->fetch_all(MYSQLI_ASSOC);
    }
}
