<?php

class TarefaController {
    private $tarefaModel;

    public function __construct($database) {
        $this->tarefaModel = new Tarefa($database);
    }

    // lista todas as tarefas, acao principal
    public function listar() {
        $tarefas = $this->tarefaModel->listAll();
        require ROOT_PATH . '/app/views/tarefa/index.php';
    }

    // processa a criacao de tarefas
    public function create($titulo, $descricao, $data_vencimento, $status) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // recebe os dados da view e cria a tarefa no banco de dados
            $this->tarefaModel->create($titulo, $descricao, $data_vencimento, $status);
            
            // redireciona para a página principal
            header('Location: index.php?action=listar');
        } else {
            // se não, apenas mostra o formulário de criação
            require ROOT_PATH . '/app/views/tarefa/create.php';
        }
    }

    // busca a tarefa pelo ID, e retorna a pagina de edicao com os dados da tarefa
    public function edit($id) {
        $returnTarefa = $this->tarefaModel->getById($id);
        $tarefa = $returnTarefa->fetch(PDO::FETCH_ASSOC);
        require ROOT_PATH . '/app/views/tarefa/edit.php';
    }

    // processa a edicao da tarefa
    public function update($id, $titulo, $descricao, $data_vencimento, $status) {
        // recebe os dados da view e da um update na tarefa no banco de dados
        $this->tarefaModel->update($id, $titulo, $descricao, $data_vencimento, $status);
            
        // redireciona para a página principal
        header('Location: index.php?action=listar');
    }

    // processa a mudanca de status da tarefa
    public function change($id, $status) {
        // recebe os dados da view e atualiza o status no banco de dados
        $this->tarefaModel->changeStatus($id, $status);

        // redireciona para a página principal
        header('Location: index.php?action=listar');
    }

    // processa a exclusao de tarefas
    public function delete($id) {
        // recebe os dados da view e exclui a tarefa no banco de dados
        $this->tarefaModel->delete($id);

        // redireciona para a página principal
        header('Location: index.php?action=listar');
    }
}