<?php

#funções do exercicio 1
function calcularAreaCirculo($raio){
    $area = pi() * pow($raio, 2);
    return $area;
}

function calcularAreaTriangulo($base, $altura){
    $area = ($base * $altura) / 2;
    return $area;
}

function calcularAreaQuadrado($lado) {
  return $lado * $lado;
}

function calcularAreaRetangulo($largura, $altura) {
  return $largura * $altura;
}

#funções do exercicio 2
function somaNumero($numero) {
	$numeros = str_split($numero);
	$soma = array_sum($numeros);
	return $soma;
}

#funções do exercicio 3
function calcularPrecoCusto($valorVenda, $porcentagemLucro) {
    if ($porcentagemLucro < 0 || $valorVenda < 0) {
        return "Valores inválidos.";
    }

    $precoCusto = $valorVenda / (1 + ($porcentagemLucro / 100));
    return $precoCusto;
}

#funções do exercicio 4
function calcularMulta($pesoPeixe) {
    $limite = 50;
    $valorPor5kg = 4.00;

    if ($pesoPeixe > $limite) {
        $excedente = $pesoPeixe - $limite;

        $blocosDe5kg = ceil($excedente / 5);

        $multa = $blocosDe5kg * $valorPor5kg;

        return "Peso excedente: {$excedente} kg<br>
                Multa devida: R$ " . number_format($multa, 2, ',', '.');
    } else {
        return "Peso dentro do limite.<br> Nenhuma multa a pagar.";
    }
}

#funções do exercicio 5
function calcularPrice($valorFinanciado, $jurosFinanciamento, $qntdeParcelas) {
    $jurosFinanciamento = $jurosFinanciamento / 100; // Converte a taxa de juros para decimal
    $prestacao = ($valorFinanciado * $jurosFinanciamento) / (1 - pow(1 + $jurosFinanciamento, -$qntdeParcelas));
    return $prestacao;
}

?>