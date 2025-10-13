// ==== VARIÁVEIS GLOBAIS ====
const form = document.getElementById('cadastroForm');
const steps = document.querySelectorAll('.form-step');
const progressSteps = document.querySelectorAll('.step');
const nextBtns = document.querySelectorAll('.btn-next');
const prevBtns = document.querySelectorAll('.btn-prev');
const submitBtn = document.getElementById('btn-submit');

let currentStep = 1;
const totalSteps = steps.length;
const MIN_IDADE = 18; // Idade mínima para cadastro (ajuste se necessário)

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
    // Valida e mostra erros iniciais se houver dados parciais
    validateStep(1);
}

// Salva dados no localStorage
function saveData() {
    const formData = new FormData(form);
    const data = Object.fromEntries(formData);
    localStorage.setItem('cadastroPaciente', JSON.stringify(data));
}

// Atualiza barra de progresso
function updateProgress() {
    progressSteps.forEach((step, index) => {
        step.classList.remove('active', 'completed');
        if (index + 1 < currentStep) {
            step.classList.add('completed');
        } else if (index + 1 === currentStep) {
            step.classList.add('active');
        }
    });
    // Atualiza ARIA para acessibilidade
    document.querySelector('.progress-bar').setAttribute('aria-valuenow', currentStep);
}

// Mostra step específico
function showStep(stepNum) {
    steps.forEach(step => step.classList.remove('active'));
    document.getElementById(`step-${stepNum}`).classList.add('active');
    currentStep = stepNum;
    updateProgress();
    // Foco no primeiro input da step (CORRIGIDO AQUI)
    const firstInput = document.querySelector(`#step-${stepNum} input, #step-${stepNum} select`);
    if (firstInput) {
        firstInput.focus();
    }
    // Limpa erros da step anterior (opcional, para UX melhor)
    clearErrors(currentStep - 1);
}

// Limpa mensagens de erro de uma step específica
function clearErrors(stepNum) {
    const errorSpans = document.querySelectorAll(`#step-${stepNum} .error-message`);
    errorSpans.forEach(span => {
        span.textContent = '';
        span.style.display = 'none';
    });
    const inputs = document.querySelectorAll(`#step-${stepNum} input, #step-${stepNum} select`);
    inputs.forEach(input => {
        input.classList.remove('error');
    });
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
function validateField(fieldId, validators) {
    const field = document.getElementById(fieldId);
    if (!field || !field.value.trim()) {
        showError(fieldId, 'Este campo é obrigatório.');
        return false;
    }
    // Remove classe de erro inicial
    field.classList.remove('error');
    document.getElementById(`error-${fieldId}`).style.display = 'none';

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
    clearErrors(stepNum); // Limpa antes de validar

    switch (stepNum) {
        case 1: // Dados Básicos
            isValid = validateField('nome', [
                { fn: val => val.length >= 2, message: 'Nome deve ter pelo menos 2 caracteres.' }
            ]);
            if (isValid) {
                const dataNasc = new Date(document.getElementById('data_nasc').value);
                const hoje = new Date();
                const idade = hoje.getFullYear() - dataNasc.getFullYear();
                const mes = hoje.getMonth() - dataNasc.getMonth();
                if (mes < 0 || (mes === 0 && hoje.getDate() < dataNasc.getDate())) {
                    idade--;
                }
                if (idade < MIN_IDADE) {
                    showError('data_nasc', `Idade mínima de ${MIN_IDADE} anos.`);
                    isValid = false;
                } else {
                    validateField('data_nasc', []); // Só required, já validado acima
                }
            }
            break;

        case 2: // Identificação
            validateField('cpf', [
                { fn: val => isValidCPF(val.replace(/\D/g, '')), message: 'CPF inválido.' }
            ]);
            validateField('telefone', [
                { fn: val => val.replace(/\D/g, '').length >= 10, message: 'Telefone deve ter pelo menos 10 dígitos.' }
            ]);
            break;

        case 3: // Endereço
            validateField('cidade', [
                { fn: val => val.length >= 2, message: 'Cidade deve ter pelo menos 2 caracteres.' }
            ]);
            validateField('estado', [
                { fn: val => val !== '', message: 'Selecione um estado.' }
            ]);
            break;

        case 4: // Criação da Conta
            validateField('email', [
                { fn: val => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val), message: 'E-mail inválido.' }
            ]);
            const senha = document.getElementById('senha').value;
            validateField('senha', [
                { fn: val => val.length >= 8, message: 'Senha deve ter pelo menos 8 caracteres.' },
                { fn: val => /[A-Z]/.test(val), message: 'Senha deve conter pelo menos uma maiúscula.' },
                { fn: val => /[a-z]/.test(val), message: 'Senha deve conter pelo menos uma minúscula.' },
                { fn: val => /\d/.test(val), message: 'Senha deve conter pelo menos um número.' }
            ]);
            const confirmarSenha = document.getElementById('confirmar_senha').value;
            if (senha !== confirmarSenha) {
                showError('confirmar_senha', 'Senhas não coincidem.');
                isValid = false;
            } else {
                validateField('confirmar_senha', []); // Só required
            }
            break;
    }

    return isValid;
}

// Validação de CPF (algoritmo oficial brasileiro)
function isValidCPF(cpf) {
    cpf = cpf.replace(/\D/g, '');
    if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) return false;

    let sum = 0;
    for (let i = 0; i < 9; i++) {
        sum += parseInt(cpf.charAt(i)) * (10 - i);
    }
    let remainder = (sum * 10) % 11;
    if (remainder === 10 || remainder === 11) remainder = 0;
    if (remainder !== parseInt(cpf.charAt(9))) return false;

    sum = 0;
    for (let i = 0; i < 10; i++) {
        sum += parseInt(cpf.charAt(i)) * (11 - i);
    }
    remainder = (sum * 10) % 11;
    if (remainder === 10 || remainder === 11) remainder = 0;
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
        e.target.value = value;
    });
}

// Máscara para Telefone
function applyTelefoneMask(input) {
    input.addEventListener('input', (e) => {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length <= 11) {
            value = value.replace(/(\d{2})(\d)/, '($1) $2');
            value = value.replace(/(\d{4,5})(\d{4})$/, '$1-$2');
        }
        e.target.value = value;
    });
}

// Aplica máscaras em todos os inputs relevantes
function applyMasks() {
    const cpfInput = document.getElementById('cpf');
    const telInput = document.getElementById('telefone');
    if (cpfInput) applyCpfMask(cpfInput);
    if (telInput) applyTelefoneMask(telInput);
}

// Event Listeners para navegação
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

// Listener para validação em tempo real (opcional, para feedback imediato)
form.addEventListener('input', (e) => {
    const fieldId = e.target.id;
    if (fieldId) {
        // Valida o campo imediatamente (sem mensagens de força total, só required)
        if (!e.target.value.trim()) {
            showError(fieldId, 'Este campo é obrigatório.');
        } else {
            clearErrors(currentStep); // Limpa se válido
        }
    }
});

// Handler para Submit
form.addEventListener('submit', async (e) => {
    e.preventDefault();
    // Valida todas as steps antes de submeter
    let allValid = true;
    for (let i = 1; i <= totalSteps; i++) {
        showStep(i); // Temporariamente mostra para validar
        if (!validateStep(i)) {
            allValid = false;
            showStep(i); // Volta para a step inválida
            break;
        }
    }
    if (!allValid) {
        alert('Por favor, corrija os erros antes de finalizar.');
        return;
    }

    // Adiciona loading
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="loading"></span>Enviando...';

    // Simula envio (substitua por fetch real)
    try {
        const formData = new FormData(form);
        // Exemplo de fetch para backend:
        // await fetch(form.action, { method: 'POST', body: formData });
        await new Promise(resolve => setTimeout(resolve, 2000)); // Simula delay de 2s

        // Sucesso: Limpa localStorage e redireciona (ajuste)
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
        submitBtn.innerHTML = 'Finalizar Cadastro';
    }
});

// Inicialização
document.addEventListener('DOMContentLoaded', () => {
    loadSavedData();
    applyMasks();
    // Valida step inicial
    validateStep(1);
});