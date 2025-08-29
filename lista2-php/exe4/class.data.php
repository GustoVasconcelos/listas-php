<?php

class Data
{
    //Atributos
    private int $dia;
    private int $mes;
    private int $ano;

    //Construtores
    public function __construct(int $dia = 0, int $mes = 0, int $ano = 0)
    {
        if (!$this->validarData($dia, $mes, $ano)) {
            throw new Exception("Data inválida: $dia/$mes/$ano");
        }

        $this->dia = $dia;
        $this->mes = $mes;
        $this->ano = $ano;
    }

    //Métodos gets e sets dos atributos

    public function getDia(){
        return $this->dia;
    }

    public function setDia($novoDia){
        $this->dia = $novoDia;
    }

    public function getMes(){
        return $this->mes;
    }

    public function setMes($novoMes){
        $this->mes = $novoMes;
    }

    public function getAno(){
        return $this->ano;
    }

    public function setAno($novoAno){
        $this->ano = $novoAno;
    }

    //Métodos
    public function validarData($dia, $mes, $ano) : bool
    {
        if ($ano < 1 || $mes < 1 || $mes > 12 || $dia < 1)
            return false;
        
        return $dia <= $this->diasNoMes($mes, $ano);
    }

    public function diasNoMes($mes, $ano): int
    {
        $diasPorMes = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

        //verifica se o ano é bissexto
        if($mes == 2 && $this->anoBissexto($ano))
        {
            return 29;
        }

        return $diasPorMes[$mes - 1];
    }

    public function adicionarDia(): void
    {
        $this->dia++;

        if ($this->dia > $this->diasNoMes($this->mes, $this->ano)) {
            $this->dia = 1;
            $this->mes++;

            if ($this->mes > 12) {
                $this->mes = 1;
                $this->ano++;
            }
        }
    }

    public function diminuirDia(): void
    {
        $this->dia--;

        if ($this->dia < 1) {
            $this->mes--;

            if ($this->mes < 1) {
                $this->mes = 12;
                $this->ano--;
            }

            $this->dia = $this->diasNoMes($this->mes, $this->ano);
        }
    }

    public function retornaData()
    {
        $data = sprintf("%02d", $this->getDia()) . "/" . sprintf("%02d", $this->getMes()) . "/" . $this->getAno();
        return $data;
    }

    //função para usar no construtor, antes de atribuir os valores nos atributos na instanciação do objeto
    function anoBissexto($ano) : bool 
    {
        return (($ano % 4 == 0 && $ano % 100 != 0) || $ano % 400 == 0);
    }

    //função para o objeto usar após instanciado
    public function ehAnoBissexto(): bool
    {
        return $this->anoBissexto($this->ano);
    }

    function comparaDatas($dia, $mes, $ano)
    {
        if ($this->getDia() == $dia && $this->getMes() == $mes && $this->getAno() == $ano)
            return 0;
        if ($this->getDia() > $dia || $this->getMes() > $mes || $this->getAno() > $ano)
            return 1;
        else
            return -1;
    }

    private function totalDiasDesdeInicio(): int
    {
        $dias = 0;

        // Adiciona dias completos dos anos anteriores
        for ($ano = 1; $ano < $this->ano; $ano++) {
            $dias += $this->anoBissexto($ano) ? 366 : 365;
        }

        // Adiciona dias completos dos meses anteriores
        for ($mes = 1; $mes < $this->mes; $mes++) {
            $dias += $this->diasNoMes($mes, $this->ano);
        }

        // Adiciona os dias do mês atual
        $dias += $this->dia;

        return $dias;
    }

    public function diferencaEmDias(Data $outra): int
    {
        return abs($this->totalDiasDesdeInicio() - $outra->totalDiasDesdeInicio());
    }
}

// Programa de teste
//echo "=== TESTE DA CLASSE DATA ===<br><br>";

//$data = new Data(20, 03, 1989);

//echo $data->retornaData() . "<br>";

//$data->adicionarDia();
//echo $data->retornaData() . "<br>";

//$data->diminuirDia();
//echo $data->retornaData() . "<br>";

//if ($data->ehAnoBissexto())
//    echo $data->getAno() . " é ano bissexto<br>";
//else
//    echo $data->getAno() . " não é ano bissexto<br>";

//$data1 = new Data(21, 07, 2025);
//$data2 = new Data(01, 07, 2025);

//echo "Diferença: " . $data1->diferencaEmDias($data2) . " dias<br>"; // 11 dias

//echo $data->comparaDatas(20, 03, 1989);

?>