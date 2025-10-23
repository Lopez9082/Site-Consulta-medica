<div class="container mt-4">
    <h3 style="color:#2c3e50; border-bottom:2px solid #1abc9c; padding-bottom:10px;">
        Perfil do Colaborador
    </h3>

    <?php if (!empty($colaborador)): ?>
    <form method="post" action="<?= site_url('balcao/salvar_edicao_colaborador/'.$colaborador->Id) ?>" 
          class="mt-3 p-4" 
          style="background:#fff; border-radius:8px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Nome</label>
                <input type="text" name="Nome" value="<?= $colaborador->Nome ?>" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Função</label>
                <input type="text" name="Funcao" value="<?= $colaborador->Funcao ?>" class="form-control" required>
            </div>
        </div>

        
        
        </div>

        <!-- Caso o colaborador tenha horário/agendamento -->
        <?php if(isset($colaborador->Dias_Semana) || isset($colaborador->Hora_Inicio)): ?>
        <h5 class="mt-4 mb-3" style="color:#1abc9c;">Agenda de Trabalho</h5>

        <?php 
            $dias = ['Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'];
            $selecionados = explode(',', $colaborador->Dias_Semana ?? '');
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
                <label>Horário de Trabalho</label>
                <div style="display:flex; gap:10px; align-items:center;">
                    <input type="time" name="Hora_Inicio" id="hora_inicio" 
                           value="<?= $colaborador->Hora_Inicio ?? '' ?>" class="form-control">
                    <span>até</span>
                    <input type="time" name="Hora_Fim" id="hora_fim" 
                           value="<?= $colaborador->Hora_Fim ?? '' ?>" class="form-control">
                </div>
            </div>
        </div>

        <div id="previsao_horarios" 
             style="margin-top:15px; background:#f8f9fa; border:1px solid #ddd; padding:10px; border-radius:6px;">
            <em>Selecione horário para ver os horários disponíveis...</em>
        </div>
        <?php endif; ?>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-success px-4">Salvar Alterações</button>
            <a href="<?= site_url('balcao/colaboradores') ?>" class="btn btn-secondary px-4">Voltar</a>
        </div>
    </form>
    <?php else: ?>
        <div class="alert alert-danger text-center">Colaborador não encontrado.</div>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inicio = document.getElementById('hora_inicio');
    const fim = document.getElementById('hora_fim');
    const previsao = document.getElementById('previsao_horarios');

    function gerarHorarios() {
        if(!inicio || !fim) return;

        const horaInicio = inicio.value;
        const horaFim = fim.value;
        if(!horaInicio || !horaFim) {
            previsao.innerHTML = '<em>Preencha os horários acima para visualizar.</em>';
            return;
        }

        let [hInicio, mInicio] = horaInicio.split(':').map(Number);
        let [hFim, mFim] = horaFim.split(':').map(Number);

        const horarios = [];
        let inicioMin = hInicio * 60 + mInicio;
        const fimMin = hFim * 60 + mFim;

        while(inicioMin < fimMin) {
            const h = String(Math.floor(inicioMin / 60)).padStart(2,'0');
            const m = String(inicioMin % 60).padStart(2,'0');
            horarios.push(`${h}:${m}`);
            inicioMin += 60; // intervalo 1h padrão
        }

        if(horarios.length === 0){
            previsao.innerHTML = '<span style="color:red;">O intervalo selecionado não possui horários disponíveis.</span>';
            return;
        }

        previsao.innerHTML = `<strong>Horários possíveis:</strong><br>` + 
            horarios.map(h => `<span style="display:inline-block; margin:5px; padding:5px 10px; background:#e8f5e9; border-radius:4px;">${h}</span>`).join('');
    }

    if(inicio && fim){
        inicio.addEventListener('change', gerarHorarios);
        fim.addEventListener('change', gerarHorarios);
        gerarHorarios();
    }
});
</script>
