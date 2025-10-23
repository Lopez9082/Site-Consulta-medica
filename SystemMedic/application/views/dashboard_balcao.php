<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel do Balcão</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>
<body>
    <div class="d-flex" style="min-height: 100vh;">
        <!-- MENU LATERAL -->
        <nav class="bg-dark text-white p-3" style="width: 250px;">
            <h4 class="text-center mb-4">Balcão</h4>
            <ul class="nav flex-column">

                <!-- Menu único de Cadastro com subitens -->
                <li class="nav-item mb-2">
    <a class="nav-link text-white d-flex justify-content-between align-items-center" 
       data-bs-toggle="collapse" href="#collapseCadastro" role="button" 
       aria-expanded="false" aria-controls="collapseCadastro">
        Cadastro
        <i class="bi bi-chevron-down" id="iconCadastro"></i>
    </a>
    <div class="collapse" id="collapseCadastro">
        <ul class="nav flex-column ms-3">
            <li class="nav-item mb-1">
                <a href="<?= site_url('balcao/pacientes') ?>" class="nav-link text-white">Pacientes</a>
            </li>
            <li class="nav-item mb-1">
                <a href="<?= site_url('balcao/medicos') ?>" class="nav-link text-white">Médicos</a>
            </li>
            <li class="nav-item mb-1">
                <a href="<?= site_url('balcao/colaboradores') ?>" class="nav-link text-white">Colaboradores</a>
            </li>
        </ul>
    </div>
</li>


                <!-- Consultas -->
                <li class="nav-item mb-2">
                    <a href="<?= site_url('balcao/consultas') ?>" class="nav-link text-white">Consultas</a>
                </li>

                <!-- Sair -->
                <li class="nav-item mt-4">
                    <a href="<?= site_url('login/sair') ?>" class="btn btn-danger w-100">Sair</a>
                </li>
            </ul>
        </nav>

        <!-- CONTEÚDO PRINCIPAL -->
        <div class="flex-grow-1 p-4 bg-light">
            <?php
            if (isset($conteudo)) {
                $this->load->view($conteudo);
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    const collapseCadastro = document.getElementById('collapseCadastro');
    const iconCadastro = document.getElementById('iconCadastro');

    collapseCadastro.addEventListener('show.bs.collapse', () => {
        iconCadastro.classList.remove('bi-chevron-down');
        iconCadastro.classList.add('bi-chevron-up');
    });

    collapseCadastro.addEventListener('hide.bs.collapse', () => {
        iconCadastro.classList.remove('bi-chevron-up');
        iconCadastro.classList.add('bi-chevron-down');
    });
</script>

</body>
</html>
