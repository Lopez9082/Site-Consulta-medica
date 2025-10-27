<div class="consultas-container">
    <h2>Minhas Consultas</h2>

    <?php if ($this->session->flashdata('sucesso')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('sucesso') ?></div>
    <?php endif; ?>

    <div class="consultas-section">
        <h3><i class="fa fa-calendar-check"></i> Consultas Futuras</h3>

        <?php if (!empty($consultas_futuras)): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Horário</th>
                        <th>Médico</th>
                        <th>Especialidade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($consultas_futuras as $c): ?>
                        <tr>
                            <td><?= date('d/m/Y', strtotime($c->Data_Consulta)) ?></td>
                            <td><?= $c->Horario ?></td>
                            <td><?= $c->Nome_Med ?></td>
                            <td><?= $c->Especialidade ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="sem-consultas">Você não possui consultas futuras agendadas.</p>
        <?php endif; ?>
    </div>

    <div class="consultas-section">
        <h3><i class="fa fa-history"></i> Consultas Passadas</h3>

        <?php if (!empty($consultas_passadas)): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Horário</th>
                        <th>Médico</th>
                        <th>Especialidade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($consultas_passadas as $c): ?>
                        <tr>
                            <td><?= date('d/m/Y', strtotime($c->Data_Consulta)) ?></td>
                            <td><?= $c->Horario ?></td>
                            <td><?= $c->Nome_Med ?></td>
                            <td><?= $c->Especialidade ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="sem-consultas">Você ainda não possui consultas anteriores.</p>
        <?php endif; ?>
    </div>
</div>

<style>
    .consultas-container {
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 3px 8px rgba(0,0,0,0.1);
    }
    h2 {
        color: #2c3e50;
        margin-bottom: 20px;
        text-align: center;
    }
    .consultas-section {
        margin-top: 30px;
    }
    h3 {
        color: #16a085;
        border-bottom: 2px solid #16a085;
        padding-bottom: 5px;
        margin-bottom: 15px;
    }
    .table {
        width: 100%;
        border-collapse: collapse;
        background: #f9f9f9;
    }
    .table th, .table td {
        padding: 12px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }
    .table th {
        background: #2c3e50;
        color: #fff;
    }
    .table tr:hover {
        background: #ecf0f1;
    }
    .sem-consultas {
        color: #7f8c8d;
        text-align: center;
        font-style: italic;
        padding: 10px 0;
    }
    .alert {
        padding: 10px;
        background: #2ecc71;
        color: white;
        border-radius: 5px;
        margin-bottom: 15px;
        text-align: center;
    }
</style>
