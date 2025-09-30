// Variáveis globais
let especialidadeSelecionada = null;
let medicoSelecionado = null;
let horarioSelecionado = null;

// Função para inicializar seleção das especialidades
function inicializarEventos() {
    const cardsEspecialidade = document.querySelectorAll(".especialidade-card");
    const btnNext1 = document.getElementById("btnNext1");

    if (!cardsEspecialidade.length || !btnNext1) return;

    cardsEspecialidade.forEach(card => {
        card.addEventListener("click", () => {
            // Remove seleção anterior
            cardsEspecialidade.forEach(c => c.classList.remove("selected"));

            // Marca a atual
            card.classList.add("selected");

            // Atualiza variável global com data-value
            especialidadeSelecionada = card.dataset.value;

            // Habilita botão
            btnNext1.disabled = false;

            console.log("Especialidade selecionada:", especialidadeSelecionada);
        });
    });
}

// Função para inicializar seleção dos médicos
function inicializarMedicos() {
    const cardsMedico = document.querySelectorAll(".medico-card");
    const btnNext2 = document.getElementById("btnNext2");

    if (!cardsMedico.length || !btnNext2) return;

    cardsMedico.forEach(card => {
        card.addEventListener("click", () => {
            cardsMedico.forEach(c => c.classList.remove("selected"));
            card.classList.add("selected");

            medicoSelecionado = card.dataset.id;
            btnNext2.disabled = false;

            console.log("Médico selecionado:", medicoSelecionado);
        });
    });
}

// Função para inicializar seleção de horários
function inicializarHorarios() {
    const cardsHorario = document.querySelectorAll(".horario-card");
    const btnFinalizar = document.getElementById("btnFinalizar");

    if (!cardsHorario.length || !btnFinalizar) return;

    cardsHorario.forEach(card => {
        card.addEventListener("click", () => {
            cardsHorario.forEach(c => c.classList.remove("selected"));
            card.classList.add("selected");

            horarioSelecionado = card.dataset.hora;
            btnFinalizar.disabled = false;

            console.log("Horário selecionado:", horarioSelecionado);
        });
    });
}

// Função para enviar os dados do agendamento
function enviarAgendamento() {
    const nome = document.getElementById("nome").value;
    const email = document.getElementById("email").value;
    const cpf = document.getElementById("cpf").value;

    const especialidade = document.querySelector('.especialidade-card.selected')
        ? document.querySelector('.especialidade-card.selected').dataset.value
        : 'N/A';

    const medico = document.querySelector('.medico-card.selected')
        ? document.querySelector('.medico-card.selected').dataset.id
        : 'N/A';

    const horaConsulta = document.querySelector('.horario-card.selected')
        ? document.querySelector('.horario-card.selected').dataset.hora
        : 'N/A';

    const dados = {
        nome,
        email,
        cpf,
        especialidade,
        medico,
        horaConsulta
    };

    console.log("Dados do agendamento:", dados);
    alert("Agendamento concluído com sucesso!");
}

// Inicializar tudo quando a página carregar
document.addEventListener("DOMContentLoaded", () => {
    inicializarEventos();
    inicializarMedicos();
    inicializarHorarios();

    const btnFinalizar = document.getElementById("btnFinalizar");
    if (btnFinalizar) {
        btnFinalizar.addEventListener("click", enviarAgendamento);
    }
});
