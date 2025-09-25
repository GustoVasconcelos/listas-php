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
require_once ROOT_PATH . '/app/helpers/InputHelper.php';

// inicia o objeto de banco de dados
$database = new Database('localhost', 'projeto_tarefas', 'root', '');

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
    $loginController = new LoginController($database);
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
    $tarefaController = new TarefaController($database);
    
    switch ($action) {
        case 'new':
            $tarefaController->new();
            break;
        case 'create':
            $tarefaController->create();
            break;
        case 'edit':
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $tarefaController->edit();
            } else {
                $tarefaController->update();
            }
            break;
        case 'change':
            $tarefaController->change();
            break;
        case 'delete':
            $tarefaController->delete();
            break;
        case 'listar':
        default:
            $tarefaController->listar();
            break;
    }
}