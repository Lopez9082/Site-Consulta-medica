<div class="container mt-4">
    <h3 class="mb-4">Médicos Cadastrados</h3>

    <!-- Barra de pesquisa -->
    <div class="mb-3">
        <input type="text" id="pesquisaMedico" class="form-control" placeholder="Pesquisar médico por nome...">
    </div>

    <!-- Lista de médicos -->
    <div class="table-responsive">
    <table class="table table-hover align-middle" id="tabelaMedicos" 
           style="background-color:#fff; border-radius:8px; overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,0.1);">
        <thead style="background-color:#1abc9c; color:#fff;">
            <tr>
                <th>Nome</th>
                <th>CRM</th>
                <th>Especialidade</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Celular</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($medicos as $medico): ?>
                <tr style="cursor:pointer; transition: background-color 0.2s;"
                    onclick="window.location='<?= site_url('balcao/perfil_medico/'.$medico->Id) ?>'"
                    onmouseover="this.style.backgroundColor='#e8f8f5';" 
                    onmouseout="this.style.backgroundColor='white';">

                    <td style="font-weight:bold; color:#1abc9c;"><?= $medico->Nome_Med ?></td>
                    <td><?= $medico->CRM ?></td>
                    <td><?= $medico->Especialidade ?></td>
                    <td><?= $medico->Email_Med ?></td>
                    <td><?= $medico->Telefone ?></td>
                    <td><?= $medico->Celular ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


    <!-- Botão flutuante para cadastrar -->
    <a href="<?= site_url('balcao/cadastrar_medico') ?>" 
       class="btn btn-success rounded-circle"
       style="position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px; font-size: 24px; display:flex; align-items:center; justify-content:center;">
        +
    </a>
</div>

<!-- Script de pesquisa -->
<script>
document.getElementById('pesquisaMedico').addEventListener('keyup', function() {
    const filtro = this.value.toLowerCase();
    const linhas = document.querySelectorAll('#tabelaMedicos tbody tr');

    linhas.forEach(linha => {
        const nome = linha.cells[0].textContent.toLowerCase();
        linha.style.display = nome.includes(filtro) ? '' : 'none';
    });
});
</script>
