<style>
    #lista_pacientes {
    border: 1px solid #1abc9c;
    border-radius: 6px;
    background-color: #fff;
}

#lista_pacientes li:hover {
    background-color: #16a085;
    color: #fff;
}

</style>
<div class="container mt-4">
    <h3 class="text-center mb-3">Agenda do Dr. <?= $medico->Nome_Med ?? $medico->Nome ?></h3>

    <!-- CARD PRINCIPAL -->
    <div class="card p-4 mb-4">
        <form method="post" action="<?= site_url('balcao/agendar_consulta') ?>">
            <input type="hidden" name="Id_Medico" value="<?= $medico->Id ?>">
            <input type="hidden" id="Data_Consulta" name="Data_Consulta">
            <input type="hidden" id="Hora_Consulta" name="Hora_Consulta">

            <!-- SELEÇÃO DE DIA -->
            <h4>Selecione o dia:</h4>
            <div style="display:flex; gap:10px; flex-wrap: wrap;">
                <?php foreach ($dias_mes as $dia): ?>
                    <button type="button"
                            class="btn btn-outline-success btn-sm selecionar-dia"
                            data-dia="<?= $dia['data'] ?>">
                        <?= date('d/m', strtotime($dia['data'])) ?> (<?= $dia['dia_semana'] ?>)
                    </button>
                <?php endforeach; ?>
            </div>

            <!-- SELEÇÃO DE HORÁRIOS -->
            <h4 class="mt-4">Horários disponíveis:</h4>
<div id="horarios" style="display:flex; gap:10px; flex-wrap: wrap;">
    <!-- Os horários vão ser atualizados via JS ao selecionar o dia -->
</div>


            <hr>
            <p class="text-center">
                <strong>Dias de Trabalho:</strong> <?= $medico->Dias_Semana ?>
            </p>

            <!-- SELEÇÃO DE PACIENTE COM PESQUISA -->
<h4 class="mt-4">Selecionar Paciente</h4>
<div class="mb-3 position-relative" style="max-width:500px;">
    <input type="text" id="pesquisa_paciente" class="form-control" placeholder="Digite nome, ID ou data de nascimento (dd/mm/aaaa)">
    <ul id="lista_pacientes" class="list-group position-absolute w-100" style="z-index:1000; max-height:200px; overflow-y:auto; display:none;"></ul>
</div>
<input type="hidden" name="Id_Paciente" id="Id_Paciente">



            <button type="submit" class="btn btn-success w-100 mt-4">Confirmar Consulta</button>
        </form>
    </div>

    <!-- ORDENANDO AGENDA DO MÉDICO -->
    <?php
    if (!empty($agenda)) {
        usort($agenda, function($a, $b) {
            return strtotime($b->Data_Consulta . ' ' . ($b->Horario ?? '00:00')) - strtotime($a->Data_Consulta . ' ' . ($a->Horario ?? '00:00'));
        });
    }
    ?>

    <!-- TABELA DE CONSULTAS -->
    <h5 class="mb-3">Consultas Agendadas:</h5>
    <?php if (!empty($agenda)): ?>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Data</th>
                    <th>Horário</th>
                    <th>Paciente</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($agenda as $item): ?>
                    <tr>
                        <td><?= date('d/m/Y', strtotime($item->Data_Consulta)) ?></td>
                        <td><?= $item->Horario ?: '-' ?></td>
                        <td><?= $item->Nome_Pac ?: '-' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info text-center">
            Nenhuma consulta agendada.
        </div>
    <?php endif; ?>
</div>

<!-- SCRIPT: SELEÇÃO DE DIA E HORÁRIO -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const botoesDia = document.querySelectorAll('.selecionar-dia');
    const campoData = document.getElementById('Data_Consulta');
    const campoHora = document.getElementById('Hora_Consulta');
    const divHorarios = document.getElementById('horarios');

    // Horários disponíveis por dia (passa do PHP para JS)
    const horariosPorDia = <?= json_encode($horarios_por_dia) ?>;

    botoesDia.forEach(botao => {
        botao.addEventListener('click', () => {
            // Marca botão selecionado
            botoesDia.forEach(b => b.classList.remove('btn-success'));
            botao.classList.add('btn-success');
            campoData.value = botao.dataset.dia;

            // Limpa horários antigos
            divHorarios.innerHTML = '';

            const horarios = horariosPorDia[botao.dataset.dia] || [];
            if (horarios.length === 0) {
                divHorarios.innerHTML = '<div class="alert alert-warning">Nenhum horário disponível neste dia.</div>';
                campoHora.value = '';
                return;
            }

            // Cria botões de horários disponíveis
            horarios.forEach(hora => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'btn btn-outline-primary btn-sm';
                btn.dataset.hora = hora;
                btn.textContent = hora;

                btn.addEventListener('click', () => {
                    // Marca horário selecionado
                    divHorarios.querySelectorAll('button').forEach(b => b.classList.remove('btn-primary'));
                    btn.classList.add('btn-primary');
                    campoHora.value = hora;
                });

                divHorarios.appendChild(btn);
            });
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const campoPesquisa = document.getElementById('pesquisa_paciente');
    const listaPacientes = document.getElementById('lista_pacientes');
    const inputIdPaciente = document.getElementById('Id_Paciente');

    // Array de pacientes do PHP para JS
    const pacientes = <?= json_encode(array_map(function($pac) {
        return [
            'id' => $pac->Id,
            'nome' => $pac->Nome_Pac ?? $pac->Nome,
            'nascimento' => isset($pac->Data_Nas) ? date('d/m/Y', strtotime($pac->Data_Nas)) : ''
        ];
    }, $pacientes)) ?>;

    // Função para filtrar pacientes
    campoPesquisa.addEventListener('input', () => {
        const termo = campoPesquisa.value.toLowerCase().trim();
        listaPacientes.innerHTML = '';
        if (!termo) {
            listaPacientes.style.display = 'none';
            inputIdPaciente.value = '';
            return;
        }

        const resultados = pacientes.filter(p => 
            p.nome.toLowerCase().includes(termo) ||
            p.id.toString().includes(termo) ||
            p.nascimento.includes(termo)
        );

        if (resultados.length === 0) {
            listaPacientes.innerHTML = '<li class="list-group-item">Nenhum paciente encontrado</li>';
        } else {
            resultados.forEach(p => {
                const li = document.createElement('li');
                li.className = 'list-group-item list-group-item-action';
                li.style.cursor = 'pointer';
                li.textContent = `${p.id} - ${p.nome} (${p.nascimento || "Sem Data"})`;
                li.addEventListener('click', () => {
                    campoPesquisa.value = `${p.nome} (${p.nascimento || "Sem Data"})`;
                    inputIdPaciente.value = p.id;
                    listaPacientes.style.display = 'none';
                });
                listaPacientes.appendChild(li);
            });
        }

        listaPacientes.style.display = 'block';
    });

    // Fecha a lista ao clicar fora
    document.addEventListener('click', e => {
        if (!campoPesquisa.contains(e.target) && !listaPacientes.contains(e.target)) {
            listaPacientes.style.display = 'none';
        }
    });
});

</script>


