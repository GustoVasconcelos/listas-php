<?php

class Carro
{
    //Atributos
    private $consumo;
    private $combustivel;

    //Construtor
    public function __construct(float $consumo)
    {
        $this->consumo = $consumo;
        $this->combustivel = 0;
    }

    //Métodos
    public function andar($distancia)
    {
        $combustivelNecessario = $distancia / $this->consumo;

        if($combustivelNecessario > $this->combustivel)
        {
            $distanciaPossivel = $this->consumo * $this->combustivel;
            //$this->combustivel = 0;
            echo "Combustível insuficiente! Você consegue andar apenas " . round($distanciaPossivel, 2) . " km.<br>";
            return $distanciaPossivel;
        } else {
            $this->combustivel -= $combustivelNecessario;
            echo "Você andou " . $distancia . " km. ";
            echo "Combustível usado: " . round($combustivelNecessario, 2) . " litros.<br>";
            return $distancia;
        }
    }

    public function getCombustivel() {
        return $this->combustivel;
    }

    public function setCombustivel($litros) {
        if ($litros < 0) {
            echo "Erro: não é possível abastecer com valor negativo.<br>";
            return;
        }
        $this->combustivel += $litros;
        echo "Abastecido com " . $litros . " litros. ";
        echo "Tanque atual: " . round($this->combustivel, 2) . " litros.<br>";
    }
}

// Programa de teste
echo "=== TESTE DA CLASSE CARRO ===<br>";

// Criando um carro com consumo de 12 km/l
$meuCarro = new Carro(12);

echo "<br>Tentando andar 50 km sem combustível:<br>";
$meuCarro->andar(50);

echo "<br>Abastecendo o carro:<br>";
$meuCarro->setCombustivel(40);

echo "<br>Andando 100 km:<br>";
$meuCarro->andar(100);

echo "<br>Andando mais 200 km:<br>";
$meuCarro->andar(200);

echo "<br>Tentando andar 500 km:<br>";
$meuCarro->andar(500);

echo "<br>Abastecendo mais 30 litros:<br>";
$meuCarro->setCombustivel(30);

echo "<br>Tentando andar 500 km:<br>";
$meuCarro->andar(500);
?>