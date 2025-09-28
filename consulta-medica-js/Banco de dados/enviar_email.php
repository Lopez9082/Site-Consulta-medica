<?php
// Define que a resposta será em formato JSON
header('Content-Type: application/json');

// Recebe o JSON enviado pelo JavaScript
$json_data = file_get_contents('php://input');
$dados = json_decode($json_data, true);

// Verifica se os dados necessários estão presentes
if (empty($dados['email']) || empty($dados['especialidade']) || empty($dados['data'])) {
    echo json_encode(['success' => false, 'message' => 'Dados incompletos recebidos.']);
    exit;
}

// ----------------------------------------------------
// DADOS DO AGENDAMENTO
// ----------------------------------------------------
$nomeUsuario = htmlspecialchars($dados['nome']);
$emailUsuario = filter_var($dados['email'], FILTER_SANITIZE_EMAIL);
$especialidade = htmlspecialchars($dados['especialidade']);
$medico = htmlspecialchars($dados['medico']);
$data = htmlspecialchars($dados['data']);
$hora = htmlspecialchars($dados['hora']);

// ----------------------------------------------------
// PREPARAÇÃO DO EMAIL
// ----------------------------------------------------

$destinatario = $emailUsuario;
$assunto = "Confirmação de Agendamento - Consultório Tech";

// Conteúdo HTML do Email
$mensagem = "
<html>
<head>
    <title>Sua consulta está marcada!</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f6f9; color: #333; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        h2 { color: #4c51bf; border-bottom: 2px solid #4c51bf; padding-bottom: 10px; }
        .details p { margin: 10px 0; font-size: 16px; }
        .details strong { color: #4c51bf; display: inline-block; width: 100px; }
        .footer { margin-top: 20px; font-size: 12px; color: #777; text-align: center; }
    </style>
</head>
<body>
    <div class='container'>
        <h2>Olá, $nomeUsuario!</h2>
        <p>Seu agendamento na **Consultório Tech** foi confirmado com sucesso. Abaixo estão os detalhes da sua consulta:</p>
        
        <div class='details'>
            <p><strong>Especialidade:</strong> $especialidade</p>
            <p><strong>Médico:</strong> $medico</p>
            <p><strong>Data:</strong> $data</p>
            <p><strong>Hora:</strong> $hora</p>
        </div>
        
        <p>Chegue com 15 minutos de antecedência. Qualquer dúvida, entre em contato.</p>
        <p>Obrigado!</p>
    </div>
    <div class='footer'>
        Este é um email automático, por favor não responda.
    </div>
</body>
</html>
";

// Cabeçalhos para formatação HTML
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: <noreply@seu-dominio.com>" . "\r\n"; // Mude o domínio para um real ou use o seu local

// ----------------------------------------------------
// FUNÇÃO DE ENVIO
// ----------------------------------------------------

// Tenta enviar o e-mail
if (mail($destinatario, $assunto, $mensagem, $headers)) {
    echo json_encode(['success' => true, 'message' => 'Email enviado com sucesso.']);
} else {
    // Se a função mail() falhar, geralmente é uma configuração do servidor
    echo json_encode(['success' => false, 'message' => 'Falha ao enviar o email (configuração do servidor).']);
}

?>