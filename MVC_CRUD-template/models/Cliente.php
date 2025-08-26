<?php 
require_once "models/Database.php";

class Cliente {
    private $conexao;
    private $tableName = 'clientes';

    public function __construct() {
        // inicializa o atributo conexao (Tipo Database)
        $database = new Database('localhost', 'dbSistema', 'root', 'root');
        $this->conexao = $database->getConnection();
    }

    public function create($id, $nome, $CPF, $email) {
       // insert na tabela -> dados recebidos por parâmetro
    }

    public function recoveryAll() {
        // return todos os registros da tabela
    }

    public function recoveryById($idBusca) {
        // return a linha da tabela com id igual ao parametro
    }

    public function recoveryByName($nomeBusca) {
        // retorna a linha da tabela com o nome igual
    }

    public function update($id, $nome, $CPF, $email) {
        // atualiza o ID com os dados do paramentro
    }

    public function delete($id) {
        // excluir do banco o cliente com id
    }
}
