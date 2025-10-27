<div class="container mt-4 mb-5">
    <h3 class="text-center mb-4">Perfil do Paciente</h3>

    <?php if (!empty($paciente)): ?>
    <div class="card shadow p-4">
        <div class="row mb-4">
            <div class="col-md-3 text-center">
                <div class="rounded-circle bg-light border p-4 d-flex align-items-center justify-content-center" style="width:120px;height:120px;margin:auto;">
                    <i class="bi bi-person-circle" style="font-size:70px;color:#6c757d;"></i>
                </div>
                <h5 class="mt-3 text-primary"><?= $paciente->Nome_Pac ?></h5>
                <p class="text-muted mb-1"><?= $paciente->Cpf_cnpj ?></p>
                <p class="text-muted">ID: <?= $paciente->Id ?></p>
                <a href="<?= site_url('balcao/editar_paciente/' . $paciente->Id) ?>" class="btn btn-sm btn-outline-primary mt-2">
                    <i class="bi bi-pencil"></i> Editar Dados
                </a>
            </div>

            <div class="col-md-9">
                <h5 class="text-secondary mb-3">Informações Pessoais</h5>
                <div class="row mb-2">
                    <div class="col-md-6"><strong>Nome:</strong> <?= $paciente->Nome_Pac ?></div>
                    <div class="col-md-3"><strong>Data Nascimento:</strong> <?= date('d/m/Y', strtotime($paciente->Data_Nas)) ?></div>
                    <div class="col-md-3"><strong>CPF/CNPJ:</strong> <?= $paciente->Cpf_cnpj ?></div>
                </div>

                <h5 class="text-secondary mt-4 mb-3">Contato</h5>
                <div class="row mb-2">
                    <div class="col-md-4"><strong>Telefone:</strong> <?= $paciente->Telefone ?></div>
                    <div class="col-md-4"><strong>Celular:</strong> <?= $paciente->Celular ?></div>
                    <div class="col-md-4"><strong>Email:</strong> <?= $paciente->Email_Pac ?></div>
                    <div class="col-md-4"><strong>Senha:</strong> <?= $paciente->Senha_Pac ?></div>
                </div>

                <h5 class="text-secondary mt-4 mb-3">Endereço</h5>
                <div class="row mb-2">
                    <div class="col-md-6"><strong>Endereço:</strong> <?= $paciente->Endereco_Pac ?></div>
                    <div class="col-md-3"><strong>Municipio:</strong> <?= $paciente->Municipio ?></div>
                    <div class="col-md-3"><strong>UF:</strong> <?= $paciente->UF ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Histórico de Consultas -->
    <div class="card shadow mt-5">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Histórico de Consultas</h5>
        </div>
        <div class="card-body">
            <?php if (!empty($consultas)): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Data</th>
                                <th>Médico</th>
                                <th>Especialidade</th>
                                <th>Horário:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($consultas as $c): ?>
                                <tr>
                                    <td><?= date('d/m/Y', strtotime($c->Data_Consulta)) ?></td>
                                    <td><?= $c->Nome_Med ?></td>
                                    <td><?= $c->Especialidade?></td>
                                    <td><?= $c->Horario ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info">Nenhuma consulta registrada para este paciente.</div>
            <?php endif; ?>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="<?= site_url('balcao/pacientes') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Voltar à Lista
        </a>
    </div>

    <?php else: ?>
        <div class="alert alert-danger text-center">Paciente não encontrado.</div>
    <?php endif; ?>
</div>
