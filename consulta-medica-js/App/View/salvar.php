<?php
// Inclui conexão com banco
require_once 'conexao.php';

// Pega os dados do formulário
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$nome = $_POST['root'] ?? '';
$data_nascimento = $_POST['Data_Nas'] ?? '';

// Validação simples
if (strlen($senha) < 10) {
    die("A senha deve ter no mínimo 10 caracteres.");
}

// Criptografa a senha
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

// Prepara e executa a inserção
$sql = "INSERT INTO usuarios (email, senha, nome, data_nascimento) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $email, $senha_hash, $nome, $data_nascimento);

if ($stmt->execute()) {
    echo "Cadastro realizado com sucesso!";
} else {
    echo "Erro ao cadastrar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
