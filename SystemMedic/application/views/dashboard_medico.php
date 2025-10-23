<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Médico</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            display: flex;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .sidebar {
            width: 220px;
            background: #2c3e50;
            color: #fff;
            min-height: 100vh;
        }
        .sidebar h2 {
            text-align: center;
            padding: 20px 0;
            font-size: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            padding: 15px 20px;
        }
        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            display: block;
        }
        .sidebar ul li a:hover {
            background: #1abc9c;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
        .logout {
            position: absolute;
            bottom: 20px;
            width: 220px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Dr. <?= $this->session->userdata('usuario')->Nome_Med ?? '' ?></h2>
        <ul>
            <li><a href="<?= site_url('medico/perfil') ?>"><i class="fa fa-user"></i> Perfil</a></li>
            <li><a href="<?= site_url('medico/pacientes') ?>"><i class="fa fa-users"></i> Pacientes</a></li>
        </ul>
        <div class="logout">
            <a href="<?= site_url('login/sair') ?>" style="color:#fff; text-align:center; display:block;">Sair <i class="fa fa-sign-out-alt"></i></a>
        </div>
    </div>

    <div class="content">
        <?php
            // aqui vamos carregar dinamicamente a view da página central
            if (isset($conteudo)) {
                $this->load->view($conteudo);
            } else {
                echo "<h3>Bem-vindo ao painel do médico!</h3>";
            }
        ?>
    </div>
</body>
</html>
