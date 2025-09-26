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

    // processa a criacao de tarefas
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // limpa todo o $_POST de uma só vez
            $dados = InputHelper::limpaArray($_POST);
            
            // inicializa o array de erros, caso tenha a ter mais validacoes no futuro
            $erros = [];

            // valida o título
            if(!InputHelper::validaRequerido($dados['titulo'])) {
                $erros[] = "O campo 'titulo' é obrigatório";
            }

            if(!InputHelper::validaRequerido($dados['descricao'])) {
                $erros[] = "O campo 'descricao' é obrigatório";
            }

            if(!InputHelper::validaRequerido($dados['data_vencimento'])) {
                $erros[] = "O campo 'vencimento' é obrigatório";
            }

            // se nao tiver nenhum erro...
            if(empty($erros)) {
                // recebe os dados e cria a tarefa no banco de dados
                $this->tarefaModel->create($dados['titulo'], $dados['descricao'], $dados['data_vencimento'], $dados['status']);

                // redireciona para a página principal
                header('Location: index.php?action=listar');
            }
        }

        // se for uma requisicao GET, ele mostra a pagina de criacao da tarefa
        // se a validacao do POST falhou...retorna a view com as mensagens de erro do array $erros
        require ROOT_PATH . '/app/views/tarefa/create.php';
    }

    // busca a tarefa pelo ID, e retorna a pagina de edicao com os dados da tarefa
    public function edit($idTarefa) {

        // usa o método para buscar a tarefa no banco de dados usando o id
        $returnTarefa = $this->tarefaModel->getById($idTarefa);
        
        // faz o fecth da tarefa
        $tarefa = $returnTarefa->fetch(PDO::FETCH_ASSOC);
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           // limpa todo o $_POST de uma só vez
            $dados = InputHelper::limpaArray($_POST);

            // inicializa o array de erros
            $erros = [];

            // valida o título
            if(!InputHelper::validaRequerido($dados['titulo'])) {
                $erros[] = "O campo 'titulo' é obrigatório";
            }

            if(!InputHelper::validaRequerido($dados['descricao'])) {
                $erros[] = "O campo 'descricao' é obrigatório";
            }

            if(!InputHelper::validaRequerido($dados['data_vencimento'])) {
                $erros[] = "O campo 'vencimento' é obrigatório";
            }

            // se nao tiver nenhum erro...
            if(empty($erros)) {
                // recebe os dados da view e da um update na tarefa no banco de dados
                $this->tarefaModel->update($idTarefa, $dados['titulo'], $dados['descricao'], $dados['data_vencimento'], $dados['status']);
                    
                // redireciona para a página principal
                header('Location: index.php?action=listar');
            } 
        }

        // se for uma requisicao GET, ele mostra a pagina de edicao da tarefa com os dados da tarefa
        // se a validacao do POST falhou...retorna a view com as mensagens de erro do array $erros
        require ROOT_PATH . '/app/views/tarefa/edit.php';
    }

    // processa a mudanca de status da tarefa
    public function change($idTarefa) {
        
        // pega o status que foi passado por $_GET
        $status = $_GET['status'];

        // faz a validação e retorna qual status ele irá mudar no banco
        if ($status === "pendente") {
            $changeStatus = "concluida";
        } else {
            $changeStatus = "pendente";
        }
        
        // recebe o status da validação anterior e atualiza o status no banco de dados
        $this->tarefaModel->changeStatus($idTarefa, $changeStatus);

        // redireciona para a página principal
        header('Location: index.php?action=listar');
    }

    // processa a exclusao de tarefas
    public function delete($idTarefa) {

        // chama o método excluir do model e exclui a tarefa no banco de dados
        $this->tarefaModel->delete($idTarefa);

        // redireciona para a página principal
        header('Location: index.php?action=listar');
    }
}