<?php

class TarefaController {
    private $tarefaModel;

    public function __construct() {
        $this->tarefaModel = new Tarefa();
    }

    public function listar() {
        $tarefas = $this->tarefaModel->listAll();
        require ROOT_PATH . '/app/views/tarefa/index.php';
    }

    public function create($titulo, $descricao, $data_vencimento, $status) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Se o formulário foi enviado, cria um novo objeto Tarefa            
            // Salva a tarefa no banco de dados
            $this->tarefaModel->create($titulo, $descricao, $data_vencimento, $status);
            
            // Redireciona para a página principal
            header('Location: index.php');
        } else {
            // Se não, apenas mostra o formulário de criação
            require ROOT_PATH . '/app/views/tarefa/create.php';
        }
    }

    public function edit($id) {
        $returnTarefa = $this->tarefaModel->getById($id);
        $tarefa = $returnTarefa->fetch(PDO::FETCH_ASSOC);
        require ROOT_PATH . '/app/views/tarefa/edit.php';
    }

    public function update($id, $titulo, $descricao, $data_vencimento, $status) {
        // Se o formulário foi enviado, cria um novo objeto Tarefa            
        // Salva a tarefa no banco de dados
        $this->tarefaModel->update($id, $titulo, $descricao, $data_vencimento, $status);
            
        // Redireciona para a página principal
        header('Location: index.php');
    }

    public function change($id, $status) {
        $this->tarefaModel->changeStatus($id, $status);
        header('Location: index.php');
    }

    public function delete($id) {
        $this->tarefaModel->delete($id);
        header('Location: index.php');
    }
}