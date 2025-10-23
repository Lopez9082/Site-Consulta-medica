<div class="container mt-4">
    <h2 style="text-align:center; margin-bottom: 20px; color:#2c3e50; border-bottom: 2px solid #1abc9c; padding-bottom:10px;">
        Ficha do Paciente: <?= $paciente->Nome_Pac ?>
    </h2>

    <div style="display:flex; flex-wrap:wrap; gap:20px; margin-bottom:30px;">
        <div style="flex:1; min-width:250px; background:#fff; padding:20px; border-radius:8px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">
            <h4 style="border-bottom:1px solid #1abc9c; padding-bottom:5px; margin-bottom:15px;">Informações Pessoais</h4>
            <p><strong>Nome:</strong> <?= $paciente->Nome_Pac ?></p>
            <p><strong>Data de Nascimento:</strong> <?= $paciente->Data_Nas ?></p>
            <p><strong>CPF:</strong> <?= $paciente->Cpf_cnpj ?></p>
            <p><strong>Email:</strong> <?= $paciente->Email_Pac ?></p>
            <p><strong>Telefone:</strong> <?= $paciente->Telefone ?></p>
            <p><strong>Endereço:</strong> <?= $paciente->Endereco_Pac ?></p>
        </div>
    </div>

    <h4 style="margin-bottom:15px; color:#2c3e50; border-bottom:2px solid #1abc9c; padding-bottom:5px;">Consultas do Paciente</h4>

    <?php if (!empty($consultas)): ?>
        <table style="width:100%; border-collapse:collapse; background:#fff; border-radius:8px; overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,0.1);">
            <thead>
                <tr style="background:#1abc9c; color:#fff; text-align:left;">
                    <th style="padding:12px;">Data</th>
                    <th style="padding:12px;">Horário</th>
                    <th style="padding:12px;">Médico</th>
                    <th style="padding:12px;">Observações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($consultas as $c): ?>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;"><?= date('d/m/Y', strtotime($c->Data_Consulta)) ?></td>
                    <td style="padding:10px;"><?= $c->Horario ?></td>
                    <td style="padding:10px;"><?= $c->Nome_Med ?></td>
                    <td style="padding:10px;"><?= $c->Observacoes ?? '-' ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="background:#fff; padding:15px; border-radius:8px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">Não há consultas cadastradas para este paciente.</p>
    <?php endif; ?>

    <div style="margin-top:20px;">
        <a href="<?= site_url('medico/pacientes') ?>" style="padding:10px 20px; background:#1abc9c; color:#fff; border-radius:5px; text-decoration:none;">Voltar</a>
    </div>
</div>
