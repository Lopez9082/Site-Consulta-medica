<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastro</title>
  <link rel="stylesheet" href="<?= base_url('design/cadastro1.css') ?>">
</head>
<body>
  <div class="login-container">
    <form id="cadastroForm" novalidate>
  <label for="nome">Nome:</label>
  <input type="text" id="nome" name="nome" required />

  <label for="Data_Nas">Data de Nascimento:</label>
  <input type="date" id="Data_Nas" name="Data_Nas" required />

  <label for="CPF">CPF:</label>
  <input type="text" id="CPF" name="CPF" required />

  <label for="telefone">Telefone:</label>
  <input type="tel" id="telefone" name="telefone" />

  <label for="cep">CEP:</label>
  <input type="text" id="cep" name="cep" />

  <label for="endereco">Endereço:</label>
  <input type="text" id="endereco" name="endereco" />

  <label for="complemento">Complemento:</label>
  <input type="text" id="complemento" name="complemento" />

  <label for="cidade">Cidade:</label>
  <input type="text" id="cidade" name="cidade" />

  <label for="estado">Estado:</label>
  <input type="text" id="estado" name="estado" />

  <label for="email">Email:</label>
  <input type="email" id="email" name="email" required />

  <label for="senha">Senha:</label>
  <input type="password" id="senha" name="senha" required />

  <button type="submit">Finalizar Cadastro</button>
</form>

    <div id="resultado"></div>
  </div>

  <script>
  document.getElementById('cadastroForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const dados = {
      nome: document.getElementById('nome').value,
      Data_Nas: document.getElementById('Data_Nas').value,
      CPF: document.getElementById('CPF').value,
      telefone: document.getElementById('telefone').value,
      cep: document.getElementById('cep').value,
      endereco: document.getElementById('endereco').value,
      complemento: document.getElementById('complemento').value,
      cidade: document.getElementById('cidade').value,
      estado: document.getElementById('estado').value,
      email: document.getElementById('email').value,
      senha: document.getElementById('senha').value
    };

    fetch('<?= base_url('pacientes/cadastrar') ?>', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(dados)
    })
    .then(res => res.json())
    .then(data => {
      const div = document.getElementById('resultado');
      if (data.sucesso) {
        div.innerHTML = `<p style="color:green;">${data.mensagem}</p>`;
      } else {
        div.innerHTML = `<p style="color:red;">${data.mensagem}</p>`;
      }
    })
    .catch(err => {
      console.error('Erro:', err);
    });
  });
  </script>
</body>
</html>
