<?php
// Conexão com o banco de dados
$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'consultas';

$conn = new mysqli($host, $usuario, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);

}

//Pegando dados do formulario
$name = $_POST ['nome'];
$email = $_POST ['email'];
$usuario = $_POST ['usuario'];