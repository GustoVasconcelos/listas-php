<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'class.carro.php';
session_start();

// Padrão "Flash Message": Pega a mensagem da sessão e a apaga em seguida.
$mensagem = $_SESSION['mensagem'] ?? null;
unset($_SESSION['mensagem']);

// Carrega o objeto carro da sessão
$carro = $_SESSION['carro'] ?? null;

// Processa os formulários
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mensagem_retorno = '';

    try {
        // Ação: Criar um novo carro
        if (isset($_POST['criar_carro'])) {
            $consumo = (float)str_replace(',', '.', $_POST['consumo']); // Aceita vírgula ou ponto
            $_SESSION['carro'] = new Carro($consumo);
            $mensagem_retorno = "Carro criado com sucesso! Consumo de {$consumo} km/L.";
        }
        
        // As ações abaixo só funcionam se o carro já existir
        if ($carro) {
            // Ação: Abastecer
            if (isset($_POST['abastecer'])) {
                $litros = (float)str_replace(',', '.', $_POST['litros']);
                $mensagem_retorno = $carro->setCombustivel($litros);
            }

            // Ação: Andar
            if (isset($_POST['andar'])) {
                $distancia = (float)str_replace(',', '.', $_POST['distancia']);
                $mensagem_retorno = $carro->andar($distancia);
            }

            // Salva o estado atualizado do carro de volta na sessão
            $_SESSION['carro'] = $carro;
        }

        // Ação: Resetar
        if (isset($_POST['resetar'])) {
            session_destroy();
        }

    } catch (Exception $e) {
        $mensagem_retorno = "Erro: " . $e->getMessage();
    }

    // Salva a mensagem de retorno na sessão para ser exibida após o redirect
    $_SESSION['mensagem'] = $mensagem_retorno;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulador de Carro com PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container my-5" style="max-width: 700px;">
        <header class="text-center mb-4">
            <h1>Simulador de Carro</h1>
            <p class="lead">Interface de teste para a classe <code>Carro</code></p>
        </header>

        <?php if ($mensagem): ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <?php echo $mensagem; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (!$carro): ?>
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Crie seu Carro</h5>
                    <p>Primeiro, defina o consumo do seu carro em quilômetros por litro (km/L).</p>
                    <form action="" method="POST" class="d-flex justify-content-center align-items-center gap-2">
                        <input type="text" class="form-control" name="consumo" placeholder="Ex: 12.5" required>
                        <button class="btn btn-primary" type="submit" name="criar_carro">Criar</button>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Painel do Carro</h5>
                </div>
                <div class="card-body text-center">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Consumo</h6>
                            <p class="fs-4"><?php echo $carro->getConsumo(); ?> km/L</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Combustível no Tanque</h6>
                            <p class="fs-4 text-primary fw-bold"><?php echo round($carro->getCombustivel(), 2); ?> L</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>Ações</h5>
                </div>
                <div class="card-body">
                    <form action="" method="POST" class="mb-3 d-flex justify-content-between align-items-center">
                        <div>
                            <label for="litros" class="form-label"><strong>Abastecer (Litros):</strong></label>
                            <input type="text" class="form-control" id="litros" name="litros" required>
                        </div>
                        <button class="btn btn-success" type="submit" name="abastecer">Abastecer</button>
                    </form>
                    <hr>
                    <form action="" method="POST" class="d-flex justify-content-between align-items-center">
                         <div>
                            <label for="distancia" class="form-label"><strong>Andar (km):</strong></label>
                            <input type="text" class="form-control" id="distancia" name="distancia" required>
                        </div>
                        <button class="btn btn-warning" type="submit" name="andar">Dirigir</button>
                    </form>
                </div>
            </div>

            <div class="text-center mt-4">
                <form action="" method="POST">
                    <button type="submit" name="resetar" class="btn btn-danger">Criar Novo Carro (Resetar)</button>
                </form>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>