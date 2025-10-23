<div class="container mt-4">
    <h3 style="color:#2c3e50; border-bottom:2px solid #1abc9c; padding-bottom:10px;">
        Perfil do Médico
    </h3>

    <form method="post" action="<?= site_url('balcao/salvar_edicao_medico/'.$medico->Id) ?>" 
          class="mt-3 p-4" 
          style="background:#fff; border-radius:8px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Nome</label>
                <input type="text" name="Nome_Med" value="<?= $medico->Nome_Med ?>" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>CRM</label>
                <input type="text" name="CRM" value="<?= $medico->CRM ?>" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Especialidade</label>
                <input type="text" name="Especialidade" value="<?= $medico->Especialidade ?>" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Email</label>
                <input type="email" name="Email_Med" value="<?= $medico->Email_Med ?>" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Telefone</label>
                <input type="text" name="Telefone" value="<?= $medico->Telefone ?>" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Celular</label>
                <input type="text" name="Celular" value="<?= $medico->Celular ?>" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-8">
                <label>Endereço</label>
                <input type="text" name="Endereco_Med" value="<?= $medico->Endereco_Med ?>" class="form-control">
            </div>
            <div class="col-md-2">
                <label>Município</label>
                <input type="text" name="Municipio" value="<?= $medico->Municipio ?>" class="form-control">
            </div>
            <div class="col-md-2">
                <label>UF</label>
                <input type="text" name="UF" value="<?= $medico->UF ?>" class="form-control">
            </div>
        </div>

        <!-- 🗓️ Agenda de Trabalho -->
        <h5 class="mt-4 mb-3" style="color:#1abc9c;">Agenda de Trabalho</h5>

        <?php 
            $dias = ['Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'];
            $selecionados = explode(',', $medico->Dias_Semana ?? '');
        ?>
        <p><strong>Dias da Semana:</strong></p>
        <?php foreach($dias as $dia): ?>
            <label style="display: inline-block; margin-right:10px;">
                <input type="checkbox" name="Dias_Semana[]" value="<?= $dia ?>" 
                    <?= in_array($dia, $selecionados) ? 'checked' : '' ?>> <?= $dia ?>
            </label>
        <?php endforeach; ?>

        <div class="row mt-3">
            <div class="col-md-6">
                <label>Horário de Atendimento</label>
                <div style="display:flex; gap:10px; align-items:center;">
                    <input type="time" name="Hora_Inicio" id="hora_inicio" 
                           value="<?= $medico->Hora_Inicio ?? '' ?>" class="form-control" required>
                    <span>até</span>
                    <input type="time" name="Hora_Fim" id="hora_fim" 
                           value="<?= $medico->Hora_Fim ?? '' ?>" class="form-control" required>
                </div>
            </div>
            <div class="col-md-6">
                <label>Duração da Consulta (min)</label>
                <input type="number" name="Duracao_Consulta" id="duracao_consulta" 
                       value="<?= $medico->Duracao_Consulta ?? 15 ?>" 
                       min="5" step="5" class="form-control">
            </div>
        </div>

        <div id="previsao_horarios" 
             style="margin-top:15px; background:#f8f9fa; border:1px solid #ddd; padding:10px; border-radius:6px;">
            <em>Selecione horário e duração para ver os horários disponíveis...</em>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-success px-4">Salvar Alterações</button>
            <a href="<?= site_url('balcao/medicos') ?>" class="btn btn-secondary px-4">Voltar</a>
        </div>
    </form>
</div>

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
            ${horarios.map(h => 
                `<span style="display:inline-block; margin:5px; padding:5px 10px; background:#e8f5e9; border-radius:4px;">${h}</span>`
            ).join('')}
        `;
    }

    inicio.addEventListener('change', gerarHorarios);
    fim.addEventListener('change', gerarHorarios);
    duracao.addEventListener('change', gerarHorarios);

    // Gera automaticamente se já existir horário
    gerarHorarios();
});
</script>
