// Variáveis globais
let especialidadeSelecionada = null;
let medicoSelecionado = null;
let horarioSelecionado = null;
let dataSelecionada = null;

// Lista de médicos
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

// Lista de horários
const horarios = [
  '08:00', '09:00', '10:00', '11:00', '13:00', '14:00', '15:00', '16:00'
];

// Inicialização quando o DOM estiver carregado
document.addEventListener("DOMContentLoaded", () => {
  inicializarEventos();
  definirDataMinima();
});

// Variável global para guardar a especialidade
{
  let especialidadeSelecionada = null;
}
// Função para inicializar todos os eventos
function inicializarEventos() {
  const cards = document.querySelectorAll(".especialidade-card");
  const btnNext1 = document.getElementById("btnNext1");

  if (!cards.length || !btnNext1) {
    console.warn("Cards ou botão não encontrados no DOM.");
    return;
  }

  cards.forEach(card => {
    card.addEventListener("click", () => {
      // Remove seleção anterior
      cards.forEach(c => c.classList.remove("selected"));

      // Adiciona seleção atual
      card.classList.add("selected");

      // Atualiza variável global
      especialidadeSelecionada = card.dataset.value;

      // Habilita botão próximo
      btnNext1.disabled = false;

      console.log("Especialidade selecionada:", especialidadeSelecionada);
    });
  });
}

// Executa quando a página terminar de carregar
document.addEventListener("DOMContentLoaded", inicializarEventos);

// Função para definir data mínima (amanhã)
function definirDataMinima() {
  const inputData = document.getElementById("data");
  const amanha = new Date();
  amanha.setDate(amanha.getDate() + 1);
  const dataFormatada = amanha.toISOString().split('T')[0];
  inputData.min = dataFormatada;
}

// Função para carregar médicos (step 2)
function carregarMedicos(especialidade) {
  const container = document.getElementById("cardsMedicos");
  container.innerHTML = "";

  console.log("Carregando médicos para:", especialidade);

  if (medicos[especialidade]) {
    medicos[especialidade].forEach(medico => {
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
        // Remove seleção anterior
        document.querySelectorAll(".medico-card").forEach(c => c.classList.remove("selected"));
        // Adiciona seleção atual
        card.classList.add("selected");
        // Atualiza variável global
        medicoSelecionado = medico;
        // Habilita botão próximo
        document.getElementById("btnNext2").disabled = false;

        console.log("Médico selecionado:", medico);
      });

      container.appendChild(card);
    });
  } else {
    container.innerHTML = '<p>Nenhum médico encontrado para esta especialidade.</p>';
  }
}

// Função para carregar horários (step 3)
function carregarHorarios() {
  const inputData = document.getElementById("data");
  const container = document.getElementById("cardsHorarios");
  const msgHorarios = document.getElementById("msgHorarios");

  dataSelecionada = inputData.value;

  if (!dataSelecionada) {
    container.innerHTML = '<p id="msgHorarios">Selecione uma data para ver os horários.</p>';
    return;
  }

  // Remove mensagem inicial
  if (msgHorarios) {
    msgHorarios.remove();
  }

  container.innerHTML = "";

  horarios.forEach(hora => {
    const card = document.createElement("div");
    card.classList.add("horario-card", "card");
    card.dataset.hora = hora;
    card.innerHTML = `<i class="fas fa-clock"></i> ${hora}`;

    card.addEventListener("click", () => {
      // Remove seleção anterior
      document.querySelectorAll(".horario-card").forEach(c => c.classList.remove("selected"));
      // Adiciona seleção atual
      card.classList.add("selected");
      // Atualiza variável global
      horarioSelecionado = hora;
      // Habilita botão próximo
      document.getElementById("btnNext3").disabled = false;

      console.log("Horário selecionado:", hora);
    });

    container.appendChild(card);
  });
}

// Função para atualizar stepper visual
function atualizarStepper(stepAtual) {
  const steps = document.querySelectorAll(".step");

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

// Navegação entre steps
function nextStep(step) {
  if (!validateStep(step)) {
    return;
  }

  const proximoStep = step + 1;

  // Esconder step atual
  document.querySelectorAll(".step-content").forEach(el => el.classList.remove("active"));

  // Mostrar próximo step
  const proximoStepElement = document.querySelector(`.step-content[data-step="${proximoStep}"]`);
  if (proximoStepElement) {
    proximoStepElement.classList.add("active");
  }

  // Atualizar stepper visual
  atualizarStepper(proximoStep);

  // Ações específicas para cada step
  if (step === 1) {
    carregarMedicos(especialidadeSelecionada);
  }

  console.log(`Avançando do step ${step} para ${proximoStep}`);
}

function prevStep(step) {
  const stepAnterior = step - 1;

  // Esconder step atual
  document.querySelectorAll(".step-content").forEach(el => el.classList.remove("active"));

  // Mostrar step anterior
  const stepAnteriorElement = document.querySelector(`.step-content[data-step="${stepAnterior}"]`);
  if (stepAnteriorElement) {
    stepAnteriorElement.classList.add("active");
  }

  // Atualizar stepper visual
  atualizarStepper(stepAnterior);

  console.log(`Voltando do step ${step} para ${stepAnterior}`);
}

// Validações de cada step
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
      if (!dataSelecionada || !horarioSelecionado) {
        alert("Por favor, selecione uma data e horário.");
        return false;
      }
      break;

    case 4:
      const nome = document.getElementById("nome").value.trim();
      const email = document.getElementById("email").value.trim();
      const telefone = document.getElementById("telefone").value.trim();
      const cpf = document.getElementById("cpf").value.trim();

      if (!nome || nome.length < 2) {
        alert("Por favor, preencha o nome completo.");
        return false;
      }

      if (!email || !email.includes("@") || !email.includes(".")) {
        alert("Por favor, preencha um e-mail válido.");
        return false;
      }

      if (!telefone || telefone.length < 14) {
        alert("Por favor, preencha o telefone completo.");
        return false;
      }

      if (!cpf || cpf.length < 14) {
        alert("Por favor, preencha o CPF completo.");
        return false;
      }
      break;
  }

  return true;
}

// Máscara para telefone
function aplicarMascaraTelefone(input) {
  let valor = input.value.replace(/\D/g, '');

  if (valor.length <= 11) {
    if (valor.length <= 2) {
      valor = valor.replace(/(\d{0,2})/, '($1');
    } else if (valor.length <= 6) {
      valor = valor.replace(/(\d{2})(\d{0,4})/, '($1) $2');
    } else if (valor.length <= 10) {
      valor = valor.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3');
    } else {
      valor = valor.replace(/(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3');
    }
  }

  input.value = valor;
}

// Máscara para CPF
function aplicarMascaraCPF(input) {
  let valor = input.value.replace(/\D/g, '');

  if (valor.length <= 11) {
    valor = valor.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
  }

  input.value = valor;
}

// Função para finalizar agendamento
function finalizarAgendamento(event) {
  event.preventDefault();

  if (!validateStep(4)) {
    return;
  }

  const agendamento = {
    especialidade: especialidadeSelecionada,
    especialidadeNome: document.querySelector(`[data-value="${especialidadeSelecionada}"] span`).textContent,
    medico: medicoSelecionado,
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

  alert(`Consulta agendada com sucesso!
  
Especialidade: ${agendamento.especialidadeNome}
Médico: ${agendamento.medico.nome}
Data: ${agendamento.data}
Horário: ${agendamento.horario}
Paciente: ${agendamento.dadosPessoais.nome}

Você receberá uma confirmação por e-mail.`);

  // Aqui você pode enviar os dados para um servidor
  // Por exemplo: enviarParaServidor(agendamento);
}