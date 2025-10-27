<div class="container mt-5 mb-5">
    <h3 class="text-center mb-5" style="color:#2c3e50; border-bottom:3px solid #1abc9c; padding-bottom:10px;">
        Cadastrar Médico
    </h3>

    <div class="card shadow-sm p-4" style="border-radius:12px; background:#fdfdfd;">
        <form method="post" action="<?= site_url('balcao/salvar_medico') ?>">

            <!-- Informações Pessoais -->
            <h5 class="mb-3 text-secondary">Informações Pessoais</h5>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label"><strong>Nome</strong> <span class="text-danger">*</span></label>
                    <input type="text" name="Nome_Med" class="form-control" placeholder="Ex: Dr. João Silva" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label"><strong>CRM</strong> <span class="text-danger">*</span></label>
                    <input type="text" name="CRM" class="form-control" placeholder="12345" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label"><strong>Especialidade</strong> <span class="text-danger">*</span></label>
                    <input type="text" name="Especialidade" class="form-control" placeholder="Ex: Cardiologia" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label"><strong>Email</strong> <span class="text-danger">*</span></label>
                    <input type="email" name="Email_Med" class="form-control" placeholder="medico@email.com" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label"><strong>Senha</strong> <span class="text-danger">*</span></label>
                    <input type="password" name="Senha_Med" class="form-control" placeholder="Senha segura" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label"><strong>Telefone</strong></label>
                    <input type="text" name="Telefone" class="form-control" placeholder="(00) 0000-0000">
                </div>
            </div>

            <!-- Contato e Endereço -->
            <h5 class="mb-3 text-secondary mt-4">Contato e Endereço</h5>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label"><strong>Celular</strong></label>
                    <input type="text" name="Celular" class="form-control" placeholder="(00) 90000-0000">
                </div>
                <div class="col-md-6">
                    <label class="form-label"><strong>Endereço</strong></label>
                    <input type="text" name="Endereco_Med" class="form-control" placeholder="Rua, número, bairro">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label"><strong>CEP</strong></label>
                    <input type="text" name="CEP" class="form-control" placeholder="00000-000">
                </div>
                <div class="col-md-5">
                    <label class="form-label"><strong>Município</strong></label>
                    <input type="text" name="Municipio" class="form-control" placeholder="Cidade">
                </div>
                <div class="col-md-3">
                    <label class="form-label"><strong>UF</strong></label>
                    <input type="text" name="UF" class="form-control" maxlength="2" placeholder="SP">
                </div>
            </div>

            <!-- Ações -->
            <div class="d-flex justify-content-end mt-4">
                <a href="<?= site_url('balcao/medicos') ?>" class="btn btn-secondary me-3">
                    <i class="bi bi-x-circle"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> Salvar
                </button>
            </div>

        </form>
    </div>
</div>

<style>
    body {
        background-color: #f7f9fb;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .card {
        border-radius: 12px;
        transition: 0.3s;
    }
    .card:hover {
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }

    h3 {
        font-weight: 600;
    }

    h5 {
        font-weight: 500;
        letter-spacing: 0.5px;
    }

    .form-control {
        border-radius: 0.4rem;
        transition: 0.3s;
        padding: 0.55rem;
    }

    .form-control:focus {
        border-color: #1abc9c;
        box-shadow: 0 0 6px rgba(26, 188, 156, 0.3);
    }

    label {
        font-weight: 500;
    }

    .btn-success {
        background-color: #1abc9c;
        border-color: #16a085;
        transition: 0.3s;
    }
    .btn-success:hover {
        background-color: #16a085;
        border-color: #138d75;
    }

    .btn-secondary {
        background-color: #bdc3c7;
        border-color: #95a5a6;
    }
    .btn-secondary:hover {
        background-color: #95a5a6;
        border-color: #7f8c8d;
    }

    /* Ícones de bootstrap */
    i.bi {
        margin-right: 4px;
    }
</style>
