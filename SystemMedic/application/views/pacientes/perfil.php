<div class="perfil-container">
    <h3><i class="fa fa-user-circle"></i> Meu Perfil</h3>
    <p class="text-muted">Aqui você pode visualizar e atualizar algumas informações pessoais.</p>

    <form method="post" action="<?= site_url('paciente/atualizar_perfil') ?>" class="perfil-form">

        <div class="form-group">
            <label>Nome Completo</label>
            <input type="text" name="Nome_Pac" class="form-control" 
                   value="<?= $paciente->Nome_Pac ?? '' ?>" readonly>
        </div>

        <div class="form-group">
            <label>CPF</label>
            <input type="text" name="Cpf_cnpj" class="form-control"
                   value="<?= $paciente->Cpf_cnpj ?? '' ?>" readonly>
        </div>

        <div class="form-group">
            <label>Data de Nascimento</label>
            <input type="text" class="form-control"
                   value="<?= isset($paciente->Data_Nas) ? date('d/m/Y', strtotime($paciente->Data_Nas)) : '' ?>" readonly>
        </div>

        <div class="form-group">
            <label for="Email_Pac">E-mail</label>
            <input type="email" name="Email_Pac" id="Email_Pac" class="form-control"
                   value="<?= $paciente->Email_Pac ?? '' ?>" required>
        </div>

        <div class="form-group">
            <label for="Senha_Pac">Nova Senha</label>
            <input type="password" name="Senha_Pac" id="Senha_Pac" class="form-control" placeholder="Digite uma nova senha se desejar alterar">
            <small class="text-muted">Deixe em branco se não quiser mudar.</small>
        </div>

        <div class="text-end mt-3">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-save"></i> Atualizar Dados
            </button>
        </div>
    </form>
</div>

<style>
    .perfil-container {
        max-width: 700px;
        margin: auto;
        background: #fff;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .perfil-container h3 {
        color: #2c3e50;
        border-bottom: 2px solid #1abc9c;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .perfil-form .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: 600;
        display: block;
        margin-bottom: 5px;
        color: #2c3e50;
    }

    input.form-control {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ccc;
        transition: 0.3s;
    }

    input.form-control:focus {
        border-color: #1abc9c;
        box-shadow: 0 0 5px rgba(26,188,156,0.3);
    }

    .btn-success {
        background: #1abc9c;
        border: none;
        border-radius: 6px;
        padding: 10px 20px;
        font-weight: bold;
        transition: 0.3s;
    }

    .btn-success:hover {
        background: #16a085;
    }

    .text-end {
        text-align: right;
    }
</style>
