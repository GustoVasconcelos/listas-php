<?php
require_once "models/Database.php";
require_once "models/Cliente.php";

class ClienteController {
    private $clienteModel;

    public function __construct() {
        $clienteModel = new Cliente();
    }

    // func para listar todos os clientes
    public function listar() {
        // chama o método da classe/Modelo Cliente que retorna todos
        // chama a View Listas para exibir os registros/clientes recebidos
    }

    //métodos para adicionar, alterar, excluir ...

}