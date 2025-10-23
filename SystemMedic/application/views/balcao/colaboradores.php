<div class="container mt-4">
    <h3 class="text-center mb-4">Colaboradores Cadastrados</h3>

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
                        <tr style="cursor:pointer;" onclick="window.location='<?= site_url('balcao/perfil_colaborador/'.$col->Id) ?>'">
                            <td><?= $col->Nome ?></td>
                            <td><?= $col->Funcao ?></td>
                            <td><?= $col->Email ?></td>
                            <td><?= $col->Telefone ?></td>
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

    <!-- BOTÃO FLOUTANTE PARA CADASTRAR NOVO COLABORADOR -->
    <a href="<?= site_url('balcao/cadastrar_colaborador') ?>" 
       class="btn btn-primary btn-lg rounded-circle"
       style="position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
        <i class="bi bi-plus"></i>
    </a>
</div>

<!-- Opcional: link para ícones do Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
