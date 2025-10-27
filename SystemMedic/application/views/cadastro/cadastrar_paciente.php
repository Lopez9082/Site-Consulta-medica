<div class="container mt-5 mb-5">
    <h3 class="text-center mb-5" style="color:#2c3e50; border-bottom:3px solid #1abc9c; padding-bottom:10px;">
        Cadastrar Paciente
    </h3>

    <div class="card shadow-sm p-4" style="border-radius:12px; background:#fdfdfd;">
        <form method="post" action="<?= site_url('balcao/salvar_paciente') ?>">

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label"><strong>Nome</strong></label>
                    <input type="text" name="Nome_Pac" class="form-control" placeholder="Nome completo" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label"><strong>Data de Nascimento</strong></label>
                    <input type="date" name="Data_Nas" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label"><strong>CPF</strong></label>
                    <input type="text" name="Cpf_cnpj" class="form-control" placeholder="000.000.000-00">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label"><strong>Telefone</strong></label>
                    <input type="text" name="Telefone" class="form-control" placeholder="(00) 0000-0000">
                </div>
                <div class="col-md-4">
                    <label class="form-label"><strong>Celular</strong></label>
                    <input type="text" name="Celular" class="form-control" placeholder="(00) 90000-0000">
                </div>
                <div class="col-md-4">
                    <label class="form-label"><strong>Email</strong></label>
                    <input type="email" name="Email_Pac" class="form-control" placeholder="exemplo@email.com">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label"><strong>Senha</strong></label>
                    <input type="password" name="Senha_Pac" class="form-control" placeholder="Senha segura" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label"><strong>Endereço</strong></label>
                    <input type="text" name="Endereco_Pac" class="form-control" placeholder="Rua, número, bairro">
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
                    <input type="text" name="UF" class="form-control" maxlength="2" placeholder="RJ">
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="<?= site_url('balcao/lista_pacientes') ?>" class="btn btn-secondary me-3">
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
    .form-control:focus {
        border-color: #1abc9c;
        box-shadow: 0 0 5px rgba(26, 188, 156, 0.4);
    }

    .btn-success {
        background-color: #1abc9c;
        border-color: #16a085;
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

    label {
        font-weight: 500;
    }
</style>
