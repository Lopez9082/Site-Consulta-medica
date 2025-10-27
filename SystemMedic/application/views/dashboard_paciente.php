<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Paciente</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { display: flex; margin: 0; font-family: Arial, sans-serif; }
        .sidebar { width: 220px; background: #2c3e50; color: #fff; min-height: 100vh; position: relative; }
        .sidebar h2 { text-align: center; padding: 20px 0; font-size: 20px; border-bottom: 1px solid rgba(255,255,255,0.2); }
        .sidebar ul { list-style: none; padding: 0; margin: 0; }
        .sidebar ul li { padding: 15px 20px; }
        .sidebar ul li a { color: #fff; text-decoration: none; display: block; }
        .sidebar ul li a:hover { background: #1abc9c; }
        .logout { position: absolute; bottom: 20px; width: 100%; text-align: center; }
        .logout a { color: #fff; text-decoration: none; }
        .content { flex: 1; padding: 20px; background: #ecf0f1; min-height: 100vh; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2><?= $this->session->userdata('usuario')->Nome_Pac ?? 'Paciente' ?></h2>
        <ul>
            <li><a href="<?= site_url('paciente/perfil') ?>"><i class="fa fa-user"></i> Perfil</a></li>
            <li><a href="<?= site_url('paciente/consultas') ?>"><i class="fa fa-calendar"></i> Consultas</a></li>
        </ul>
        <div class="logout">
            <a href="<?= site_url('login/sair') ?>"><i class="fa fa-sign-out-alt"></i> Sair</a>
        </div>
    </div>

    <div class="content">
        <?php
        if (isset($conteudo)) {
            $this->load->view($conteudo);
        } else {
            echo "<h3>Bem-vindo ao painel do paciente!</h3>";
        }
        ?>
    </div>
</body>
</html>
