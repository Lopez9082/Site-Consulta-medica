<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login</title>
    <link rel="stylesheet" href="design/style.css">
</head>
<body>
    <div class="login-container">
        <form class="login-box" id="loginForm">
            <h2>Entrar</h2>

            <label for="email">E-mail</label>
            <input type="email" id="email" placeholder="consulta@gmail.com" required>

            <label for="senha">Senha</label>
            <input type="password" id="senha" placeholder="No mínimo 10 dígitos" required>
            <p id="erroSenha" class="erro"></p>

            <button type="submit" class="btn-login">Login</button>

            <div class="extras">
                <label>
                    <input type="checkbox" id="lembrar"> Lembre-se de mim
                </label>
                <a href="#">Esqueceu a senha?</a>
            </div>
        </form>
    </div>

    <footer>
        <p>©2025 José, Beatriz, Fernando</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>