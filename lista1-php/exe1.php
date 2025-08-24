<?php
session_start();
$resultado = isset($_SESSION['resultado_exe1']) ? $_SESSION['resultado_exe1'] : "";
if($resultado != ""){
    $resultado_exe = $resultado['exe1'];
    $resultado_valor = $resultado['resultado'];
}
unset($_SESSION['resultado_exe1']);
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
        <h3 class="mt-3">Exercicio 1</h3>
        <div class="d-flex flex-row pb-3">
            <fieldset class="bloco border border-1 rounded-2 p-2">
                <legend>Área Círculo</legend>
                <form action="proc.php" method="post" class="bloco" id="exe1_circulo">
                    <input type="hidden" name="form_id" value="exe1_circulo">
                    <div class="mb-1">
                        <label class="form-label" for="raioCirculo">Digite o raio do Circulo:</label>
                    </div>
                    <div class="mb-2">
                        <input class="form-control" type="text" name="raioCirculo" id="raioCirculo">
                    </div>
                    <div class="mb-2">
                        <button class="btn btn-primary" type="submit">Calcular</button>
                    </div>
                </form>
                <?php
                    if ($resultado != "" && $resultado_exe == "circulo"){
                        echo "<span>Resultado: $resultado_valor </span>";
                    }
                ?>
            </fieldset>
            <fieldset class="bloco border border-1 rounded-2 p-2">
                <legend>Área Triângulo</legend>
                <form action="proc.php" method="post" class="bloco" id="exe1_triangulo">
                    <input type="hidden" name="form_id" value="exe1_triangulo">
                    <div class="mb-1">
                        <label class="form-label" for="baseTriangulo">Digite a base do Triângulo:</label>
                    </div>
                    <div class="mb-2">
                        <input class="form-control" type="text" name="baseTriangulo" id="baseTriangulo">
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="alturaTriangulo">Digite a altura do Triângulo:</label>
                    </div>
                    <div class="mb-2">
                        <input class="form-control" type="text" name="alturaTriangulo" id="alturaTriangulo">
                    </div>
                    <div class="mb-2">
                        <button class="btn btn-primary" type="submit">Calcular</button>
                    </div>
                </form>
                <?php
                    if ($resultado != "" && $resultado_exe == "triangulo"){
                        echo "<span>Resultado: $resultado_valor </span>";
                    }
                ?>
            </fieldset>
            <fieldset class="bloco border border-1 rounded-2 p-2">
                <legend>Área Quadrado</legend>
                <form action="proc.php" method="post" class="bloco" id="exe1_quadrado">
                    <input type="hidden" name="form_id" value="exe1_quadrado">
                    <div class="mb-1">
                        <label class="form-label" for="ladoQuadrado">Digite o lado do Quadrado:</label>
                    </div>
                    <div class="mb-2">
                        <input class="form-control" type="text" name="ladoQuadrado" id="ladoQuadrado">
                    </div>
                    <div class="mb-2">
                        <button class="btn btn-primary" type="submit">Calcular</button>
                    </div>
                </form>
                <?php
                    if ($resultado != "" && $resultado_exe == "quadrado"){
                        echo "<span>Resultado: $resultado_valor </span>";
                    }
                ?>
            </fieldset>
            <fieldset class="bloco border border-1 rounded-2 p-2">
                <legend>Área Retângulo</legend>
                <form action="proc.php" method="post" class="bloco" id="exe1_retangulo">
                    <input type="hidden" name="form_id" value="exe1_retangulo">
                    <div class="mb-1">
                        <label class="form-label" for="larguraRetangulo">Digite a largura do Retângulo:</label>
                    </div>
                    <div class="mb-2">
                        <input class="form-control" type="text" name="larguraRetangulo" id="larguraRetangulo">
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="alturaRetangulo">Digite a altura do Retângulo:</label>
                    </div>
                    <div class="mb-2">
                        <input class="form-control" type="text" name="alturaRetangulo" id="alturaRetangulo">
                    </div>
                    <div class="mb-2">
                        <button class="btn btn-primary" type="submit">Calcular</button>
                    </div>
                </form>
                <?php
                    if ($resultado != "" && $resultado_exe == "retangulo"){
                        echo "<span>Resultado: $resultado_valor </span>";
                    }
                ?>
            </fieldset>
        </div>
        <div class="d-grid gap-2 d-md-block mb-3">
            <form action="index.php">
                <button class="btn btn-primary">Voltar</button>
            </form>
        </div>
    </div>
</body>
</html>