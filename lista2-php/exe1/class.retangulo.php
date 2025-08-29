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
        if ($novaLargura > 0) {
            $this->largura = $novaLargura;
        }
    }

    public function getAltura(){
        return $this->altura;
    }

    public function setAltura($novaAltura){
        if ($novaAltura > 0) {
            $this->altura = $novaAltura;
        }
    }

    public function ehQuadrado(){
        return $this->largura == $this->altura; // Retorna true ou false
    }
}