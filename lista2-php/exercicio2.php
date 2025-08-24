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
        $this->Res = $this->Mem += $valor;
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
        $this->Mem = $this->Res;
        $this->Res = sqrt($this->Mem);
    }
}

$calc = new Calculadora();
$calc->soma(5);

echo '<br>', $calc->getRes();

$calc->subtrai(2);

echo '<br>', $calc->getRes();

$calc->multiplica(2);

echo '<br>', $calc->getRes();

$calc->divide(2);

echo '<br>', $calc->getRes();

$calc->potencia(2);

echo '<br>', $calc->getRes();

$calc->porcentagem(66);

echo '<br>', $calc->getRes();

$calc->raiz();

echo '<br>', $calc->getRes();

$calc->desfaz();

echo '<br>', $calc->getRes();

$calc->zerar();

echo '<br>', $calc->getRes();

?>