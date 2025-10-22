<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel do Balcão</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <style>
        body {
            display: flex;
            height: 100vh;
            margin: 0;
            background-color: #f4f6f8;
        }
        .sidebar {
            width: 220px;
            background: #2c3e50;
            color: #ecf0f1;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        .sidebar h2 {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #34495e;
            margin: 0;
        }
        .sidebar a {
            color: #ecf0f1;
            padding: 15px;
            text-decoration: none;
            display: block;
            border-bottom: 1px solid #34495e;
            transition: background 0.3s;
        }
        .sidebar a:hover {
            background: #34495e;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Balcão</h2>
        <a href="<?= site_url('balcao/pacientes') ?>">Cadastro de Pacientes</a>
        <a href="<?= site_url('balcao/medicos') ?>">Cadastro de Médicos</a>
        <a href="<?= site_url('balcao/consultas') ?>">Consultas</a>
        <a href="<?= site_url('login/sair') ?>" style="color: #e74c3c;">Sair</a>
    </div>

    <div class="content">
        <h3>Bem-vindo ao Painel do Balcão</h3>
        <hr>
        <p>Escolha uma opção no menu lateral para começar.</p>
    </div>

</body>
</html>
