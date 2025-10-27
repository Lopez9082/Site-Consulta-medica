<div class="container mt-4">
    <h3 class="text-center mb-4">Colaboradores Cadastrados</h3>

    <!-- Barra de pesquisa -->
    <div class="mb-3">
        <input type="text" id="pesquisaColaborador" class="form-control" placeholder="Pesquisar colaborador por nome...">
    </div>

    <!-- TABELA DE COLABORADORES -->
    <?php if (!empty($colaboradores)): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="tabelaColaboradores">
                <thead class="table-dark">
                    <tr>
                        <th>Nome</th>
                        <th>Função</th>
                        <th>Email</th>
                        <th>Telefone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($colaboradores as $col): ?>
                        <tr style="cursor:pointer;" 
                            onclick="window.location='<?= site_url('balcao/perfil_colaborador/'.$col->Id) ?>'">
                            <td><?= htmlspecialchars($col->Nome) ?></td>
                            <td><?= htmlspecialchars($col->Funcao) ?></td>
                            <td><?= htmlspecialchars($col->Email) ?></td>
                            <td><?= htmlspecialchars($col->Telefone) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center">
            Nenhum colaborador cadastrado.
        </div>
    <?php endif; ?>

    <!-- BOTÃO FLUTUANTE PARA CADASTRAR NOVO COLABORADOR -->
    <a href="<?= site_url('balcao/cadastrar_colaborador') ?>" 
       class="btn btn-primary btn-lg rounded-circle"
       style="position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
        <i class="bi bi-plus"></i>
    </a>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<!-- Script de pesquisa -->
<script>
document.getElementById('pesquisaColaborador').addEventListener('keyup', function() {
    const filtro = this.value.toLowerCase();
    const linhas = document.querySelectorAll('#tabelaColaboradores tbody tr');

    linhas.forEach(linha => {
        const nome = linha.cells[0].textContent.toLowerCase();
        linha.style.display = nome.includes(filtro) ? '' : 'none';
    });
});

// Efeito visual ao passar o mouse
document.querySelectorAll('#tabelaColaboradores tbody tr').forEach(row => {
    row.addEventListener('mouseover', () => row.style.backgroundColor = '#e8f5e9');
    row.addEventListener('mouseout', () => row.style.backgroundColor = '');
});
</script>
