<?php

class TarefaController {
    private $tarefaModel;

    public function __construct($database) {
        $this->tarefaModel = new Tarefa($database);
    }

    // lista todas as tarefas, acao principal
    public function listar() {
        // se não tiver nenhum filtro ativo, ele vai usar por padrão o 'todas'
        $filtro = $_GET['filtro'] ?? 'todas';
        // aqui ele verifica para saber se vai chamar o método com ou sem filtro
        if ($filtro == "todas") {
            // se estiver sem filtro
            $tarefas = $this->tarefaModel->listAll();
        } else {
            // se estiver com filtro
            $tarefas = $this->tarefaModel->listAll($filtro);
        }
        // marca o filtro ativo para usar na view
        $filtro_ativo = $filtro;
        // chama a view com as listagens
        require ROOT_PATH . '/app/views/tarefa/index.php';
    }

    // processa a pagina de nova tarefa
    public function new() {
        require ROOT_PATH . '/app/views/tarefa/create.php';
    }

    // processa a criacao de tarefas
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            //limpa todo o $_POST de uma só vez
            $dados = inputHelper::limpaArray($_POST);

            $erros = [];

            //valida o título
            if(InputHelper::validaRequerido($dados['titulo'])) {
                $erros[] = "O campo titulo é obrigatório";
            }

            if(empty($erros)) {
                // recebe os dados e cria a tarefa no banco de dados
                $this->tarefaModel->create($dados['titulo'], $dados['descricao'], $dados['data_vencimento'], $dados['status']);

                // redireciona para a página principal
                header('Location: index.php?action=listar');
            } else {
                // se houver erros, recarrega a view de criação e mostra os erros
                require ROOT_PATH . '/app/views/tarefa/create.php';
            }
            
            
        }
    }

    // busca a tarefa pelo ID, e retorna a pagina de edicao com os dados da tarefa
    public function edit() {
        // pega o id que foi passado por $_GET
        $idTarefa = $_GET['id'];
        // usa o método para buscar a tarefa no banco de dados usando o id
        $returnTarefa = $this->tarefaModel->getById($idTarefa);
        // faz o fecth da tarefa
        $tarefa = $returnTarefa->fetch(PDO::FETCH_ASSOC);
        // retorna os dados para a view
        require ROOT_PATH . '/app/views/tarefa/edit.php';
    }

    // processa a edicao da tarefa
    public function update() {
        // pega o id que foi passado por $_GET
        $idTarefa = $_GET['id'];

        // limpa todo o $_POST de uma só vez
        $dados = inputHelper::limpaArray($_POST);

        // recebe os dados da view e da um update na tarefa no banco de dados
        $this->tarefaModel->update($idTarefa, $dados['titulo'], $dados['descricao'], $dados['data_vencimento'], $dados['status']);
            
        // redireciona para a página principal
        header('Location: index.php?action=listar');
    }

    // processa a mudanca de status da tarefa
    public function change() {
        // pega o id que foi passado por $_GET
        $idTarefa = $_GET['id'];
        // pega o status que foi passado por $_GET
        $status = $_GET['status'];
        // faz a validação e retorna qual status ele irá mudar no banco
        if ($status === "pendente") {
            $changeStatus = "concluida";
        } else {
            $changeStatus = "pendente";
        }
        // recebe o status da validação anterior e atualiza o status no banco de dados
        $this->tarefaModel->changeStatus($id, $status);

        // redireciona para a página principal
        header('Location: index.php?action=listar');
    }

    // processa a exclusao de tarefas
    public function delete() {
        // pega o id que foi passado por $_GET
        $idTarefa = $_GET['id'];
        // chama o método excluir do model e exclui a tarefa no banco de dados
        $this->tarefaModel->delete($idTarefa);

        // redireciona para a página principal
        header('Location: index.php?action=listar');
    }
}