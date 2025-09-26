<?php

class LoginController {
    private $usuarioModel;

    public function __construct($database) {
        $this->usuarioModel = new Usuario($database);
    }

    // mostra a página de login
    public function index() {
        require ROOT_PATH . '/app/views/login/index.php';
    }

    // processa o login
    public function login() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            //limpa todo o $_POST de uma só vez
            $dados = InputHelper::limpaArray($_POST);
            
            // recebe os dados da view e chama o metodo findUser do model do usuario para buscar no banco
            $localizar = $this->usuarioModel->findUser($dados['email']);

            // se achar, retora o usuario, senao retorna false
            $usuario = $localizar->fetch(PDO::FETCH_ASSOC);

            // se o usuario existir e a senha estiver correta
            if($usuario && password_verify($dados['senha'], $usuario['senha'])) {
                // abre a sessao e salva os dados do usuario em variaveis de sessao
                session_start();
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];

                // redireciona para a index das tarefas
                header('Location: index.php?action=listar');
                exit;
            } else {
                // se o login falhou
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