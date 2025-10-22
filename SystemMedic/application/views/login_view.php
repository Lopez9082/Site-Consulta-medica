<?php $this->load->view('includes/header', ['title' => 'Login']); ?>

<h2>Login</h2>

<?php if (isset($erro)) : ?>
    <div class="alert alert-danger"><?= $erro ?></div>
<?php endif; ?>

<form method="post" action="<?= base_url('login/autenticar') ?>">
    <div class="form-group">
        <label>Email:</label>
        <input type="text" name="email" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Senha:</label>
        <input type="password" name="senha" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Entrar</button>
</form>

<?php $this->load->view('includes/footer'); ?>
