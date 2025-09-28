// Variáveis globais para rastrear o estado do agendamento
let especialidadeSelecionada = null; 
let medicoSelecionado = null;
let horarioSelecionado = null;
let dataSelecionada = null;

// Dados de simulação
const medicos = {
    clinico: [
        { id: 1, nome: 'Dr. João Silva', inicial: 'JS', crm: 'CRM: 12345-SP' },
        { id: 2, nome: 'Dra. Ana Souza', inicial: 'AS', crm: 'CRM: 67890-SP' }
    ],
    pediatria: [
        { id: 3, nome: 'Dr. Pedro Almeida', inicial: 'PA', crm: 'CRM: 54321-SP' },
        { id: 4, nome: 'Dra. Maria Oliveira', inicial: 'MO', crm: 'CRM: 98765-SP' }
    ],
    dermatologia: [
        { id: 5, nome: 'Dr. Lucas Costa', inicial: 'LC', crm: 'CRM: 11223-SP' },
        { id: 6, nome: 'Dra. Fernanda Lima', inicial: 'FL', crm: 'CRM: 44556-SP' }
    ],
    cardiologia: [
        { id: 7, nome: 'Dr. Ricardo Martins', inicial: 'RM', crm: 'CRM: 77889-SP' },
        { id: 8, nome: 'Dra. Juliana Rocha', inicial: 'JR', crm: 'CRM: 99001-SP' }
    ],
    odontologia: [
        { id: 9, nome: 'Dr. Paulo Henrique', inicial: 'PH', crm: 'CRO: 1234-SP' },
        { id: 10, nome: 'Dra. Camila Barros', inicial: 'CB', crm: 'CRO: 5678-SP' }
    ],
    neurologia: [
        { id: 11, nome: 'Dra. Sofia Ramos', inicial: 'SR', crm: 'CRM: 10101-SP' },
        { id: 12, nome: 'Dr. Gabriel Torres', inicial: 'GT', crm: 'CRM: 20202-SP' }
    ]
};
const horarios = ['08:00', '09:00', '10:00', '11:00', '13:00', '14:00', '15:00', '16:00'];

// --- Funções Principais de Inicialização e Eventos ---

document.addEventListener("DOMContentLoaded", () => {
    inicializarEventos();
    definirDataMinima();
});

function inicializarEventos() {
    // Eventos para a Etapa 1: Seleção de Especialidade
    const cardsEspecialidade = document.querySelectorAll(".especialidade-card");
    const btnNext1 = document.getElementById("btnNext1");

    cardsEspecialidade.forEach(card => {
        card.addEventListener("click", () => {
            // 1. Remove seleção anterior
            cardsEspecialidade.forEach(c => c.classList.remove("selected"));

            // 2. Adiciona seleção atual
            card.classList.add("selected");

            // 3. Atualiza variável global (O PONTO MAIS IMPORTANTE)
            especialidadeSelecionada = card.dataset.value;

            // 4. Habilita o botão 'Próximo'
            if (btnNext1) {
                btnNext1.disabled = false;
            }
            console.log("Especialidade selecionada:", especialidadeSelecionada);
        });
    });

    // Evento para a Etapa 3: Seleção de Data
    const inputData = document.getElementById("data");
    if(inputData) {
        inputData.addEventListener('change', carregarHorarios);
    }
}

// --- Funções de Navegação entre Etapas ---

function nextStep(step) {
    if (!validateStep(step)) {
        return; // Impede o avanço se a validação falhar
    }

    const proximoStep = step + 1;

    // Esconder step atual
    document.querySelector(`.step-content[data-step="${step}"]`).classList.remove("active");

    // Mostrar próximo step
    const proximoStepElement = document.querySelector(`.step-content[data-step="${proximoStep}"]`);
    if (proximoStepElement) {
        proximoStepElement.classList.add("active");
    }

    // Atualizar stepper visual
    atualizarStepper(proximoStep);

    // Ações específicas (carregar dados)
    if (step === 1) {
        carregarMedicos(especialidadeSelecionada);
    }
    if (step === 2) {
         // Não precisa carregar horários aqui, pois o evento 'change' da data já faz isso.
    }
}

function prevStep(step) {
    const stepAnterior = step - 1;

    // Esconder step atual
    document.querySelector(`.step-content[data-step="${step}"]`).classList.remove("active");

    // Mostrar step anterior
    const stepAnteriorElement = document.querySelector(`.step-content[data-step="${stepAnterior}"]`);
    if (stepAnteriorElement) {
        stepAnteriorElement.classList.add("active");
    }

    // Atualizar stepper visual
    atualizarStepper(stepAnterior);
}

function atualizarStepper(stepAtual) {
    const steps = document.querySelectorAll(".stepper .step");

    steps.forEach((step, index) => {
        const stepNumber = index + 1;

        if (stepNumber < stepAtual) {
            step.classList.add("completed");
            step.classList.remove("active");
        } else if (stepNumber === stepAtual) {
            step.classList.add("active");
            step.classList.remove("completed");
        } else {
            step.classList.remove("active", "completed");
        }
    });
}

// --- Funções de Validação e Máscaras ---

function validateStep(step) {
    switch (step) {
        case 1:
            if (!especialidadeSelecionada) {
                alert("Por favor, selecione uma especialidade.");
                return false;
            }
            break;

        case 2:
            if (!medicoSelecionado) {
                alert("Por favor, selecione um médico.");
                return false;
            }
            break;

        case 3:
            // Garante que a data e o horário foram selecionados
            dataSelecionada = document.getElementById("data").value;
            if (!dataSelecionada || !horarioSelecionado) {
                alert("Por favor, selecione uma data e horário.");
                return false;
            }
            break;

        case 4:
            // Validações básicas (apenas checa se os campos requeridos estão preenchidos)
            if (!document.getElementById("nome").value.trim() ||
                !document.getElementById("email").value.trim() ||
                !document.getElementById("telefone").value.trim() ||
                !document.getElementById("cpf").value.trim()) {
                alert("Por favor, preencha todos os dados pessoais obrigatórios.");
                return false;
            }
            break;
    }

    return true;
}

// Funções Auxiliares

function carregarMedicos(especialidade) {
    const container = document.getElementById("cardsMedicos");
    if (!container) return;
    
    container.innerHTML = "";
    medicoSelecionado = null; // Reseta o médico ao mudar de especialidade
    document.getElementById("btnNext2").disabled = true;

    const lista = medicos[especialidade];
    if (lista && lista.length > 0) {
        lista.forEach(medico => {
            const card = document.createElement("div");
            card.classList.add("medico-card", "card");
            card.dataset.id = medico.id;
            card.innerHTML = `
                <div class="medico-inicial">${medico.inicial}</div>
                <div class="medico-info">
                    <h4>${medico.nome}</h4>
                    <p>${medico.crm}</p>
                </div>
            `;

            card.addEventListener("click", () => {
                document.querySelectorAll(".medico-card").forEach(c => c.classList.remove("selected"));
                card.classList.add("selected");
                medicoSelecionado = medico;
                document.getElementById("btnNext2").disabled = false;
                console.log("Médico selecionado:", medico.nome);
            });

            container.appendChild(card);
        });
    } else {
        container.innerHTML = '<p>Nenhum médico encontrado para esta especialidade.</p>';
    }
}

function carregarHorarios() {
    const inputData = document.getElementById("data");
    const container = document.getElementById("cardsHorarios");
    const btnNext3 = document.getElementById("btnNext3");
    
    if (!inputData || !container || !btnNext3) return;

    dataSelecionada = inputData.value;
    horarioSelecionado = null; // Reseta o horário ao mudar a data
    btnNext3.disabled = true;

    if (!dataSelecionada) {
        container.innerHTML = '<p id="msgHorarios">Selecione uma data para ver os horários.</p>';
        return;
    }

    container.innerHTML = ""; // Limpa horários anteriores
    
    // Simulação de horários disponíveis
    horarios.forEach(hora => {
        const card = document.createElement("div");
        card.classList.add("horario-card", "card");
        card.dataset.hora = hora;
        card.innerHTML = `<i class="fas fa-clock"></i> ${hora}`;

        card.addEventListener("click", () => {
            document.querySelectorAll(".horario-card").forEach(c => c.classList.remove("selected"));
            card.classList.add("selected");
            horarioSelecionado = hora;
            btnNext3.disabled = false;
            console.log("Horário selecionado:", hora);
        });

        container.appendChild(card);
    });
}

function definirDataMinima() {
    const inputData = document.getElementById("data");
    if (!inputData) return;
    const hoje = new Date();
    const dataFormatada = hoje.toISOString().split('T')[0];
    inputData.min = dataFormatada;
}

function aplicarMascaraTelefone(input) {
    let valor = input.value.replace(/\D/g, '');
    let formatado = '';

    if (valor.length > 0) {
        formatado = '(' + valor.substring(0, 2);
    }
    if (valor.length >= 3) {
        formatado += ') ' + valor.substring(2, 7);
    }
    if (valor.length >= 8) {
        formatado += '-' + valor.substring(7, 11);
    }
    input.value = formatado;
}

function aplicarMascaraCPF(input) {
    let valor = input.value.replace(/\D/g, '');
    let formatado = '';

    if (valor.length > 0) {
        formatado = valor.substring(0, 3);
    }
    if (valor.length >= 4) {
        formatado += '.' + valor.substring(3, 6);
    }
    if (valor.length >= 7) {
        formatado += '.' + valor.substring(6, 9);
    }
    if (valor.length >= 10) {
        formatado += '-' + valor.substring(9, 11);
    }
    input.value = formatado;
}

function finalizarAgendamento(event) {
    event.preventDefault();

    if (!validateStep(4)) {
        return;
    }

    // Lógica para obter o nome de exibição
    let especialidadeNomeDisplay = especialidadeSelecionada;
    const cardSelecionado = document.querySelector(`.especialidade-card.selected span`);
    if (cardSelecionado) {
         especialidadeNomeDisplay = cardSelecionado.textContent;
    }
    
    const agendamento = {
        especialidade: especialidadeNomeDisplay,
        medico: medicoSelecionado.nome,
        data: dataSelecionada,
        horario: horarioSelecionado,
        dadosPessoais: {
            nome: document.getElementById("nome").value.trim(),
            email: document.getElementById("email").value.trim(),
            telefone: document.getElementById("telefone").value.trim(),
            cpf: document.getElementById("cpf").value.trim(),
            endereco: document.getElementById("endereco").value.trim(),
            observacoes: document.getElementById("observacoes").value.trim()
        }
    };

    console.log("Agendamento finalizado:", agendamento);

    alert(`✅ Consulta agendada com sucesso!
 
Especialidade: ${agendamento.especialidade}
Médico: ${agendamento.medico}
Data: ${new Date(agendamento.data).toLocaleDateString('pt-BR')}
Horário: ${agendamento.horario}
Paciente: ${agendamento.dadosPessoais.nome}

Você receberá uma confirmação por e-mail.`);
function enviarAgendamento() {
    // 1. Coleta dos Dados Selecionados e Digitados
    const especialidade = document.querySelector('.card.selected[data-especialidade]') ? document.querySelector('.card.selected[data-especialidade]').dataset.especialidade : 'N/A';
    const medico = document.querySelector('.card.selected[data-medico]') ? document.querySelector('.card.selected[data-medico]').dataset.medico : 'N/A';
    const dataConsulta = document.querySelector('.card.selected[data-data]') ? document.querySelector('.card.selected[data-data]').dataset.data : 'N/A';
    const horaConsulta = document.querySelector('.card.selected[data-horario]') ? document.querySelector('.card.selected[data-horario]').dataset.horario : 'N/A';
    // Assumindo que você tem campos de input com os IDs 'nomeUser' e 'emailUser'
    const nomeUsuario = document.getElementById('nomeUser') ? document.getElementById('nomeUser').value : 'Cliente';
    const emailUsuario = document.getElementById('emailUser') ? document.getElementById('emailUser').value : '';

    if (!emailUsuario) {
        alert('Por favor, preencha seu email para confirmação.');
        return;
    }

    // 2. Preparação dos Dados para Envio
    const dados = {
        nome: nomeUsuario,
        email: emailUsuario,
        especialidade: especialidade,
        medico: medico,
        data: dataConsulta,
        hora: horaConsulta
    };

    // 3. Envio dos Dados via AJAX (Fetch API)
    fetch('enviar_email.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(dados),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Agendamento concluído! Um email de confirmação foi enviado.');
            // Opcional: Redirecionar para uma página de sucesso
            // window.location.href = 'sucesso.html';
        } else {
            alert('Erro ao confirmar agendamento: ' + data.message);
        }
    })
    .catch((error) => {
        console.error('Erro na comunicação com o servidor:', error);
        alert('Ocorreu um erro na comunicação. Tente novamente mais tarde.');
    });
}
}