<form id="cadastroForm" novalidate>
  <input type="text" name="nome" id="nome" required>
  <input type="date" name="Data_Nas" id="Data_Nas" required>
  <input type="text" name="CPF" id="CPF" required>
  <input type="tel" name="telefone" id="telefone" required>
  <input type="text" name="cep" id="cep" required>
  <input type="text" name="endereco" id="endereco" required>
  <input type="text" name="complemento" id="complemento">
  <input type="text" name="cidade" id="cidade" required>
  <select name="estado" id="estado" required>
    <option value="">Selecione</option>
    <option value="SP">SP</option>
    <option value="RJ">RJ</option>
    <!-- etc -->
  </select>
  <input type="email" name="email" id="email" required>
  <input type="password" name="senha" id="senha" required>
  <button type="submit">Cadastrar</button>
</form>

<script>
document.getElementById("cadastroForm").addEventListener("submit", function(e) {
  e.preventDefault(); // Impede envio normal

  const dados = {
    nome: document.getElementById("nome").value,
    Data_Nas: document.getElementById("Data_Nas").value,
    CPF: document.getElementById("CPF").value,
    telefone: document.getElementById("telefone").value,
    cep: document.getElementById("cep").value,
    endereco: document.getElementById("endereco").value,
    complemento: document.getElementById("complemento").value,
    cidade: document.getElementById("cidade").value,
    estado: document.getElementById("estado").value,
    email: document.getElementById("email").value,
    senha: document.getElementById("senha").value
  };

  fetch("index.php?controller=pacientes&action=cadastrar", {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify(dados)
  })
  .then(response => response.json())
  .then(data => {
    if (data.sucesso) {
      alert("Cadastro realizado com sucesso!");
      // window.location.href = "login.php"; // redirecionar, se quiser
    } else {
      alert("Erro: " + data.mensagem);
    }
  })
  .catch(error => {
    console.error("Erro na requisição:", error);
  });
});
</script>
