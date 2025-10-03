<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login - Consulta Médica</title>
    <link rel="stylesheet" href="design/style.css">
</head>
<body>
    <div class="login-container">
        <form class="login-box" id="loginForm">
            <h2><i class="fas fa-user-md"></i> Entrar na Consulta Médica</h2>

            <label for="email">E-mail</label>
            <input type="email" id="email" placeholder="exemplo@consulta.com" required>

            <label for="senha">Senha</label>
            <input type="password" id="senha" placeholder="Digite sua senha" required>
            <p id="erroSenha" class="erro"></p>

            <button type="submit" class="btn-login">Acessar Consulta</button>

            <div class="extras">
                <div class="checkbox-item">
                    <input type="checkbox" id="lembrar" name="lembrar">
                    <label for="lembrar">Lembre-se de mim</label>
                </div>
                <a href="#" class="forgot-password">Esqueceu a senha?</a>
            </div>
        </form>
    </div>

    <footer>
        <p>©2025 José, Beatriz, Fernando - Plataforma de Consultas Médicas</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>