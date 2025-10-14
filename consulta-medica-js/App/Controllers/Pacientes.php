public function cadastrar() {
    // Recebe os dados em JSON (vindo do fetch)
    $json = file_get_contents('php://input');
    $dados = json_decode($json, true);

    if (!$dados) {
        echo json_encode(["sucesso" => false, "mensagem" => "Dados inválidos"]);
        return;
    }

    require_once __DIR__ . '/../models/PacienteModel.php';
    $model = new PacienteModel();

    $resposta = $model->cadastrarPaciente(
        $dados['email'] ?? '',
        $dados['senha'] ?? '',
        $dados['nome'] ?? '',
        $dados['Data_Nas'] ?? '',
        $dados['CPF'] ?? '',
        $dados['telefone'] ?? '',
        $dados['cep'] ?? '',
        $dados['endereco'] ?? '',
        $dados['estado'] ?? '',
        $dados['complemento'] ?? '',
        $dados['cidade'] ?? '',
        'Brasil'
    );

    echo json_encode(["sucesso" => true, "mensagem" => $resposta]);
}
