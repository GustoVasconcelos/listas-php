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

    public function cadastrar($nome, $cpf, $email) {
        if (isset($nome, $cpf, $email)) {
            $this->clienteModel->create($nome, $cpf, $email);
            header("Location: index.php?controller=cliente&action=listar");
        } else {
            echo "Erro: Preencha todos os campos obrigatórios!";
        }
    }

    public function alterar($idAlterar) {
        $returnUser = $this->clienteModel->recoveryById($idAlterar);
        $usuario = $returnUser->fetch(PDO::FETCH_ASSOC);
        require_once "views/alterar.php";
    }

    public function update($id, $nome, $cpf, $email) {
        if (isset($id, $nome, $cpf, $email)) {
            $this->clienteModel->update($id, $nome, $cpf, $email);
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