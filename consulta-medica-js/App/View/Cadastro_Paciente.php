<?php
// cadastro_paciente.php
require_once __DIR__ . '/../Models/Pacientes_model.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Etapas Simplificadas</title>
    <link rel="stylesheet" href="design/cadastro1.css">
</head>
<body>
    <div class="login-container">
        <form class="login-box" method="post" id="cadastroForm" novalidate>
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
            </div>

            <h2>Criar Conta</h2>

            <!-- Mensagens de erro globais -->
            <div id="error-message" class="error-message" role="alert" aria-live="polite"></div>

            <!-- Etapa 1: Dados Básicos (exemplo: nome, data de nascimento) -->
            <div class="form-step active" id="step-1">
                <h3>Dados Básicos</h3>
                
                <div class="form-group">
                    <input type="text" name="nome" id="nome" required placeholder="Digite seu nome completo">
                    <label for="nome">Nome Completo</label>
                    <div class="error-tooltip"></div>
                </div>

                <div class="form-group">
                    <input type="date" name="Data_Nas" id="Data_Nas" required max="">
                    <label for="data_nas">Data de Nascimento (maior de 18 anos)</label>
                    <div class="error-tooltip"></div>
                </div>

                <div class="form-navigation">
                    <button type="button" class="btn-next" data-next="2">Próximo</button>
                </div>
            </div>

            <!-- Etapa 2: Identificação -->
            <div class="form-step" id="step-2">
                <h3>Identificação</h3>

                <div class="form-group">
                    <input type="text" name="CPF" id="CPF" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" placeholder="000.000.000-00" required>
                    <label for="CPF">CPF</label>
                    <div class="error-tooltip"></div>
                </div>

                <div class="form-group">
                    <input type="tel" name="telefone" id="telefone" placeholder="(00) 00000-0000" required>
                    <label for="telefone">Telefone</label>
                    <div class="error-tooltip"></div>
                </div>

                <div class="form-navigation">
                    <button type="button" class="btn-prev" data-prev="1">Voltar</button>
                    <button type="button" class="btn-next" data-next="3">Próximo</button>
                </div>
            </div>

            <!-- Etapa 3: Endereço -->
            <div class="form-step" id="step-3">
                <h3>Endereço</h3>

                <div class="form-group">
                    <input type="text" id="cep" name="cep" placeholder="00000-000" pattern="\d{5}-?\d{3}" maxlength="9" required>
                    <label for="cep">CEP</label>
                    <div class="error-tooltip"></div>
                    <div class="loading-spinner" id="cep-loading" aria-hidden="true"></div>
                </div>

                <div class="form-row">
                    <div class="form-group half-width">
                        <input type="text" id="endereco" name="endereco" placeholder="Rua, avenida..." required>
                        <label for="endereco">Endereço</label>
                        <div class="error-tooltip"></div>
                </div>
                </div>

                <div class="form-row">
                    <div class="form-group half-width">
                        <input type="text" id="complemento" name="complemento" placeholder="Apartamento, bloco...">
                        <label for="complemento">Complemento (opcional)</label>
                        <div class="error-tooltip"></div>
                    </div>
                    <div class="form-group half-width">
                        <input type="text" id="cidade" name="cidade" placeholder="Ex: São Paulo" required>
                        <label for="cidade">Cidade</label>
                        <div class="error-tooltip"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group half-width">
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
                        <label for="estado">Estado</label>
                        <div class="error-tooltip"></div>
                    </div>
                    <div class="form-group half-width">
                        <input type="text" id="pais" name="pais" value="Brasil" readonly>
                        <label for="pais">País</label>
                    </div>
                </div>

                <div class="form-navigation">
                    <button type="button" class="btn-prev" data-prev="2">Voltar</button>
                    <button type="button" class="btn-next" data-next="4">Próximo</button>
                </div>
            </div>

            <!-- Etapa 4: Conta -->
            <div class="form-step" id="step-4">
                <h3>Criar Conta</h3>

                <div class="form-group">
                    <input type="email" name="email" id="email" placeholder="seuemail@exemplo.com" required>
                    <label for="email">E-mail</label>
                    <div class="error-tooltip"></div>
                </div>

                <div class="form-group">
                    <input type="password" name="senha" id="senha" placeholder="Mínimo 10 caracteres" minlength="10" required>
                    <label for="senha">Senha</label>
                    <div class="error-tooltip"></div>
                    <div class="password-strength" id="password-strength"></div>
                </div>

                <div class="form-group">
                    <input type="password" name="confirmar_senha" id="confirmar_senha" placeholder="Confirme a senha" required>
                    <label for="confirmar_senha">Confirmar Senha</label>
                    <div class="error-tooltip"></div>
                </div>

                <div class="form-group checkbox-group">
                    <input type="checkbox" id="termos" name="termos" required>
                    <label for="termos" class="checkbox-label">
                        Concordo com os <a href="#" target="_blank">termos e condições</a> e <a href="#" target="_blank">política de privacidade</a>
                    </label>
                    <div class="error-tooltip"></div>
                </div>

                <div class="form-navigation">
                    <button type="button" class="btn-prev" data-prev="3">Voltar</button>
                    <button type="submit" class="btn-submit">Finalizar Cadastro</button>
                </div>
            </div>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 José, Beatriz, Fernando</p>
    </footer>

    <script src="js/cadastrosla.js"></script>
</body>
</html>