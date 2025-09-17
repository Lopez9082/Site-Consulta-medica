<?php
// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Receber os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];

    // Validar se o arquivo foi enviado
    if (isset($_FILES['documentos']) && $_FILES['documentos']['error'] == 0) {
        $documento = $_FILES['documentos'];

        // Definir o diretório de upload
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($documento['name']);

        // Mover o arquivo para o diretório de upload
        if (move_uploaded_file($documento['tmp_name'], $uploadFile)) {
            echo "Documento enviado com sucesso!";
        } else {
            echo "Erro ao enviar o documento.";
        }
    }

    // Conectar ao banco de dados
    $host = 'localhost';
    $usuario = 'root';
    $senha = '';
    $banco = 'consultas';

    $conn = new mysqli($host, $usuario, $senha, $banco);

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    // Inserir os dados no banco de dados
    $sql = "INSERT INTO agendamentos (nome, email, telefone, cpf, data, hora, documento)
            VALUES ('$nome', '$email', '$telefone', '$cpf', '$data', '$hora', '$uploadFile')";

    if ($conn->query($sql) === TRUE) {
        echo "Agendamento realizado com sucesso!";
    } else {
        echo "Erro ao agendar consulta: " . $conn->error;
    }

    $conn->close();
}
?>