<?php

require_once 'class.calculadora.php';

$calc = new Calculadora();

$calc->soma(5);

echo '<br>Soma 5: ', $calc->getRes();

$calc->subtrai(2);

echo '<br>Subtrai 2: ', $calc->getRes();

$calc->multiplica(2);

echo '<br>Multiplica por 2: ', $calc->getRes();

$calc->divide(2);

echo '<br>Divite por 2: ', $calc->getRes();

$calc->potencia(2);

echo '<br>Faz elevado a 2: ', $calc->getRes();

$calc->porcentagem(66);

echo '<br>Porcentagem(66%): ', $calc->getRes();

$calc->raiz();

echo '<br>Raiz quadrada: ', $calc->getRes();

$calc->desfaz();

echo '<br>Desfaz a altima operacao: ', $calc->getRes();

$calc->zerar();

echo '<br>Zera a calculadora: ', $calc->getRes();

?>