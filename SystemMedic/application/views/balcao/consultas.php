<div class="container mt-4">
    <h3 class="text-center mb-4">Selecione um Médico</h3>

    <div class="row">
        <?php foreach ($medicos as $med): ?>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm p-3">
                    <h5><?= $med->Nome_Med ?></h5>
                    <p><strong>Especialidade:</strong> <?= $med->Especialidade ?></p>
                    <p><strong>Dias:</strong> <?= $med->Dias_Semana ?: 'Não definido' ?></p>
                    <a href="<?= site_url('balcao/agenda_medico/'.$med->Id) ?>" class="btn btn-primary w-100">Ver Agenda</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
