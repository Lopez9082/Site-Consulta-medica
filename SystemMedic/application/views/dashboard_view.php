<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Bem-vindo(a), <?= $this->session->userdata('paciente')->Nome_Pac; ?></h2>

    <p>Email: <?= $this->session->userdata('paciente')->Email_Pac; ?></p>

    <a href="<?= base_url('login/sair') ?>">Sair</a>
</body>
</html>
