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
            $nomeAlterar = $_POST['nome'];
            $cpfAlterar = $_POST['cpf'];
            $emailAlterar = $_POST['email'];
            $clienteController->cadastrar($nomeAlterar, $cpfAlterar, $emailAlterar);
            break;
        case 'alterar':
            $idAlterar = $_GET['id'];
            $clienteController->alterar($idAlterar);
            break;
        case 'update':
            $idAlterar = $_POST['id'];
            $nomeAlterar = $_POST['nome'];
            $cpfAlterar = $_POST['cpf'];
            $emailAlterar = $_POST['email'];
            $clienteController->update($idAlterar, $nomeAlterar, $cpfAlterar, $emailAlterar);
            break;
        case 'delete':
            $clienteController->delete();
            break;
        default:
            echo "Ação inválida!";
    }
}