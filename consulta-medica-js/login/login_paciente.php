<?php
// Conexão com o banco de dados
$host = 'localhost'; // Endereço do servidor
$usuario = 'root';   // Seu usuário do MySQL
$senha = '';         // Sua senha do MySQL
$banco = 'login';    // Nome do banco de dados

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Verificar se as credenciais existem no banco de dados
    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";
    $result = $conn->query($sql);

    // Se encontrar uma correspondência
    if ($result->num_rows > 0) {
        echo "Login bem-sucedido!"; 
       header('location: index.html'); 

    } else {
        echo "Credenciais inválidas!";
    }
}

$conn->close();
?>