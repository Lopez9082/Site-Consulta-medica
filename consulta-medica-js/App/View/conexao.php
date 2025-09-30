<?php
$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'cadastro_db';

// Conecta ao banco
$conn = new mysqli($host, $usuario, $senha, $banco);

// Verifica conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
