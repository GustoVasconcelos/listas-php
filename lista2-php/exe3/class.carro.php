<?php

class Carro
{
    //Atributos
    private float $consumo; // km/L
    private float $combustivel; // litros

    //Construtor
    public function __construct(float $consumo)
    {
        if ($consumo <= 0) {
            throw new Exception("O consumo deve ser um valor positivo.");
        }
        $this->consumo = $consumo;
        $this->combustivel = 0;
    }

    //Métodos
    public function andar(float $distancia): string
    {
        if ($distancia < 0) {
            return "Erro: A distância não pode ser negativa.";
        }

        $combustivelNecessario = $distancia / $this->consumo;

        if ($combustivelNecessario > $this->combustivel) {
            $distanciaPossivel = $this->consumo * $this->combustivel;
            // Retorna a mensagem de erro em vez de usar echo
            return "Combustível insuficiente! Você consegue andar apenas " . round($distanciaPossivel, 2) . " km.";
        } else {
            $this->combustivel -= $combustivelNecessario;
            // Retorna a mensagem de sucesso
            return "Você andou " . $distancia . " km. Combustível restante: " . round($this->combustivel, 2) . " L.";
        }
    }

    public function getCombustivel(): float
    {
        return $this->combustivel;
    }

    public function getConsumo(): float
    {
        return $this->consumo;
    }

    public function setCombustivel(float $litros): string
    {
        if ($litros < 0) {
            // Retorna a mensagem de erro
            return "Erro: Não é possível abastecer com valor negativo.";
        }
        $this->combustivel += $litros;
        // Retorna a mensagem de sucesso
        return "Abastecido com " . $litros . " litros. Tanque atual: " . round($this->combustivel, 2) . " L.";
    }
}