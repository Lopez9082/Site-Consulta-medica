<div style="padding: 30px; font-family: Arial, sans-serif; color: #2c3e50;">

    <h2 style="margin-bottom: 20px; border-bottom: 2px solid #1abc9c; padding-bottom: 10px;">Meu Perfil</h2>

    <!-- Mensagens --------------------------->
    <?php if ($this->session->flashdata('msg')): ?>
        <div style="color: green; margin-bottom: 15px;"><?= $this->session->flashdata('msg') ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('erro')): ?>
        <div style="color: red; margin-bottom: 15px;"><?= $this->session->flashdata('erro') ?></div>
    <?php endif; ?>

    <div style="display: flex; gap: 30px; flex-wrap: wrap;">

        <!-- Informações Pessoais ---------------->
        <div style="flex: 1; min-width: 280px; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
            <h3 style="margin-bottom: 15px; color:#1abc9c;">Informações Pessoais</h3>
            <p><strong>Nome:</strong> <?= $this->session->userdata('usuario')->Nome_Med ?></p>
            <p><strong>Email:</strong> <?= $this->session->userdata('usuario')->Email_Med ?></p>
            <p><strong>CRM:</strong> <?= $this->session->userdata('usuario')->CRM ?></p>
            <p><strong>Especialidade:</strong> <?= $this->session->userdata('usuario')->Especialidade ?></p>
        </div>

        
        <!-- Agenda ------------------>
        <div style="flex: 1; min-width: 280px; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
            <h3 style="margin-bottom: 15px; color:#1abc9c;">Configurar Agenda</h3>

            <form action="<?= site_url('medico/salvar_perfil') ?>" method="POST">

                <!-- Dias da Semana -->
                <p><strong>Dias da Semana:</strong></p>
                <?php
                $dias = ['Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'];
                $selecionados = explode(',', $this->session->userdata('usuario')->Dias_Semana ?? '');
                foreach($dias as $dia): ?>
                    <label style="display: inline-block; margin-right:10px; margin-bottom:5px;">
                        <input type="checkbox" name="Dias_Semana[]" value="<?= $dia ?>" <?= in_array($dia, $selecionados) ? 'checked' : '' ?>> <?= $dia ?>
                    </label>
                <?php endforeach; ?>

                <p style="margin-top: 15px; font-style: italic; color: #555; font-size: 0.9em;">
                    Preencha **horário de atendimento** <strong>ou</strong> **quantidade de pacientes por dia**. Ambos são opcionais.
                </p>

                <!-- Horário de Atendimento -->
                <p><strong>Horário de Atendimento:</strong></p>
                <div style="display: flex; gap: 10px; align-items: center; margin-bottom: 15px;">
                    <input type="time" name="Hora_Inicio" id="hora_inicio" 
                        value="<?= $this->session->userdata('usuario')->Hora_Inicio ?? '' ?>" 
                        style="padding: 8px; flex: 1;" required>
                    <span>até</span>
                    <input type="time" name="Hora_Fim" id="hora_fim" 
                        value="<?= $this->session->userdata('usuario')->Hora_Fim ?? '' ?>" 
                        style="padding: 8px; flex: 1;" required>
                </div>

                <!-- Duração média -->
                <p><strong>Duração média de cada consulta (minutos):</strong></p>
                <input type="number" name="Duracao_Consulta" id="duracao_consulta" 
                    value="<?= $this->session->userdata('usuario')->Duracao_Consulta ?? 15 ?>" 
                    min="5" step="5"
                    style="width: 100%; padding: 8px; margin-bottom: 15px;">

                <!-- Visualização dos horários -->
                <div id="previsao_horarios" style="background: #f8f9fa; border: 1px solid #ddd; padding: 10px; border-radius: 6px;">
                    <em>Selecione horário e duração para ver os horários disponíveis...</em>
                </div>

                <button type="submit" 
                        style="background-color:#1abc9c; color:#fff; padding:10px 20px; border:none; border-radius:5px; font-weight:bold; margin-top:15px;">
                    Salvar Agenda
                </button>

            </form>
            
<script>
document.addEventListener('DOMContentLoaded', function() {
    const inicio = document.getElementById('hora_inicio');
    const fim = document.getElementById('hora_fim');
    const duracao = document.getElementById('duracao_consulta');
    const previsao = document.getElementById('previsao_horarios');

    function gerarHorarios() {
        const horaInicio = inicio.value;
        const horaFim = fim.value;
        const minutosConsulta = parseInt(duracao.value);

        if (!horaInicio || !horaFim || isNaN(minutosConsulta)) {
            previsao.innerHTML = '<em>Preencha os campos acima para ver os horários.</em>';
            return;
        }

        let [hInicio, mInicio] = horaInicio.split(':').map(Number);
        let [hFim, mFim] = horaFim.split(':').map(Number);

        const horarios = [];
        let inicioMin = hInicio * 60 + mInicio;
        const fimMin = hFim * 60 + mFim;

        while (inicioMin + minutosConsulta <= fimMin) {
            const h = String(Math.floor(inicioMin / 60)).padStart(2, '0');
            const m = String(inicioMin % 60).padStart(2, '0');
            horarios.push(`${h}:${m}`);
            inicioMin += minutosConsulta;
        }

        if (horarios.length === 0) {
            previsao.innerHTML = '<span style="color:red;">O intervalo selecionado é menor que a duração da consulta.</span>';
            return;
        }

        previsao.innerHTML = `
            <strong>Horários possíveis:</strong><br>
            ${horarios.map(h => `<span style="display:inline-block; margin:5px; padding:5px 10px; background:#e8f5e9; border-radius:4px;">${h}</span>`).join('')}
        `;
    }

    inicio.addEventListener('change', gerarHorarios);
    fim.addEventListener('change', gerarHorarios);
    duracao.addEventListener('change', gerarHorarios);
});
</script>

        </div>

    </div>

</div>
