<?php
session_start();
$resultado = isset($_SESSION['resultado_exe5']) ? $_SESSION['resultado_exe5'] : "";
if($resultado != ""){
    $valorParcela = $resultado['parcela'];
    $valorFinanciado = $resultado['financiado'];
    $taxaJuros = $resultado['juros'];
    $qtdeParcelas = $resultado['qtdeParcelas'];
}
unset($_SESSION['resultado_exe5']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Lista 1</title>
</head>
<body>
    <div class="d-flex flex-column container mt-3 border border-1 rounded-2">
        <h2 class="mt-2">Lista 1 - Exercicios PHP</h2>
        <h3 class="mt-3">Exercicio 5</h3>
        <div class="d-flex flex-row pb-3">
            <fieldset class="bloco border border-1 rounded-2 p-2">
                <legend>Calcular Parcelas Price</legend>
                <form action="proc.php" method="post" class="bloco" id="exe5">
                <input type="hidden" name="form_id" value="exe5">
                    <div class="mb-1">
                        <label class="form-label" for="montanteFinanciado">Montante Financiado:</label>
                    </div>
                    <div class="mb-2">
                        <input class="form-control" type="text" name="montanteFinanciado" id="montanteFinanciado">
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="jurosFinanciamento">Juros Financiamento:</label>
                    </div>
                    <div class="mb-2">
                        <input class="form-control" type="text" name="jurosFinanciamento" id="jurosFinanciamento">
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="qntdeParcelas">Quantidade de Parcelas:</label>
                    </div>
                    <div class="mb-2">
                        <input class="form-control" type="text" name="qntdeParcelas" id="qntdeParcelas">
                    </div>
                    <div class="mb-2">
                        <button class="btn btn-primary" type="submit">Calcular</button>
                    </div>
                </form>
            </fieldset>
            <?php
                if ($resultado != ""){
                    echo '<div class="bloco_price border border-1 rounded-2 p-2">';
                    echo '<h3>Sistema de Amortização Price</h3>';
                    echo '<hr>';
                    echo "Montante Financiado: $valorFinanciado<br>";
                    echo "Juros Financiamento: $taxaJuros %<br>";
                    echo "N° de Parcelas: $qtdeParcelas<br>";
                    echo '<hr>';
                    echo "<span>Valor de cada parcela: R$ ". number_format($valorParcela, 2, ',', '.'). "</span>";

                    echo '</div>';
                }
            ?>
        </div>
        <div class="d-grid gap-2 d-md-block mb-3">
            <form action="index.php">
                <button class="btn btn-primary">Voltar</button>
            </form>
        </div>
    </div>
</body>
</html>