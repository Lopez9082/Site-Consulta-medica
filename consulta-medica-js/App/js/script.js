// ==== VARIÁVEIS GLOBAIS ====
const form = document.getElementById('cadastroForm');
const steps = document.querySelectorAll('.form-step');
const progressSteps = document.querySelectorAll('.step');
const nextBtns = document.querySelectorAll('.btn-next');
const prevBtns = document.querySelectorAll('.btn-prev');
const submitBtn = document.getElementById('btn-submit');
const progressLine = document.querySelector('.progress-line');

let currentStep = 1;
const totalSteps = steps.length;
const MIN_IDADE = 18; // Idade mínima (ajuste se necessário)

// Carrega dados salvos no localStorage ao iniciar
function loadSavedData() {
    const savedData = JSON.parse(localStorage.getItem('cadastroPaciente') || '{}');
    Object.keys(savedData).forEach(key => {
        const input = document.getElementById(key);
        if (input) {
            input.value = savedData[key];
            // Reaplica máscaras se for CPF ou telefone
            if (key === 'cpf') applyCpfMask(input);
            if (key === 'telefone') applyTelefoneMask(input);
        }
    });
    // Atualiza progresso baseado nos dados salvos
    updateProgress();
    // Valida step inicial
    validateStep(1);
}

// Salva dados no localStorage
function saveData() {
    const formData = new FormData(form);
    const data = Object.fromEntries(formData);
    localStorage.setItem('cadastroPaciente', JSON.stringify(data));
}

// Atualiza barra de progresso (inclui CSS var para linha)
function updateProgress() {
    progressSteps.forEach((step, index) => {
        step.classList.remove('active', 'completed');
        if (index + 1 < currentStep) {
            step.classList.add('completed');
        } else if (index + 1 === currentStep) {
            step.classList.add('active');
        }
    });
    // Adiciona classe active na linha e define CSS var para width dinâmica
    if (currentStep > 1) {
        progressLine.classList.add('active');
    } else {
        progressLine.classList.remove('active');
    }
    document.documentElement.style.setProperty('--current-step', currentStep);
    // Atualiza ARIA
    document.querySelector('.progress-bar').setAttribute('aria-valuenow', currentStep);
}

// Mostra step específico
function showStep(stepNum) {
    steps.forEach(step => step.classList.remove('active'));
    document.getElementById(`step-${stepNum}`).classList.add('active');
    currentStep = stepNum;
    updateProgress();
    // Foco no primeiro input/select da step
    const firstInput = document.querySelector(`#step-${stepNum} input, #step-${stepNum} select`);
    if (firstInput) {
        firstInput.focus();
    }
    // Limpa erros da step anterior
    if (stepNum > 1) clearErrors(stepNum - 1);
}

// Limpa mensagens de erro de uma step
function clearErrors(stepNum) {
    const errorSpans = document.querySelectorAll(`#step-${stepNum} .error-message`);
    errorSpans.forEach(span => {
        span.textContent = '';
        span.style.display = 'none';
    });
    const inputs = document.querySelectorAll(`#step-${stepNum} input, #step-${stepNum} select`);
    inputs.forEach(input => input.classList.remove('error'));
}

// Mostra erro em um campo
function showError(fieldId, message) {
    const errorSpan = document.getElementById(`error-${fieldId}`);
    const input = document.getElementById(fieldId);
    if (errorSpan) {
        errorSpan.textContent = message;
        errorSpan.style.display = 'block';
    }
    if (input) {
        input.classList.add('error');
    }
}

// Valida um campo específico
function validateField(fieldId, validators = []) {
    const field = document.getElementById(fieldId);
    if (!field || !field.value.trim()) {
        showError(fieldId, 'Este campo é obrigatório.');
        return false;
    }
    // Remove erro inicial
    field.classList.remove('error');
    const errorSpan = document.getElementById(`error-${fieldId}`);
    if (errorSpan) errorSpan.style.display = 'none';

    // Aplica validações específicas
    for (let validator of validators) {
        if (!validator.fn(field.value)) {
            showError(fieldId, validator.message);
            return false;
        }
    }
    return true;
}

// Valida toda a step atual
function validateStep(stepNum) {
    let isValid = true;
    clearErrors(stepNum);

    switch (stepNum) {
        case 1: // Dados Básicos
            isValid = validateField('nome', [{ fn: val => val.length >= 2, message: 'Nome deve ter pelo menos 2 caracteres.' }]);
            if (isValid) {
                const dataNascInput = document.getElementById('data_nasc');
                const dataNasc = new Date(dataNascInput.value);
                const hoje = new Date();
                let idade = hoje.getFullYear() - dataNasc.getFullYear();
                const mes = hoje.getMonth() - dataNasc.getMonth();
                if (mes < 0 || (mes === 0 && hoje.getDate() < dataNasc.getDate())) idade--;
                if (idade < MIN_IDADE || !dataNascInput.value) {
                    showError('data_nasc', `Idade mínima de ${MIN_IDADE} anos.`);
                    isValid = false;
                }
            }
            break;

        case 2: // Identificação
            isValid = validateField('cpf', [{ fn: val => isValidCPF(val.replace(/\D/g, '')), message: 'CPF inválido.' }]);
            if (isValid) isValid = validateField('telefone', [{ fn: val => val.replace(/\D/g, '').length >= 10, message: 'Telefone deve ter pelo menos 10 dígitos.' }]);
            break;

        case 3: // Endereço
            isValid = validateField('cidade', [{ fn: val => val.length >= 2, message: 'Cidade deve ter pelo menos 2 caracteres.' }]);
            if (isValid) isValid = validateField('estado', [{ fn: val => val !== '', message: 'Selecione um estado.' }]);
            break;

        case 4: // Criação da Conta
            isValid = validateField('email', [{ fn: val => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val), message: 'E-mail inválido.' }]);
            if (isValid) {
                const senha = document.getElementById('senha').value;
                isValid = validateField('senha', [
                    { fn: val => val.length >= 8, message: 'Senha deve ter pelo menos 8 caracteres.' },
                    { fn: val => /[A-Z]/.test(val), message: 'Senha deve conter pelo menos uma maiúscula.' },
                    { fn: val => /[a-z]/.test(val), message: 'Senha deve conter pelo menos uma minúscula.' },
                    { fn: val => /\d/.test(val), message: 'Senha deve conter pelo menos um número.' }
                ]);
                const confirmarSenha = document.getElementById('confirmar_senha').value;
                if (isValid && senha !== confirmarSenha) {
                    showError('confirmar_senha', 'Senhas não coincidem.');
                    isValid = false;
                } else if (confirmarSenha) {
                    document.getElementById('confirmar_senha').classList.remove('error');
                    document.getElementById('error-confirmar_senha').style.display = 'none';
                }
            }
            break;
    }
    return isValid;
}

// Validação de CPF (algoritmo oficial - CORRIGIDO E COMPLETO)
function isValidCPF(cpf) {
    cpf = cpf.replace(/\D/g, '');
    if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) return false;
    let sum = 0;
    for (let i = 0; i < 9; i++) sum += parseInt(cpf.charAt(i)) * (10 - i);
    let remainder = (sum * 10) % 11;
    remainder = remainder === 10 || remainder === 11 ? 0 : remainder;
    if (remainder !== parseInt(cpf.charAt(9))) return false;
    sum = 0;
    for (let i = 0; i < 10; i++) sum += parseInt(cpf.charAt(i)) * (11 - i);
    remainder = (sum * 10) % 11;
    remainder = remainder === 10 || remainder === 11 ? 0 : remainder;
    if (remainder !== parseInt(cpf.charAt(10))) return false;
    return true;
}

// Máscara para CPF
function applyCpfMask(input) {
    input.addEventListener('input', (e) => {
        let value = e.target.value.replace(/\D/g, '');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        e.target.value = value.substring(0, 14); // Limita tamanho
    });
}

// Máscara para Telefone
function applyTelefoneMask(input) {
    input.addEventListener('input', (e) => {
        let value = e.target.value.replace(/\D/g, '');
        value = value.replace(/(\d{2})(\d)/, '($1) $2');
        value = value.replace(/(\d{4,5})(\d{4})$/, '$1-$2');
        e.target.value = value.substring(0, 15); // Limita tamanho
    });
}

// Aplica máscaras em todos os inputs relevantes
function applyMasks() {
    const cpfInput = document.getElementById('cpf');
    const telInput = document.getElementById('telefone');
    if (cpfInput) applyCpfMask(cpfInput);
    if (telInput) applyTelefoneMask(telInput);
}

// Event Listeners para navegação (Botões "Continuar" e "Voltar")
nextBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        const nextStep = parseInt(btn.dataset.next);
        if (nextStep <= totalSteps && validateStep(currentStep)) {
            showStep(nextStep);
            saveData();
        }
    });
});

prevBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        const prevStep = parseInt(btn.dataset.prev);
        if (prevStep >= 1) {
            showStep(prevStep);
            saveData();
        }
    });
});

// Listener para validação em tempo real (feedback imediato nos inputs)
form.addEventListener('input', (e) => {
    const fieldId = e.target.id;
    if (fieldId) {
        // Limpa erro se o campo for preenchido
        if (e.target.value.trim()) {
            const stepNum = currentStep;
            clearErrors(stepNum); // Limpa erros da step atual
            // Validação rápida para campos específicos (opcional)
            if (fieldId === 'cpf') validateField('cpf', [{ fn: val => isValidCPF(val.replace(/\D/g, '')) }]);
            if (fieldId === 'email') validateField('email', [{ fn: val => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val) }]);
        }
    }
});

// Handler para Submit (Finalizar Cadastro)
form.addEventListener('submit', async (e) => {
    e.preventDefault();
    // Valida todas as steps antes de submeter
    let allValid = true;
    for (let i = 1; i <= totalSteps; i++) {
        if (!validateStep(i)) {
            allValid = false;
            showStep(i); // Mostra a step com erro
            break;
        }
    }
    if (!allValid) {
        alert('Por favor, corrija os erros indicados.');
        return;
    }

    // Adiciona loading no botão
    const originalText = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="loading"></span>Enviando...';

    // Simula envio (substitua por fetch real para backend)
    try {
        const formData = new FormData(form);
        // Exemplo de fetch: await fetch('/api/cadastro', { method: 'POST', body: formData });
        await new Promise(resolve => setTimeout(resolve, 2000)); // Delay simulado de 2s

        // Sucesso: Limpa localStorage e reseta form
        localStorage.removeItem('cadastroPaciente');
        alert('Cadastro realizado com sucesso!');
        form.reset();
        showStep(1);
        updateProgress();
    } catch (error) {
        console.error('Erro no envio:', error);
        alert('Erro ao enviar dados. Tente novamente.');
    } finally {
        // Remove loading
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    }
});

// Inicialização (Carrega tudo quando a página carrega)
document.addEventListener('DOMContentLoaded', () => {
    loadSavedData();
    applyMasks();
});