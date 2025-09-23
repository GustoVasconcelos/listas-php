<?php

class Usuario {
    private $id;
    private $nome;
    private $email;
    private $senha;

    //atributos de inicialização da conexão
    private $conexao;
    private $tableName = 'usuarios';

    //método construtor, que inicializa o objeto do banco de dados
    public function __construct($database) {
        // inicializa o atributo conexao (Tipo Database) com os dados de acesso do banco
        $this->conexao = $database->getConnection();
    }

    //sets e gets dos atributos

    public function findUser($email) {
        //método de localizar o usuario no banco de dados usando seu email
        try {
            $comandoSQL= "SELECT * FROM ".$this->tableName." WHERE email = :param1";
            $acesso = $this->conexao->prepare($comandoSQL);

            $acesso->bindParam(":param1", $email);

            if ($acesso->execute()) {
                return $acesso;
            }
            return false;       
        } catch (PDOException $erro) {
            echo $erro->getMessage();
        }
    }
}