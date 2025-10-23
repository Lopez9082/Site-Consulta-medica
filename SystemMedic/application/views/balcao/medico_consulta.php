<h2>Escolha um Médico</h2>
<div style="display:flex; flex-wrap:wrap; gap:15px;">
    <?php foreach($medicos as $m): ?>
    <div style="width:200px; padding:15px; background:#fff; border-radius:8px; box-shadow:0 4px 10px rgba(0,0,0,0.1); text-align:center;">
        <h3><?= $m->Nome ?></h3>
        <p><?= $m->Especialidade ?></p>
        <a href="<?= site_url('balcao/agenda_medico/'.$m->Id) ?>" style="display:inline-block; margin-top:10px; padding:5px 10px; background:#1abc9c; color:#fff; border-radius:5px; text-decoration:none;">Ver Agenda</a>
    </div>
    <?php endforeach; ?>
</div>
