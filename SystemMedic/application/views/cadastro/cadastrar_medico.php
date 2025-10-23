<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">Cadastrar Médico</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= site_url('balcao/salvar_medico') ?>">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Nome <span class="text-danger">*</span></label>
                                <input type="text" name="Nome_Med" class="form-control" placeholder="Ex: Dr. João Silva" required>
                            </div>
                            <div class="col-md-6">
                                <label>CRM <span class="text-danger">*</span></label>
                                <input type="text" name="CRM" class="form-control" placeholder="Ex: 12345" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Especialidade <span class="text-danger">*</span></label>
                                <input type="text" name="Especialidade" class="form-control" placeholder="Ex: Cardiologia" required>
                            </div>
                            <div class="col-md-6">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="email" name="Email_Med" class="form-control" placeholder="Ex: medico@email.com" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Senha <span class="text-danger">*</span></label>
                                <input type="password" name="Senha_Med" class="form-control" placeholder="********" required>
                            </div>
                            <div class="col-md-6">
                                <label>Telefone</label>
                                <input type="text" name="Telefone" class="form-control" placeholder="(00) 0000-0000">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Celular</label>
                                <input type="text" name="Celular" class="form-control" placeholder="(00) 90000-0000">
                            </div>
                            <div class="col-md-6">
                                <label>Endereço</label>
                                <input type="text" name="Endereco_Med" class="form-control" placeholder="Rua, número, bairro">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label>CEP</label>
                                <input type="text" name="CEP" class="form-control" placeholder="00000-000">
                            </div>
                            <div class="col-md-5">
                                <label>Município</label>
                                <input type="text" name="Municipio" class="form-control" placeholder="Cidade">
                            </div>
                            <div class="col-md-3">
                                <label>UF</label>
                                <input type="text" name="UF" class="form-control" placeholder="Ex: SP">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?= site_url('balcao/medicos') ?>" class="btn btn-secondary">Voltar</a>
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Estilo extra opcional para dar “toque de consultório” -->
<style>
    body {
        background-color: #f7f9fb;
    }
    .card-header {
        font-family: 'Arial', sans-serif;
        letter-spacing: 0.5px;
    }
    input.form-control {
        border-radius: 0.3rem;
    }
    .btn-success {
        background-color: #4CAF50;
        border-color: #4CAF50;
    }
    .btn-success:hover {
        background-color: #45a049;
        border-color: #45a049;
    }
</style>
