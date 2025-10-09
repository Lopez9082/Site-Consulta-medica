<?php
require_once 'controllers/PacientesController.php';

$controller = $_GET['controller'] ?? '';
$action = $_GET['action'] ?? '';

if ($controller === 'pacientes') {
    $pacienteController = new PacientesController();

    switch ($action) {
        case 'cadastrar':
            $pacienteController->cadastrar();
            break;
        case 'listar':
            $pacienteController->listar();
            break;
        default:
            echo json_encode(['erro' => 'Ação inválida']);
    }
}
