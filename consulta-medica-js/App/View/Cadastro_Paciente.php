<?php
// cadastro_paciente.php
//require_once __DIR__ . '/../Models/Pacientes_model.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro em Etapas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="design/cadastro1.css">
</head>
<body>
<<<<<<< HEAD
    <div class="cadastro-container">
        <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="4" aria-valuenow="1">
            <div class="step active" data-step="1">
                <span class="step-number">1</span>
=======
    <div class="login-container">
        <form class="login-box" method="post" id="cadastroForm" action="Pacientes_model.php" novalidate>
            <!-- Indicador de Progresso -->
            <div class="progress-indicator" role="progressbar" aria-valuemin="1" aria-valuemax="4" aria-valuenow="1">
                <div class="progress-step active" data-step="1">
                    <span class="step-number" aria-hidden="true">1</span>
                    <span class="step-icon" aria-hidden="true">👤</span>
                    <span class="step-label">Dados Básicos</span>
                </div>
                <div class="progress-step" data-step="2">
                    <span class="step-number" aria-hidden="true">2</span>
                    <span class="step-icon" aria-hidden="true">🆔</span>
                    <span class="step-label">Identificação</span>
                </div>
                <div class="progress-step" data-step="3">
                    <span class="step-number" aria-hidden="true">3</span>
                    <span class="step-icon" aria-hidden="true">🏠</span>
                    <span class="step-label">Endereço</span>
                </div>
                <div class="progress-step" data-step="4">
                    <span class="step-number" aria-hidden="true">4</span>
                    <span class="step-icon" aria-hidden="true">📧</span>
                    <span class="step-label">Conta</span>
                </div>
>>>>>>> b952ab7d2f3040ee8ee64379a8a5d51fa950cdf4
            </div>
            <div class="step" data-step="2">
                <span class="step-number">2</span>
            </div>
            <div class="step" data-step="3">
                <span class="step-number">3</span>
            </div>
            <div class="step" data-step="4">
                <span class="step-number">4</span>
            </div>
            <div class="progress-line"></div>
        </div>

        <form id="cadastroForm" novalidate>
            <!-- Etapa 1: Dados Básicos -->
            <div class="form-step active" id="step-1">
                <h2 class="step-title">Dados Básicos</h2>
                <div class="form-group">
                    <label for="nome">Nome Completo</label>
                    <input type="text" id="nome" name="nome" placeholder="Digite seu nome completo" required>
                    <span class="error-message" id="error-nome"></span>
                </div>
                <div class="form-group">
<<<<<<< HEAD
                    <label for="data_nasc">Data de Nascimento</label>
                    <input type="date" id="data_nasc" name="data_nasc" required>
                    <span class="error-message" id="error-data_nasc"></span>
=======
                    <input type="date" name="Data_Nas" id="Data_Nas" required max="">
                    <label for="data_nas">Data de Nascimento (maior de 18 anos)</label>
                    <div class="error-tooltip"></div>
                </div>

                <div class="form-navigation">
                    <button type="button" class="btn-next" data-next="2">Próximo</button>
>>>>>>> b952ab7d2f3040ee8ee64379a8a5d51fa950cdf4
                </div>
                <button type="button" class="btn-next full-width" data-next="2">Continuar</button>
            </div>

            <!-- Etapa 2: Identificação -->
            <div class="form-step" id="step-2">
                <h2 class="step-title">Identificação</h2>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" maxlength="14" required>
                    <span class="error-message" id="error-cpf"></span>
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="tel" id="telefone" name="telefone" placeholder="(00) 00000-0000" maxlength="15" required>
                    <span class="error-message" id="error-telefone"></span>
                </div>
                <div class="navigation">
                    <button type="button" class="btn-prev" data-prev="1">Voltar</button>
                    <button type="button" class="btn-next" data-next="3">Continuar</button>
                </div>
            </div>

            <!-- Etapa 3: Endereço -->
            <div class="form-step" id="step-3">
                <h2 class="step-title">Endereço 📍</h2>
                <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <input type="text" id="cidade" name="cidade" placeholder="Digite sua cidade" required>
                    <span class="error-message" id="error-cidade"></span>
                </div>
<<<<<<< HEAD
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select id="estado" name="estado" required>
                        <option value="">Selecione o estado</option>
                        <option value="AC">Acre (AC)</option>
                        <option value="AL">Alagoas (AL)</option>
                        <option value="AP">Amapá (AP)</option>
                        <option value="AM">Amazonas (AM)</option>
                        <option value="BA">Bahia (BA)</option>
                        <option value="CE">Ceará (CE)</option>
                        <option value="DF">Distrito Federal (DF)</option>
                        <option value="ES">Espírito Santo (ES)</option>
                        <option value="GO">Goiás (GO)</option>
                        <option value="MA">Maranhão (MA)</option>
                        <option value="MT">Mato Grosso (MT)</option>
                        <option value="MS">Mato Grosso do Sul (MS)</option>
                        <option value="MG">Minas Gerais (MG)</option>
                        <option value="PA">Pará (PA)</option>
                        <option value="PB">Paraíba (PB)</option>
                        <option value="PR">Paraná (PR)</option>
                        <option value="PE">Pernambuco (PE)</option>
                        <option value="PI">Piauí (PI)</option>
                        <option value="RJ">Rio de Janeiro (RJ)</option>
                        <option value="RN">Rio Grande do Norte (RN)</option>
                        <option value="RS">Rio Grande do Sul (RS)</option>
                        <option value="RO">Rondônia (RO)</option>
                        <option value="RR">Roraima (RR)</option>
                        <option value="SC">Santa Catarina (SC)</option>
                        <option value="SP">São Paulo (SP)</option>
                        <option value="SE">Sergipe (SE)</option>
                        <option value="TO">Tocantins (TO)</option>
                    </select>
                    <span class="error-message" id="error-estado"></span>
=======

                <div class="form-row">
                    <div class="form-group half-width">
                        <input type="text" id="endereco" name="endereco" placeholder="Rua, avenida..." required>
                        <label for="endereco">Endereço</label>
                        <div class="error-tooltip"></div>
                </div>
>>>>>>> b952ab7d2f3040ee8ee64379a8a5d51fa950cdf4
                </div>
                <div class="navigation">
                    <button type="button" class="btn-prev" data-prev="2">Voltar</button>
                    <button type="button" class="btn-next" data-next="4">Continuar</button>
                </div>
            </div>

            <!-- Etapa 4: Criação da Conta -->
            <div class="form-step" id="step-4">
                <h2 class="step-title">Criação da Conta</h2>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="seu@email.com" required>
                    <span class="error-message" id="error-email"></span>
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Mínimo 8 caracteres" minlength="8" required>
                    <span class="error-message" id="error-senha"></span>
                </div>
                <div class="form-group">
                    <label for="confirmar_senha">Confirmar Senha</label>
                    <input type="password" id="confirmar_senha" name="confirmar_senha" placeholder="Repita a senha" minlength="8" required>
                    <span class="error-message" id="error-confirmar_senha"></span>
                </div>
                <div class="navigation">
                    <button type="button" class="btn-prev" data-prev="3">Voltar</button>
                    <button type="submit" class="btn-submit full-width" id="btn-submit">Finalizar Cadastro</button>
                </div>
            </div>
        </form>
    </div>

<<<<<<< HEAD
    <script src="../js/cadastrosla.js"></script>
=======
    <footer>
        <p>&copy; 2024 José, Beatriz, Fernando</p>
    </footer>

    <script src="js/cadastrosla.js"></script>

<script>
    // Exemplo com fetch + JSON
const dados = {
    nome: document.getElementById('nome').value,
    email: document.getElementById('email').value,
    senha: document.getElementById('senha').value,
    Data_Nas: document.getElementById('Data_Nas').value,
    // e todos os outros campos...
};

fetch('index.php?controller=pacientes&action=cadastrar', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(dados)
})
.then(res => res.json())
.then(data => {
    if (data.sucesso) {
        alert(data.mensagem);
    } else {
        alert("Erro: " + data.mensagem);
    }
});

</script>
>>>>>>> b952ab7d2f3040ee8ee64379a8a5d51fa950cdf4
</body>
</html>