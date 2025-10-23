<div class="container mt-4">
    <h3 class="mb-4">Cadastrar Paciente</h3>

    <form method="post" action="<?= site_url('balcao/salvar_paciente') ?>">
        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="Nome_Pac" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Data de Nascimento</label>
            <input type="date" name="Data_Nas" class="form-control">
        </div>
        <div class="mb-3">
            <label>CPF</label>
            <input type="text" name="Cpf_cnpj" class="form-control">
        </div>
        <div class="mb-3">
            <label>Telefone</label>
            <input type="text" name="Telefone" class="form-control">
        </div>
        <div class="mb-3">
            <label>Celular</label>
            <input type="text" name="Celular" class="form-control">
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="Email_Pac" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="<?= site_url('balcao/lista_pacientes') ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
