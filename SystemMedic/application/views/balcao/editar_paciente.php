<div class="container mt-4 mb-5">
    <h3 class="text-center mb-4">Editar Paciente</h3>

    <?php if (!empty($paciente)): ?>
        <div class="card shadow p-4">
            <form action="<?= site_url('balcao/salvar_edicao_paciente/' . $paciente->Id) ?>" method="post">
                <div class="row mb-3">
                    <div class="col-md-4 text-center">
                        <div class="rounded-circle bg-light border p-4 d-flex align-items-center justify-content-center" 
                             style="width:120px;height:120px;margin:auto;">
                            <i class="bi bi-person-circle" style="font-size:70px;color:#6c757d;"></i>
                        </div>
                        <h5 class="mt-3 text-primary"><?= $paciente->Nome_Pac ?></h5>
                        <p class="text-muted mb-1">ID: <?= $paciente->Id ?></p>
                    </div>

                    <div class="col-md-8">
                        <h5 class="text-secondary mb-3">Informações Pessoais</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>Nome</strong></label>
                                <input type="text" name="Nome_Pac" class="form-control" 
                                       value="<?= set_value('Nome_Pac', $paciente->Nome_Pac) ?>" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label"><strong>Data de Nascimento</strong></label>
                                <input type="date" name="Data_Nas" class="form-control" 
                                       value="<?= set_value('Data_Nas', $paciente->Data_Nas) ?>">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label"><strong>CPF / CNPJ</strong></label>
                                <input type="text" name="Cpf_cnpj" class="form-control" 
                                       value="<?= set_value('Cpf_cnpj', $paciente->Cpf_cnpj) ?>">
                            </div>
                        </div>

                        <h5 class="text-secondary mt-4 mb-3">Contato</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label"><strong>Telefone</strong></label>
                                <input type="text" name="Telefone" class="form-control" 
                                       value="<?= set_value('Telefone', $paciente->Telefone) ?>">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label"><strong>Celular</strong></label>
                                <input type="text" name="Celular" class="form-control" 
                                       value="<?= set_value('Celular', $paciente->Celular) ?>">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label"><strong>Email</strong></label>
                                <input type="email" name="Email_Pac" class="form-control" 
                                       value="<?= set_value('Email_Pac', $paciente->Email_Pac) ?>">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label"><strong>Senha</strong></label>
                                <input type="text" name="Senha_Pac" class="form-control" 
                                       value="<?= set_value('Senha_Pac', $paciente->Senha_Pac) ?>">
                            </div>
                        </div>

                        <h5 class="text-secondary mt-4 mb-3">Endereço</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>CEP</strong></label>
                                <input type="text" name="CEP" class="form-control" 
                                       value="<?= set_value('CEP', $paciente->CEP) ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>Endereço</strong></label>
                                <input type="text" name="Endereco_Pac" class="form-control" 
                                       value="<?= set_value('Endereco_Pac', $paciente->Endereco_Pac) ?>">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label"><strong>Município</strong></label>
                                <input type="text" name="Municipio" class="form-control" 
                                       value="<?= set_value('Municipio', $paciente->Municipio) ?>">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label"><strong>UF</strong></label>
                                <input type="text" name="UF" class="form-control" maxlength="2"
                                       value="<?= set_value('UF', $paciente->UF) ?>">
                            </div>
                        </div>

                        <div class="mt-4 text-end">
                            <a href="<?= site_url('medico/perfil_paciente/' . $paciente->Id) ?>" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Salvar Alterações
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    <?php else: ?>
        <div class="alert alert-danger text-center">Paciente não encontrado.</div>
    <?php endif; ?>
</div>
