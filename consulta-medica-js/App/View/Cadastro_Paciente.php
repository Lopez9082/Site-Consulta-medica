<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Cadastro</title>
    <link rel="stylesheet" href="design/cadastro1.css">
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

    <label for="CPF">CPF:</label>
    <input type="text" name="CPF" id="CPF"  pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" placeholder="xxx.xxx.xxx-xx" required>

               <!-- Endereço -->
            <div class="form-group">
                <label for="endereco">Endereço</label>
                <input type="text" id="endereco" name="endereco" placeholder="Rua, número, complemento" required>
            </div>

            <!-- Cidade -->
            <div class="form-group">
                <label for="cidade">Cidade</label>
                <input type="text" id="cidade" name="cidade" placeholder="Digite sua cidade" required>
            </div>

            <!-- Estado -->
            <div class="form-group">
                <label for="estado">Estado</label>
                <select id="estado" name="estado" required>
                    <option value="">Selecione seu estado</option>
                    <option value="RJ">Rio de Janeiro</option>
                    <option value="SP">São Paulo</option>
                    <option value="MG">Minas Gerais</option>
                    <option value="ES">Espírito Santo</option>
                    <option value="BSB">Brasilia</option> 
                    <!-- Adicione mais estados conforme necessário -->
                </select>
            </div>

            <!-- CEP -->
            <div class="form-group">
                <label for="cep">CEP</label>
                <input type="text" id="cep" name="cep" placeholder="Digite seu CEP" pattern="\d{5}-?\d{3}" title="Formato: 12345-678" required>
            </div>

            <!-- País -->
            <div class="form-group">
                <label for="pais">País</label>
                <input type="text" id="pais" name="pais" placeholder="Digite seu país" required>
            </div>
    <button type="submit" class="btn-login">Cadastrar</button>
</form>

    </div>

    <footer>
        <p>©2025 José, Beatriz, Fernando</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>