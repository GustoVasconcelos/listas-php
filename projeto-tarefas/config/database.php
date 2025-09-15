<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'banco_sistema';
    private $username = 'root';
    private $password = 'root';
    private $DBConn; // conexao com o banco

    public function __construct($servidor, $nomeBanco, $usuario, $senha) {
        $this->host = $servidor;
        $this->db_name = $nomeBanco;
        $this->username = $usuario;
        $this->password = $senha;
    }

    public function getConnection() {
        $this->DBConn = null;
        try {
            $this->DBConn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name, $this->username, $this->password);
                                //   mysql:host=localhost;dbname=banco_sistema
            $this->DBConn->exec('set names utf8');
        }
        catch (PDOException $erro) {
            echo "Erro de Conexão com o banco de dados: ".$erro->getMessage();
        }
        return $this->DBConn;
    }
}