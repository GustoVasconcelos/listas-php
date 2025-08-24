<?php
require_once 'functions.php';
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $formId = $_POST['form_id'];
    
    #exercicio 1 - area circulo
    if($formId == 'exe1_circulo' && !empty($_POST['raioCirculo'])){
        $raioCirculo = $_POST['raioCirculo'];
        $areaCirculo = calcularAreaCirculo($raioCirculo);

        $_SESSION['resultado_exe1'] = [
            'exe1' => 'circulo',
            'resultado' => $areaCirculo
        ];

        header("Location: exe1.php");
        exit;
    }

    #exercicio 1 - area triangulo
    if($formId == 'exe1_triangulo' && !empty($_POST['baseTriangulo']) && !empty($_POST['alturaTriangulo'])){
        $baseTriangulo = $_POST['baseTriangulo'];
        $alturaTriangulo = $_POST['alturaTriangulo'];
        $areaTriangulo = calcularAreaTriangulo($baseTriangulo, $alturaTriangulo);

        $_SESSION['resultado_exe1'] = [
            'exe1' => 'triangulo',
            'resultado' => $areaTriangulo
        ];

        header("Location: exe1.php");
        exit;
    }

    #exercicio 1 - area quadrado
    if($formId == 'exe1_quadrado' && !empty($_POST['ladoQuadrado'])){
        $ladoQuadrado = $_POST['ladoQuadrado'];
        $areaQuadrado = calcularAreaQuadrado($ladoQuadrado);

        $_SESSION['resultado_exe1'] = [
            'exe1' => 'quadrado',
            'resultado' => $areaQuadrado
        ];

        header("Location: exe1.php");
        exit;
    }

    #exercicio 1 - area retangulo
    if($formId == 'exe1_retangulo' && !empty($_POST['larguraRetangulo']) && !empty($_POST['alturaRetangulo'])){
        $larguraRetangulo = $_POST['larguraRetangulo'];
        $alturaRetangulo = $_POST['alturaRetangulo'];
        $areaRetangulo = calcularAreaRetangulo($larguraRetangulo, $alturaRetangulo);

        $_SESSION['resultado_exe1'] = [
            'exe1' => 'retangulo',
            'resultado' => $areaRetangulo
        ];

        header("Location: exe1.php");
        exit;
    }

    #exercicio 2 - somar numero
    if($formId == 'exe2' && !empty($_POST['somaNumero'])){
        $numero = $_POST['somaNumero'];
        $resultado = somaNumero($numero);

        $_SESSION['resultado_exe2'] = $resultado;

        header("Location: exe2.php");
        exit;
    }

    #exercicio 3 - calcular preço de custo
    if($formId == 'exe3' && !empty($_POST['valorVenda']) && !empty($_POST['porcentagemLucro'])){
        $valorVenda = $_POST['valorVenda'];
        $porcentagemLucro = $_POST['porcentagemLucro'];
        $valorCusto = calcularPrecoCusto($valorVenda, $porcentagemLucro);

        $_SESSION['resultado_exe3'] = $valorCusto;

        header("Location: exe3.php");
        exit;
    }

    #exercicio 4 - calcular multa peso peixe
    if($formId == 'exe4' && !empty($_POST['pesoPeixe'])){
        $pesoPeixe = $_POST['pesoPeixe'];
        $valorMulta = calcularMulta($pesoPeixe);

        $_SESSION['resultado_exe4'] = $valorMulta;

        header("Location: exe4.php");
        exit;
    }

    #exercicio 5 - calcular parcelas sistema price
    if($formId == 'exe5' && !empty($_POST['montanteFinanciado']) && !empty($_POST['jurosFinanciamento']) && !empty($_POST['qntdeParcelas'])){
        $montanteFinanciado = $_POST['montanteFinanciado'];
        $jurosFinanciamento = $_POST['jurosFinanciamento'];
        $qntdeParcelas = $_POST['qntdeParcelas'];
        $valor_parcela = calcularPrice($montanteFinanciado, $jurosFinanciamento, $qntdeParcelas);

        $_SESSION['resultado_exe5'] = [
            'parcela' => $valor_parcela,
            'financiado' => $montanteFinanciado,
            'juros' => $jurosFinanciamento,
            'qtdeParcelas' => $qntdeParcelas
        ];

        header("Location: exe5.php");
        exit;
    }
}

header("Location: index.php");
exit;

?>
