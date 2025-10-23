<div class="container mt-4">
    <h3 class="text-center mb-4">Pacientes Cadastrados</h3>

    <!-- Barra de pesquisa -->
    <div class="mb-3">
        <input type="text" id="pesquisaPaciente" class="form-control" placeholder="Pesquisar paciente...">
    </div>

    <?php if (!empty($pacientes)): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="tabelaPacientes">
                <thead class="table-dark">
                    <tr>
                        <th>Nome</th>
                        <th>Data de Nascimento</th>
                        <th>CPF/CNPJ</th>
                        <th>Telefone</th>
                        <th>Celular</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pacientes as $pac): ?>
                        <tr class="linha-paciente" 
                            data-id="<?= $pac->Cod_Pac ?>" 
                            style="cursor: pointer;">
                            <td><?= $pac->Nome_Pac ?? $pac->Nome ?></td>
                            <td><?= isset($pac->Data_Nas) ? date('d/m/Y', strtotime($pac->Data_Nas)) : '-' ?></td>
                            <td><?= $pac->Cpf_cnpj ?></td>
                            <td><?= $pac->Telefone ?></td>
                            <td><?= $pac->Celular ?></td>
                            <td><?= $pac->Email_Pac ?? $pac->Email ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center">Nenhum paciente cadastrado.</div>
    <?php endif; ?>

    <!-- Botão flutuante para cadastrar paciente -->
    <a href="<?= site_url('balcao/cadastrar_paciente') ?>" 
       class="btn btn-primary btn-lg rounded-circle"
       style="position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
        <i class="bi bi-plus"></i>
    </a>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Pesquisa dinâmica
    const pesquisa = document.getElementById('pesquisaPaciente');
    const tabela = document.getElementById('tabelaPacientes').getElementsByTagName('tbody')[0];

    pesquisa.addEventListener('keyup', function() {
        const termo = pesquisa.value.toLowerCase();
        Array.from(tabela.rows).forEach(row => {
            row.style.display = Array.from(row.cells).some(cell => 
                cell.textContent.toLowerCase().includes(termo)
            ) ? '' : 'none';
        });
    });

    // Clique na linha para abrir a ficha do paciente
    document.querySelectorAll('.linha-paciente').forEach(linha => {
        linha.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            if (id) {
                window.location.href = "<?= site_url('medico/ficha_paciente/') ?>" + id;
            }
        });
    });
});
</script>
