<?php

class LoginController {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    // mostra a página de login
    public function index() {
        require ROOT_PATH . '/app/views/login/index.php';
    }

    public function login() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $localizar = $this->usuarioModel->findUser($email);
            $usuario = $localizar->fetch(PDO::FETCH_ASSOC);

            if($usuario && password_verify($senha, $usuario['senha'])) {
                session_start();
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];

                // redireciona para a index das tarefas
                header('Location: index.php?action=listar');
                exit;
            } else {
                // login falhou
                $erro = "E-mail ou senha inválidos.";
                // recarrega a view de login com a mensagem de erro
                require ROOT_PATH . '/app/views/login/index.php';
            }
        }
    }

    // processa o logout
    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php?action=showLogin');
        exit;
    }
}