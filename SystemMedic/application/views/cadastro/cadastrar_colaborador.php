<h2>Cadastrar Colaborador</h2>

<?php if($this->session->flashdata('sucesso')): ?>
    <div class="alert alert-success"><?= $this->session->flashdata('sucesso') ?></div>
<?php endif; ?>

<form method="POST" style="max-width:500px;">
    <div class="mb-3">
        <label class="form-label">Nome:</label>
        <input type="text" name="nome" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Função:</label>
        <input type="text" name="funcao" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email:</label>
        <input type="email" name="email" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Telefone:</label>
        <input type="text" name="telefone" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>
