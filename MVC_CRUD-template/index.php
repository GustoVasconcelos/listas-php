<?php
require_once "controllers/ClienteController.php";

$controller = $_GET['controller'] ?? 'cliente';
$action = $_GET['action'] ?? 'listar';

if ($controller == 'cliente') {
    $clienteController = new ClienteController();

    switch ($action) {
        case 'listar':
            $clienteController->listar();
            break;
        case 'adicionar':
            $clienteController->adicionar();
            break;
        case 'salvar':
            $clienteController->cadastrar();
            break;
        case 'alterar':
            $clienteController->alterar();
            break;
        case 'update':
            $clienteController->update();
            break;
        default:
            echo "Ação inválida!";
    }
}