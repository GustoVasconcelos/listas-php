<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'class.retangulo.php';
session_start();

// Se não existir um retângulo na sessão, cria um novo
if (!isset($_SESSION['retangulo'])) {
    // Começa com um quadrado 10x10 para ficar mais visível
    $retangulo = new Retangulo();
    $retangulo->setLargura(10);
    $retangulo->setAltura(10);
    $_SESSION['retangulo'] = $retangulo;
}

// Pega o objeto da sessão
$retangulo = $_SESSION['retangulo'];

// Processa o formulário quando enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['largura']) && isset($_POST['altura'])) {
        $largura = (float)$_POST['largura'];
        $altura = (float)$_POST['altura'];
        
        $retangulo->setLargura($largura);
        $retangulo->setAltura($altura);

        // Salva o objeto modificado de volta na sessão
        $_SESSION['retangulo'] = $retangulo;
    }
    // Redireciona para evitar reenvio do formulário
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificador de Retângulo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container my-5" style="max-width: 600px;">
        <header class="text-center mb-4">
            <h1>Verificador de Retângulo</h1>
            <p class="lead">Teste a classe <code>Retangulo</code> de forma visual</p>
        </header>

        <div class="card">
            <div class="card-body">
                <form action="" method="POST">
                    <div class="row g-3 align-items-end">
                        <div class="col">
                            <label for="largura" class="form-label">Largura</label>
                            <input type="number" class="form-control" name="largura" id="largura" min="1" step="any" 
                                   value="<?php echo $retangulo->getLargura(); ?>" required>
                        </div>
                        <div class="col">
                            <label for="altura" class="form-label">Altura</label>
                            <input type="number" class="form-control" name="altura" id="altura" min="1" step="any" 
                                   value="<?php echo $retangulo->getAltura(); ?>" required>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-primary" type="submit">Verificar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h5>Resultado e Visualização</h5>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <?php
                        // Chama o método e define o texto e a classe CSS com base no resultado
                        if ($retangulo->ehQuadrado()) {
                            $resultadoTexto = "É um Quadrado!";
                            $resultadoClasse = "eh-quadrado";
                        } else {
                            $resultadoTexto = "É um Retângulo.";
                            $resultadoClasse = "nao-eh-quadrado";
                        }
                    ?>
                    <h3 class="resultado-texto <?php echo $resultadoClasse; ?>">
                        <?php echo $resultadoTexto; ?>
                    </h3>
                </div>

                <div class="visualizador">
                    <?php
                        // Lógica para desenhar o retângulo
                        // Usamos um multiplicador para que as formas fiquem visíveis na tela
                        $multiplicador = 10;
                        $largura_visual = $retangulo->getLargura() * $multiplicador;
                        $altura_visual = $retangulo->getAltura() * $multiplicador;

                        // Limita o tamanho máximo para não quebrar o layout
                        $largura_visual = min($largura_visual, 400);
                        $altura_visual = min($altura_visual, 300);

                        $estilo = "width: {$largura_visual}px; height: {$altura_visual}px;";
                    ?>
                    <div class="retangulo-desenho" style="<?php echo $estilo; ?>"></div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>