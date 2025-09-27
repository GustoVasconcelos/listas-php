<?php
// inicia a sessão em todas as páginas
session_start();

// define a constante com o caminho absoluto para a raiz do projeto
define('ROOT_PATH', dirname(__DIR__));

// usa a constante para incluir os arquivos

// classe do banco de dados
require_once ROOT_PATH . '/config/database.php';

// controllers
require_once ROOT_PATH . '/app/controllers/TarefaController.php';
require_once ROOT_PATH . '/app/controllers/LoginController.php';

// models
require_once ROOT_PATH . '/app/models/Tarefa.php';
require_once ROOT_PATH . '/app/models/Usuario.php';

// helpers
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
    // roteamento para as acoes da tarefa (se chegou aqui, o usuario esta logado)
    $tarefaController = new TarefaController($database);
    
    switch ($action) {
        case 'create':
            $tarefaController->create();
            break;
        case 'edit':
            $tarefaController->edit($id);
            break;
        case 'change':
            $tarefaController->change($id);
            break;
        case 'delete':
            $tarefaController->delete($id);
            break;
        case 'listar':
        default:
            $tarefaController->listar();
            break;
    }
}