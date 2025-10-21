<!DOCTYPE html>
<html>
<head>
    <title>Login Paciente</title>
</head>
<body>
    <h2>Login</h2>

    <?php if (isset($erro)) : ?>
        <p style="color: red;"><?= $erro ?></p>
    <?php endif; ?>

    <form method="post" action="<?= base_url('login/autenticar') ?>">
        <label>Email:</label><br>
        <input type="text" name="email" required><br><br>

        <label>Senha:</label><br>
        <input type="password" name="senha" required><br><br>

        <input type="submit" value="Entrar">
    </form>
</body>
</html>
