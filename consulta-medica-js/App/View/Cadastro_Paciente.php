<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Cadastro</title>
    <link rel="stylesheet" href="design/style.css">
</head>
<body>
    <div class="login-container">
<form class="login-box" action="salvar.php" method="post">
    <h2>Entrar</h2>
    <label for="email">E-mail</label>
    <input type="email" name="email" id="email" placeholder="consulta@gmail.com" required>

    <label for="senha">Senha</label>
    <input type="password" name="senha" id="senha" placeholder="No mínimo 10 dígitos" required>

    <label for="nome">Nome</label>
    <input type="text" name="nome" id="nome" required>

    <label for="Data_Nas">Data de Nascimento:</label>
    <input type="date" name="Data_Nas" id="Data_Nas" required>

    <button type="submit" class="btn-login">Cadastrar</button>
</form>

    </div>

    <footer>
        <p>©2025 José, Beatriz, Fernando</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>