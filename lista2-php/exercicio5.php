<?php

//para utilizar a classe data do exercicio anterior
require_once "exercicio4.php";

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
        for ($i=1; $i <= count($this->assentos); $i++) {
            if ($this->assentos[$i] == 0)
                return $i;
        }
        return "Nao ha assentos livres.";
    }

    public function verificaAssento($assento) : bool {
        return $this->assentos[$assento] != 0 ? true : false;
    }

    public function ocupaAssento($assento) {
        if ($this->VerificaAssento($assento) == false)
        {
            $this->assentos[$assento] = 1;
            return "Assento $assento ocupado com sucesso";
        } else {
            return "Assento ocupado, escolha outro.";
        }
    }
    
    public function getVagas() {
        $quantidade = 0;
        for ($i=1; $i <= count($this->assentos); $i++) {
            if ($this->VerificaAssento($i) == 0) {
                $quantidade++;
            }
        }
        return $quantidade;
    }

    public function getVoo() {
        return $this->numeroVoo;
    }

    public function getDataVoo() {
        return $this->dataVoo;
    }

}

$dataVoo1 = new Data(20, 10, 2025);
$voo1 = new Voo(1001, $dataVoo1);

echo $voo1->ocupaAssento(1) . "<br>";
echo $voo1->ocupaAssento(2) . "<br>";
echo $voo1->ocupaAssento(3) . "<br>";
echo "Assento " . $voo1->getProximoAssento() . " é o próximo livre.<br>";
echo "Assento" . $voo1->verificaAssento(3) . " ocupado.<br>";
echo $voo1->getVagas() . " assentos livres.<br>";
echo "Número do Voo: " . $voo1->getVoo() . "<br>";
echo "Data do Voo: " . $voo1->getDataVoo()->retornaData();
//print_r($voo1->getAssentos());

?>