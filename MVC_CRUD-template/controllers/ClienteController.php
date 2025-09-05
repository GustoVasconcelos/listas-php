<?php
require_once "models/Database.php";
require_once "models/Cliente.php";

class ClienteController {
    private $clienteModel;

    public function __construct() {
        $this->clienteModel = new Cliente();
    }

    // func para listar todos os clientes
    public function listar() {
        // chama o método da classe/Modelo Cliente que retorna todos
        // chama a View Listas para exibir os registros/clientes recebidos
        $relacaoClientes = $this->clienteModel->recoveryAll();
        require_once "views/listar.php";
    }

    //métodos para adicionar, alterar, excluir ...
    public function adicionar() {
        require_once "views/adicionar.php";
    }

    public function cadastrar() {
        if (isset($_POST['nome'], $_POST['cpf'] , $_POST['email'])) {
            $this->clienteModel->create($_POST['nome'], $_POST['cpf'], $_POST['email']);
            header("Location: index.php?controller=cliente&action=listar");
        } else {
            echo "Erro: Preencha todos os campos obrigatórios!";
        }
    }

    public function alterar() {
        $id = $_GET['id'];
        $returnUser = $this->clienteModel->recoveryById($id);
        $usuario = $returnUser->fetch(PDO::FETCH_ASSOC);
        require_once "views/alterar.php";
    }

    public function update() {
        if (isset($_POST['id'], $_POST['nome'], $_POST['cpf'] , $_POST['email'])) {
            $this->clienteModel->update($_POST['id'], $_POST['nome'], $_POST['cpf'] , $_POST['email']);
            header("Location: index.php?controller=cliente&action=listar");
        } else {
            echo "Erro: Preencha todos os campos obrigatórios!";
        }
    }

    public function delete() {
        if (isset($_GET['id'])) {
            $this->clienteModel->delete($_GET['id']);
            header("Location: index.php?controller=cliente&action=listar");
        } else {
            echo "Erro: Preencha todos os campos obrigatórios!";
        }
    }

}