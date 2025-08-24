<?php

class Retangulo
{
    //Atributos
    private $largura;
    private $altura;

    //Construtor
    public function __construct ()
    {
        $this->largura = 1;
        $this->altura = 1;
    }

    //Métodos
    public function getLargura(){
        return $this->largura;
    }

    public function setLargura($novaLargura){
        $this->largura = $novaLargura;
    }

    public function getAltura(){
        return $this->altura;
    }

    public function setAltura($novaAltura){
        $this->altura = $novaAltura;
    }

    public function ehQuadrado(){
        return $this->largura == $this->altura ? "É quadrado." : "Não é quadrado.";
    }
}

$r1 = new Retangulo();
$r1->setAltura(2);
$r1->setLargura(2);

echo $r1->ehQuadrado();

?>