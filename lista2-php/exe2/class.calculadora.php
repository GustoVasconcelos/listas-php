<?php

class Calculadora
{
    //Atributos
    private float $Res;
    private float $Mem;

    //Construtor
    public function __construct()
    {
        $this->Res = 0;
        $this->Mem = 0;
    }

    //Métodos
    public function zerar()
    {
        $this->Res = 0;
        $this->Mem = 0;
    }

    public function desfaz()
    {
        $this->Res = $this->Mem;
    }

    public function getRes()
    {
        return $this->Res;
    }

    public function soma(float $valor)
    {
        $this->Mem = $this->Res;
        $this->Res += $valor;
    }

    public function subtrai(float $valor)
    {
        $this->Mem = $this->Res;
        $this->Res -= $valor;
    }

    public function multiplica(float $valor)
    {
        $this->Mem = $this->Res;
        $this->Res *= $valor;
    }

    public function divide(float $valor)
    {
        if ($valor == 0) {
            // Lançar uma exceção é uma boa prática para erros críticos
            throw new Exception("Divisão por zero não é permitida.");
        }
        $this->Mem = $this->Res;
        $this->Res /= $valor;
    }

    public function potencia(float $exp)
    {
        $this->Mem = $this->Res;
        $this->Res = pow($this->Mem, $exp);
    }

    public function porcentagem(float $porc)
    {
        $this->Mem = $this->Res;
        $this->Res = ($this->Res / 100 * $porc);
    }

    public function raiz()
    {
        if ($this->Res < 0) {
            throw new Exception("Não é possível calcular a raiz de um número negativo.");
        }
        $this->Mem = $this->Res;
        $this->Res = sqrt($this->Mem);
    }
}

?>