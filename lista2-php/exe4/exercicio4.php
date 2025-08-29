<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'class.data.php';
session_start();

// --- LÓGICA DE CONTROLE (BACK-END) ---

// Variáveis para armazenar os objetos e resultados
$data_principal = $_SESSION['data_principal'] ?? null;
$data_secundaria = $_SESSION['data_secundaria'] ?? null;
$resultado_diferenca = null;
$mensagem_erro = null;

// Processa as ações enviadas via formulário (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Ação: Criar ou atualizar a data principal
        if (isset($_POST['criar_data_principal'])) {
            $dia = (int)$_POST['dia'];
            $mes = (int)$_POST['mes'];
            $ano = (int)$_POST['ano'];
            $_SESSION['data_principal'] = new Data($dia, $mes, $ano);
        }

        // Ação: Adicionar um dia na data principal
        if (isset($_POST['adicionar_dia']) && $data_principal) {
            $data_principal->adicionarDia();
            $_SESSION['data_principal'] = $data_principal;
        }

        // Ação: Diminuir um dia na data principal
        if (isset($_POST['diminuir_dia']) && $data_principal) {
            $data_principal->diminuirDia();
            $_SESSION['data_principal'] = $data_principal;
        }

        // Ação: Criar ou atualizar a data secundária
        if (isset($_POST['criar_data_secundaria'])) {
            $dia = (int)$_POST['dia2'];
            $mes = (int)$_POST['mes2'];
            $ano = (int)$_POST['ano2'];
            $_SESSION['data_secundaria'] = new Data($dia, $mes, $ano);
        }
        
        // Ação: Resetar a sessão
        if (isset($_POST['resetar'])) {
            session_destroy();
        }

    } catch (Exception $e) {
        // Captura a exceção de data inválida do construtor
        $mensagem_erro = $e->getMessage();
    }
    
    // Redireciona para a mesma página para limpar o POST e evitar reenvio
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Recarrega os objetos da sessão após o processamento
$data_principal = $_SESSION['data_principal'] ?? null;
$data_secundaria = $_SESSION['data_secundaria'] ?? null;

// Se ambas as datas existem, calcula a diferença
if ($data_principal && $data_secundaria) {
    $resultado_diferenca = $data_principal->diferencaEmDias($data_secundaria);
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manipulador de Datas com PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container my-5">
        <header class="text-center mb-4">
            <h1>Manipulador de Datas</h1>
            <p class="lead">Interface de teste para a classe <code>Data</code> em PHP</p>
        </header>

        <?php if ($mensagem_erro): ?>
            <div class="alert alert-danger" role="alert">
                <strong>Erro:</strong> <?php echo $mensagem_erro; ?>
            </div>
        <?php endif; ?>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5>Painel da Data Principal</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" class="mb-3">
                            <div class="row g-2 align-items-end">
                                <div class="col">
                                    <label for="dia" class="form-label">Dia</label>
                                    <input type="number" class="form-control" name="dia" id="dia" placeholder="DD" value="<?php echo $data_principal ? $data_principal->getDia() : ''; ?>" required>
                                </div>
                                <div class="col">
                                    <label for="mes" class="form-label">Mês</label>
                                    <input type="number" class="form-control" name="mes" id="mes" placeholder="MM" value="<?php echo $data_principal ? $data_principal->getMes() : ''; ?>" required>
                                </div>
                                <div class="col">
                                    <label for="ano" class="form-label">Ano</label>
                                    <input type="number" class="form-control" name="ano" id="ano" placeholder="AAAA" value="<?php echo $data_principal ? $data_principal->getAno() : ''; ?>" required>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-primary" type="submit" name="criar_data_principal">Definir</button>
                                </div>
                            </div>
                        </form>
                        
                        <?php if ($data_principal): ?>
                            <hr>
                            <h6 class="text-center mb-3">Data Atual: <span class="fs-4 text-primary"><?php echo $data_principal->retornaData(); ?></span></h6>
                            <p><strong>Ano Bissexto?</strong> <?php echo $data_principal->ehAnoBissexto() ? 'Sim' : 'Não'; ?></p>
                            
                            <div class="d-flex justify-content-center gap-2 mt-3">
                                <form action="" method="POST">
                                    <button class="btn btn-secondary" type="submit" name="diminuir_dia">-1 Dia</button>
                                </form>
                                <form action="" method="POST">
                                    <button class="btn btn-secondary" type="submit" name="adicionar_dia">+1 Dia</button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5>Calculadora de Datas</h5>
                    </div>
                    <div class="card-body">
                        <?php if (!$data_principal): ?>
                            <div class="alert alert-info">Defina a Data Principal primeiro para habilitar a calculadora.</div>
                        <?php else: ?>
                            <form action="" method="POST" class="mb-3">
                                <label class="form-label">Definir Segunda Data (para comparação):</label>
                                <div class="row g-2 align-items-end">
                                    <div class="col"><input type="number" class="form-control" name="dia2" placeholder="DD" value="<?php echo $data_secundaria ? $data_secundaria->getDia() : ''; ?>" required></div>
                                    <div class="col"><input type="number" class="form-control" name="mes2" placeholder="MM" value="<?php echo $data_secundaria ? $data_secundaria->getMes() : ''; ?>" required></div>
                                    <div class="col"><input type="number" class="form-control" name="ano2" placeholder="AAAA" value="<?php echo $data_secundaria ? $data_secundaria->getAno() : ''; ?>" required></div>
                                    <div class="col-auto"><button class="btn btn-success" type="submit" name="criar_data_secundaria">Calcular</button></div>
                                </div>
                            </form>

                            <?php if ($resultado_diferenca !== null): ?>
                                <hr>
                                <div class="p-3 text-center rounded resultado">
                                    <p class="mb-1">Diferença entre <?php echo $data_principal->retornaData(); ?> e <?php echo $data_secundaria->retornaData(); ?>:</p>
                                    <span class="display-4"><?php echo $resultado_diferenca; ?></span>
                                    <p class="mb-0">dias</p>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
             <form action="" method="POST">
                <button type="submit" name="resetar" class="btn btn-danger">Resetar Sessão</button>
            </form>
        </div>
    </div>
</body>
</html>