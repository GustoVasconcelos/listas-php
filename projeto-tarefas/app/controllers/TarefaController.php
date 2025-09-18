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
}