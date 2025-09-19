<?php
// 1. Define a constante com o caminho absoluto para a raiz do projeto
define('ROOT_PATH', dirname(__DIR__));

// 2. Usa a constante para incluir os arquivos
require_once ROOT_PATH . '/config/database.php';
require_once ROOT_PATH . '/app/controllers/TarefaController.php';
require_once ROOT_PATH . '/app/models/Tarefa.php';

$controller = $_GET['controller'] ?? 'tarefa';
$action = $_GET['action'] ?? 'listar';

if ($controller == 'tarefa') {
    $tarefaController = new TarefaController();

    switch ($action) {
        case 'listar':
            $tarefaController->listar();
            break;
        case 'create':
            $titulo = htmlspecialchars($_POST['titulo']);
            $descricao = htmlspecialchars($_POST['descricao']);
            $data_vencimento = htmlspecialchars($_POST['data_vencimento']);
            $status = htmlspecialchars($_POST['status']);
            $tarefaController->create($titulo, $descricao, $data_vencimento, $status);
            break;
        case 'edit':
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $idTarefa = $_GET['id'];
                $tarefaController->edit($idTarefa);
            } else {
                $idTarefa = $_GET['id'];
                $titulo = htmlspecialchars($_POST['titulo']);
                $descricao = htmlspecialchars($_POST['descricao']);
                $data_vencimento = htmlspecialchars($_POST['data_vencimento']);
                $status = htmlspecialchars($_POST['status']);
                $tarefaController->update($idTarefa, $titulo, $descricao, $data_vencimento, $status);
            }
            break;
        case 'change':
            $idTarefa = $_GET['id'];
            $status = $_GET['status'];
            if ($status === "pendente") {
                $changeStatus = "concluida";
            } else {
                $changeStatus = "pendente";
            }
            $tarefaController->change($idTarefa, $changeStatus);
            break;
        case 'delete':
            $idTarefa = $_GET['id'];
            $tarefaController->delete($idTarefa);
            break;
        default:
            echo "Ação inválida!";
    }
}