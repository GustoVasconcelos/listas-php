<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "../exe4/class.data.php";
require_once "class.voo.php";

session_start();
$voo = $_SESSION['voo'] ?? null;

// Variáveis para mensagens de feedback ao usuário
$mensagem = '';
$tipo_mensagem = ''; // 'success' ou 'danger' para o Bootstrap

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['form_id']) && $_POST['form_id'] == 'info-voo' && !empty($_POST['numeroVoo'])) {
        $numeroVoo = (int)$_POST['numeroVoo'];
        
        $dia = date('d');
        $mes = date('m');
        $ano = date('Y');
        // Cria o objeto Data
        $dataVoo = new Data($dia, $mes, $ano);

        $_SESSION['voo'] = new Voo($numeroVoo, $dataVoo);

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    if (isset($_POST['ocupar_assento'])) {
        $assento_num = filter_input(INPUT_POST, 'assento_num', FILTER_VALIDATE_INT);
        if ($assento_num && $assento_num >= 1 && $assento_num <= 100) {
            if ($voo->ocupaAssento($assento_num)) {
                $mensagem = "Assento $assento_num ocupado com sucesso!";
                $tipo_mensagem = 'success';
            } else {
                $mensagem = "Erro: O assento $assento_num já está ocupado ou é inválido.";
                $tipo_mensagem = 'danger';
            }
        } else {
            $mensagem = "Por favor, insira um número de assento válido (1-100).";
            $tipo_mensagem = 'danger';
        }
    }
    
    // Ação: Resetar o voo (para testes)
    if (isset($_POST['resetar_voo'])) {
        unset($_SESSION['voo']); // Remove o voo da sessão
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    $_SESSION['voo'] = $voo;
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Exercicio Voo - POO PHP</title>
</head>
<body>

     <div class="container my-4">
        <header class="text-center mb-4">
            <h1>Sistema de Reserva de Voo</h1>
            <p class="lead">Interface de teste para a classe Voo</p>
        </header>

        <div class="info-voo p-3 mb-4 d-flex justify-content-around align-items-center text-center">
            <?php if (!$voo): ?>
                <form class="row g-2 align-items-center" action="" method="post" id="info-voo">
                    <input type="hidden" name="form_id" value="info-voo">
                    <div class="col-auto">
                        <label for="numeroVoo"><strong>Numero do Voo:</strong></label>
                    </div>
                    <div class="col-auto">
                        <input class="form-control" type="text" name="numeroVoo" id="numeroVoo">
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary" type="submit">Criar Voo</button>
                    </div>
                </form>
            <?php else: ?>
                <div><strong>Nº do Voo:</strong> <?php echo $voo->getVoo(); ?></div>
                <div><strong>Data:</strong> <?php echo $voo->getDataVoo()->retornaData(); ?></div>
                <div><strong>Próximo Livre:</strong> <span class="badge bg-primary fs-6"><?php echo $voo->getProximoAssento(); ?></span></div>
                <div><strong>Vagas:</strong> <span class="badge bg-info fs-6"><?php echo $voo->getVagas(); ?></span></div>
            <?php endif; ?>
        </div>
    <?php if ($voo): ?>
        <?php if ($mensagem): ?>
            <div class="alert alert-<?php echo $tipo_mensagem; ?> alert-dismissible fade show" role="alert" id="feedback-alert">
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Mapa de Assentos</h5>
                    </div>
                    <div class="card-body">
                        <div class="mapa-assentos">
                            <?php foreach ($voo->getAssentos() as $numero => $status): ?>
                                <?php $classe_status = $status == 0 ? 'livre' : 'ocupado'; ?>
                                <div class="assento <?php echo $classe_status; ?>" title="Assento <?php echo $numero; ?>">
                                    <?php echo $numero; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Controles</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" class="mb-4">
                            <div class="mb-3">
                                <label for="assento_num" class="form-label">Ocupar Assento:</label>
                                <input type="number" class="form-control" id="assento_num" name="assento_num" min="1" max="100" placeholder="Ex: 5" required>
                            </div>
                            <button type="submit" name="ocupar_assento" class="btn btn-primary w-100">Ocupar</button>
                        </form>
                            
                        <hr>
                            
                        <div class="mb-4">
                            <h6>Legenda:</h6>
                            <div class="d-flex">
                                <div class="legenda-item">
                                    <div class="legenda-cor livre"></div> Livre
                                </div>
                                <div class="legenda-item">
                                    <div class="legenda-cor ocupado"></div> Ocupado
                                </div>
                            </div>
                        </div>

                        <hr>
                            
                        <form action="" method="POST">
                            <button type="submit" name="resetar_voo" class="btn btn-danger w-100" onclick="return confirm('Tem certeza que deseja resetar todos os assentos?');">
                                Resetar Voo
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
        <footer class="text-center text-muted mt-4">
            <p>&copy; <?php echo date('Y'); ?> - Augusto Vasconcelos.</p>
        </footer>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // pega o elemento com o id dos alertas
        const alertElement = document.getElementById('feedback-alert');

        // se o elemento do alerta existir...
        if (alertElement) {
            // cria o timer
            setTimeout(() => {
                // cria uma instância do componente Alert do Bootstrap
                const bsAlert = new bootstrap.Alert(alertElement);
                // chama o método 'close' do Bootstrap, que aciona a animação de fade e remove o alerta
                bsAlert.close();
            }, 7000); // tempo para a mensagem sumir
        }
    </script>
</body>
</html>