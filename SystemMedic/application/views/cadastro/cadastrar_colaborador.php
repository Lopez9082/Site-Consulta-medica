<div class="container mt-5 mb-5">
    <h3 class="text-center mb-5" style="color:#2c3e50; border-bottom:3px solid #1abc9c; padding-bottom:10px;">
        Cadastrar Colaborador
    </h3>

    <?php if($this->session->flashdata('sucesso')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('sucesso') ?></div>
    <?php endif; ?>

    <div class="card shadow-sm p-4" style="border-radius:12px; background:#fdfdfd;">
        <form method="POST" action="<?= site_url('balcao/salvar_colaborador') ?>">

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label"><strong>Nome</strong></label>
                    <input type="text" name="Nome" id="Nome" class="form-control" placeholder="Nome completo" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label"><strong>Função</strong></label>
                    <input type="text" name="Funcao" id="Funcao" class="form-control" placeholder="Ex: Recepcionista" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label"><strong>Email</strong></label>
                    <input type="email" name="Email" id="Email" class="form-control" placeholder="exemplo@email.com">
                </div>
                <div class="col-md-6">
                    <label class="form-label"><strong>Telefone</strong></label>
                    <input type="text" name="Telefone" id="Telefone" class="form-control" placeholder="(00) 90000-0000">
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="<?= site_url('balcao/colaboradores') ?>" class="btn btn-secondary me-3">
                    <i class="bi bi-x-circle"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> Cadastrar
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

    i.bi {
        margin-right: 4px;
    }
</style>
