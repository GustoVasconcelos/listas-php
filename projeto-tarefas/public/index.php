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
        default:
            echo "Ação inválida!";
    }
}