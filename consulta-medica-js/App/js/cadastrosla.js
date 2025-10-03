document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('cadastroForm');
    const steps = document.querySelectorAll('.form-step');
    const progressSteps = document.querySelectorAll('.progress-step');
    const nextButtons = document.querySelectorAll('.btn-next');
    const prevButtons = document.querySelectorAll('.btn-prev');
    
    let currentStep = 1;
    
    // Função para atualizar a etapa atual
    function updateStep(step) {
        // Esconde todas as etapas
        steps.forEach(s => s.classList.remove('active'));
        // Mostra a etapa atual
        document.getElementById(`step-${step}`).classList.add('active');
        
        // Atualiza o indicador de progresso
        progressSteps.forEach((progressStep, index) => {
            if (index + 1 < step) {
                progressStep.classList.add('completed');
                progressStep.classList.remove('active');
            } else if (index + 1 === step) {
                progressStep.classList.add('active');
                progressStep.classList.remove('completed');
            } else {
                progressStep.classList.remove('active', 'completed');
            }
        });
        
        currentStep = step;
    }
    
    // Eventos dos botões "Próximo"
    nextButtons.forEach(button => {
        button.addEventListener('click', function() {
            const nextStep = parseInt(this.getAttribute('data-next'));
            if (validateStep(currentStep)) {
                updateStep(nextStep);
            }
        });
    });
    
    // Eventos dos botões "Voltar"
    prevButtons.forEach(button => {
        button.addEventListener('click', function() {
            const prevStep = parseInt(this.getAttribute('data-prev'));
            updateStep(prevStep);
        });
    });
    
    // Validação de cada etapa
    function validateStep(step) {
        const currentStepElement = document.getElementById(`step-${step}`);
        const inputs = currentStepElement.querySelectorAll('input[required], select[required]');
        let isValid = true;
        
        inputs.forEach(input => {
            if (!input.value.trim()) {
                input.style.borderColor = '#dc2626';
                isValid = false;
            } else {
                input.style.borderColor = '';
            }
            
            // Validação específica para CPF
            if (input.id === 'CPF' && input.value) {
                if (!validateCPF(input.value)) {
                    input.style.borderColor = '#dc2626';
                    isValid = false;
                    alert('Por favor, insira um CPF válido.');
                }
            }
            
            // Validação de senha
            if (input.id === 'confirmar_senha' && input.value) {
                const senha = document.getElementById('senha').value;
                if (input.value !== senha) {
                    input.style.borderColor = '#dc2626';
                    isValid = false;
                    alert('As senhas não coincidem.');
                }
            }
        });
        
        return isValid;
    }
    
    // Validação simples de CPF (apenas formato)
    function validateCPF(cpf) {
        cpf = cpf.replace(/[^\d]/g, '');
        return cpf.length === 11;
    }
    
    // Máscara para CPF
    const cpfInput = document.getElementById('CPF');
    if (cpfInput) {
        cpfInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 11) {
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                e.target.value = value;
            }
        });
    }
    
    // Máscara para telefone
    const telefoneInput = document.getElementById('telefone');
    if (telefoneInput) {
        telefoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 11) {
                value = value.replace(/(\d{2})(\d)/, '($1) $2');
                value = value.replace(/(\d{5})(\d)/, '$1-$2');
                e.target.value = value;
            }
        });
    }
    
    // Buscar endereço pelo CEP
    const cepInput = document.getElementById('cep');
    if (cepInput) {
        cepInput.addEventListener('blur', function() {
            const cep = this.value.replace(/\D/g, '');
            if (cep.length === 8) {
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(response => response.json())
                    .then(data => {
                        if (!data.erro) {
                            document.getElementById('endereco').value = data.logradouro;
                            document.getElementById('cidade').value = data.localidade;
                            document.getElementById('estado').value = data.uf;
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao buscar CEP:', error);
                    });
            }
        });
    }
});