<h2 style="margin-bottom: 20px; color: #2c3e50; border-bottom: 2px solid #1abc9c; padding-bottom: 10px; text-align:center;">Meus Pacientes</h2>

<!-- Seletor de mês e ano centralizado -->
<form method="GET" style="margin-bottom: 25px; display: flex; justify-content: center; align-items: center; gap: 15px;">
    <div>
        <label for="mes" style="font-weight:bold;">Mês:</label>
        <select name="mes" id="mes" style="
            padding: 6px 10px; 
            border-radius: 5px; 
            border: 1px solid #ccc;
            background-color:#f9f9f9;
            font-size: 16px;
        ">
            <?php foreach($meses as $num => $nome): 
                $sel = ($num == $mes) ? 'selected' : '';
            ?>
                <option value="<?= $num ?>" <?= $sel ?>><?= $nome ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label for="ano" style="font-weight:bold;">Ano:</label>
        <select name="ano" id="ano" style="
            padding: 6px 10px; 
            border-radius: 5px; 
            border: 1px solid #ccc;
            background-color:#f9f9f9;
            font-size: 16px;
        ">
            <?php foreach($anos as $a):
                $sel = ($a == $ano) ? 'selected' : '';
            ?>
                <option value="<?= $a ?>" <?= $sel ?>><?= $a ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" style="
        padding: 8px 15px; 
        background-color: #1abc9c; 
        color: #fff; 
        border: none; 
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    " onmouseover="this.style.backgroundColor='#16a085'" onmouseout="this.style.backgroundColor='#1abc9c'">
        Ir
    </button>
</form>

<!-- Calendário de dias -->
<div style="margin-bottom: 20px; display: flex; flex-wrap: wrap; justify-content: center; gap: 5px;">
    <?php foreach($dias_mes as $d): 
        $selected = ($d == $dia_selecionado) ? '#1abc9c' : '#f1f1f1';
        $color_text = ($d == $dia_selecionado) ? '#fff' : '#2c3e50';
    ?>
        <a href="<?= site_url('medico/pacientes?dia='.$d.'&mes='.$mes.'&ano='.$ano) ?>" style="
            padding: 8px 12px;
            background-color: <?= $selected ?>;
            color: <?= $color_text ?>;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.2s;
        " onmouseover="this.style.backgroundColor='#16a085'; this.style.color='#fff'" 
           onmouseout="this.style.backgroundColor='<?= $selected ?>'; this.style.color='<?= $color_text ?>'">
           <?= date('d', strtotime($d)) ?>
        </a>
    <?php endforeach; ?>
</div>

<!-- Lista de pacientes (igual à versão anterior) -->
<?php if (!empty($pacientes)): ?>
<table style="
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
">
    <thead>
        <tr style="background-color: #1abc9c; color: #fff; text-align: left;">
            <th style="padding: 12px;">Nome</th>
            <th style="padding: 12px;">Data de Nascimento</th>
            <th style="padding: 12px;">CPF</th>
            <th style="padding: 12px;">Email</th>
            <th style="padding: 12px;">Telefone</th>
            <th style="padding: 12px;">Horário</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pacientes as $p): ?>
        <tr style="border-bottom: 1px solid #ddd; cursor: pointer;" 
    onclick="window.location='<?= site_url('medico/ficha_paciente/'.$p->Id) ?>'">
    <td style="padding: 10px;"><?= $p->Nome_Pac ?></td>
    <td style="padding: 10px;"><?= $p->Data_Nas ?></td>
    <td style="padding: 10px;"><?= $p->Cpf_cnpj ?></td>
    <td style="padding: 10px;"><?= $p->Email_Pac ?></td>
    <td style="padding: 10px;"><?= $p->Telefone ?></td>
    <td style="padding: 10px;"><?= $p->Horario ?></td>
</tr>

        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p style="background-color: #fff; padding: 15px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">Não há pacientes agendados para este dia.</p>
<?php endif; ?>

