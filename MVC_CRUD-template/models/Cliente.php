<?php 
require_once "models/Database.php";

class Cliente {
    private $conexao;
    private $tableName = 'clientes';

    public function __construct() {
        // inicializa o atributo conexao (Tipo Database)
        $database = new Database('localhost', 'dbsistema', 'root', '');
        $this->conexao = $database->getConnection();
    }

    public function create($nome, $CPF, $email): bool {
       // insert na tabela -> dados recebidos por parâmetro
       try{
            $comandoSQL = "insert into clientes(nome, cpf, email) values (:param1, :param2, :param3)";
            $acesso = $this->conexao->prepare($comandoSQL);

            $acesso->bindParam(":param1", $nome);
            $acesso->bindParam(":param2", $CPF);
            $acesso->bindParam(":param3", $email);

            if ($acesso->execute()) {
                return true;
            }
            return false;
       }
       catch (PDOException $erro) {
            echo $erro->getMessage();
       }
       return false;
    }

    public function recoveryAll() {
        // return todos os registros da tabela
        $comandoSQL = "select * from clientes";
        $acesso = $this->conexao->prepare($comandoSQL);
        $acesso->execute();
        return $acesso;
        //return $dados
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
