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
            $email = htmlspecialchars(trim($_POST['email']));
            $senha = htmlspecialchars(trim($_POST['senha']));
            $loginController->login($email, $senha);
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
        case 'create':
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $tarefaController->create(null, null, null, null);
            } else {
                $titulo = htmlspecialchars(trim($_POST['titulo']));
                $descricao = htmlspecialchars(trim($_POST['descricao']));
                $data_vencimento = htmlspecialchars(trim($_POST['data_vencimento']));
                $status = htmlspecialchars(trim($_POST['status']));
                $tarefaController->create($titulo, $descricao, $data_vencimento, $status);
            }
            break;
        case 'edit':
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $idTarefa = $_GET['id'];
                $tarefaController->edit($idTarefa);
            } else {
                $idTarefa = $_GET['id'];
                $titulo = htmlspecialchars(trim($_POST['titulo']));
                $descricao = htmlspecialchars(trim($_POST['descricao']));
                $data_vencimento = htmlspecialchars(trim($_POST['data_vencimento']));
                $status = htmlspecialchars(trim($_POST['status']));
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
        case 'listar':
        default:
            $tarefaController->listar();
            break;
    }
}