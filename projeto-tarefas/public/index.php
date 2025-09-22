<?php
// inicia a sessão em todas as páginas
session_start();

// define a constante com o caminho absoluto para a raiz do projeto
define('ROOT_PATH', dirname(__DIR__));

// usa a constante para incluir os arquivos
require_once ROOT_PATH . '/config/database.php';
require_once ROOT_PATH . '/app/controllers/TarefaController.php';
require_once ROOT_PATH . '/app/models/Tarefa.php';
require_once ROOT_PATH . '/app/controllers/LoginController.php';
require_once ROOT_PATH . '/app/models/Usuario.php';

// --- verifica se esta autenticado ---
// lista de ações que NÃO precisam de autenticacao
$acoesPublicas = ['showLogin', 'login'];
$action = $_GET['action'] ?? 'index';

// se a ação não é pública E o usuário não está logado, redireciona para o login
if (!in_array($action, $acoesPublicas) && !isset($_SESSION['usuario_id'])) {
    header('Location: index.php?action=showLogin');
    exit;
}

// roteamento
$id = $_GET['id'] ?? null;

// roteamento paras as acoes de login
if (in_array($action, ['showLogin', 'login', 'logout'])) {
    $loginController = new LoginController();
    switch($action) {
        case 'login':
            $loginController->login();
            break;
        case 'logout':
            $loginController->logout();
            break;
        case 'showLogin':
        default:
            $loginController->index();
            break;
    }
} else {
    // roteamento para as acoes da tarefa (se chefou aqui, o usuario esta logado)
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