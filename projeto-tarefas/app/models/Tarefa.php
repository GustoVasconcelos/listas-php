<?php

class Tarefa {
    private $id;
    private $titulo;
    private $descricao;
    private $data_vencimento;
    private $status;
    
    //atributos de inicialização da conexão
    private $conexao;
    private $tableName = 'tarefas';

    //método construtor, que inicializa o objeto do banco de dados
    public function __construct($database) {
        // inicializa o atributo conexao (Tipo Database) com os dados de acesso do banco
        $this->conexao = $database->getConnection();
    }

    //métodos dos atributos (gets e sets)
    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getDataVencimento() {
        return $this->data_vencimento;
    }

    public function setDataVencimento($data_vencimento) {
        $this->data_vencimento = $data_vencimento;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    // métodos de acesso ao banco de dados

    public function listAll() {
        //método de buscar todas as tarefas no banco
        try {
            $comandoSQL= "SELECT * FROM ".$this->tableName;
            $acesso = $this->conexao->prepare($comandoSQL);

            if ($acesso->execute()) {
                return $acesso;
            }
            return false;       
        } catch (PDOException $erro) {
            echo $erro->getMessage();
        }
        return false;
    }

    public function getById($id) {
        //método de buscar uma terefa por seu id
        try {
            $comandoSQL= "SELECT * FROM ".$this->tableName." WHERE id = :param1";
            $acesso = $this->conexao->prepare($comandoSQL);

            $acesso->bindParam(":param1", $id);

            if ($acesso->execute()) {
                return $acesso;
            }
            return false;       
        } catch (PDOException $erro) {
            echo $erro->getMessage();
        }
        return false;
    }

    public function create($titulo, $descricao, $data_vencimento, $status) {
        //método que cria a tarefa no banco
        try {
            $comandoSQL= "INSERT INTO ".$this->tableName." (titulo, descricao, data_vencimento, status) values (:param1,:param2, :param3, :param4)";
            $acesso = $this->conexao->prepare($comandoSQL);
            
            $acesso->bindParam(":param1", $titulo);
            $acesso->bindParam(":param2", $descricao);
            $acesso->bindParam(":param3", $data_vencimento);
            $acesso->bindParam(":param4", $status);

            if ($acesso->execute()) {
                return true;
            }
            return false;       
        } catch (PDOException $erro) {
            echo $erro->getMessage();
        }
        return false;
    }

    public function update($id, $titulo, $descricao, $data_vencimento, $status) {
        //método que atualiza a tarefa no banco
        try {
            $comandoSQL = "UPDATE ".$this->tableName." SET
                       titulo = :param2,
                       descricao = :param3,
                       data_vencimento = :param4,
                       status = :param5
                       WHERE id = :param1";
            $acesso = $this->conexao->prepare($comandoSQL);

            $acesso->bindParam(":param2", $titulo);
            $acesso->bindParam(":param3", $descricao);
            $acesso->bindParam(":param4", $data_vencimento);
            $acesso->bindParam(":param5", $status);
            $acesso->bindParam(":param1", $id);
            
            if ($acesso->execute()) {
                return true;
            }
            return false;       
        } catch (PDOException $erro) {
            echo $erro->getMessage();
        }
        return false;
    }

    public function changeStatus($id, $status) {
        //método que atualiza a tarefa no banco
        try {
            $comandoSQL = "UPDATE ".$this->tableName." SET
                       status = :param2
                       WHERE id = :param1";
            $acesso = $this->conexao->prepare($comandoSQL);

            $acesso->bindParam(":param2", $status);
            $acesso->bindParam(":param1", $id);
            
            if ($acesso->execute()) {
                return true;
            }
            return false;       
        } catch (PDOException $erro) {
            echo $erro->getMessage();
        }
        return false;
    } 

    public function delete($id) {
        //método que deleta uma tarefa do banco
        try {
            $comandoSQL = "DELETE FROM ".$this->tableName." WHERE id = :param1";
            $acesso = $this->conexao->prepare($comandoSQL);

            $acesso->bindParam(":param1", $id);
            
            if ($acesso->execute()) {
                return true;
            }
            return false;       
        } catch (PDOException $erro) {
            echo $erro->getMessage();
        }
        return false;
    }
}