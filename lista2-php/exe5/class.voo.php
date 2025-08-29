<?php

//para utilizar a classe data do exercicio anterior
require_once "../exe4/class.data.php";

Class Voo
{
    //Atributos
    private $assentos = [];
    private int $numeroVoo;
    private Data $dataVoo;

    //Construtor
    public function __construct($numeroVoo, $dataVoo)
    {
        $this->assentos = array_fill(1, 100, 0);
        $this->numeroVoo = $numeroVoo;
        $this->dataVoo = $dataVoo;
    }

    //Metodos
    public function getAssentos() {
        return $this->assentos;
    }

    public function getProximoAssento() {
        $proximoLivre = array_search(0, $this->assentos);
        
        if ($proximoLivre !== false) {
            return $proximoLivre;
        }
    
        return 0;
    }

    public function verificaAssento($assento) {
        if (isset($this->assentos[$assento]) && $this->assentos[$assento] != 0) {
            return 1; // Ocupado
        }
        return 0; // Livre ou não existe
    }

    public function ocupaAssento($assento) {
        if ($this->VerificaAssento($assento) == 0)
        {
            $this->assentos[$assento] = 1;
            return true;
        }
        return false;
    }
    
    public function getVagas() {
        $contagem = array_count_values($this->assentos);
        return $contagem[0] ?? 0;
    }

    public function getVoo() {
        return $this->numeroVoo;
    }

    public function getDataVoo() {
        return $this->dataVoo;
    }

}

// // criando o Voo
// $dataVoo1 = new Data(20, 10, 2025);
// $voo1 = new Voo(1001, $dataVoo1);

// echo "--- Tentando ocupar assentos ---<br>";

// // Tentativa 1: Ocupar assento 1 (deve funcionar)
// if ($voo1->ocupaAssento(1)) { // CORREÇÃO: Sem ';' e comparação direta com o booleano
//     echo "Assento 1 ocupado com sucesso!<br>";
// } else {
//     echo "Falha ao ocupar o assento 1.<br>";
// }

// // Tentativa 2: Ocupar assento 1 novamente (deve falhar)
// if ($voo1->ocupaAssento(1)) {
//     echo "Assento 1 ocupado com sucesso!<br>";
// } else {
//     echo "Falha ao ocupar o assento 1, pois já está ocupado.<br>";
// }

// // Tentativa 3: Ocupar assento 2 (deve funcionar)
// if ($voo1->ocupaAssento(2)) {
//     echo "Assento 2 ocupado com sucesso!<br>";
// } else {
//     echo "Falha ao ocupar o assento 2.<br>";
// }

// echo "<br>--- Status do Voo ---<br>";

// // Mostra o próximo assento livre (deve ser o 3)
// echo "O próximo assento livre é o: " . $voo1->getProximoAssento() . "<br>";

// // Verifica o status de um assento específico (o 3, que está livre)
// if ($voo1->verificaAssento(3) == 0) {
//     echo "O assento 3 está livre.<br>";
// } else {
//     echo "O assento 3 está ocupado.<br>";
// }

// // Mostra o total de vagas (100 - 2 ocupados = 98)
// echo "Total de assentos livres: " . $voo1->getVagas() . "<br>";

// // Informações do voo
// echo "Número do Voo: " . $voo1->getVoo() . "<br>";
// echo "Data do Voo: " . $voo1->getDataVoo()->retornaData();

?>