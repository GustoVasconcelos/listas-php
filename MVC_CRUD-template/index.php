<?php 
    require_once "controllers/ClienteController.php";
    $cliController = new ClienteController();

    $acao = $_POST['acao'];
    if (empty($acao)) {
        $cliController->listar();
    }
    /*
    else if ($acao == 'formAdicionar') { 
        require_once "views/formAdicionar.php";
        ?>        
        <form action="index.php?acao=adicionar" method="post">
            <label for="id">ID:</label><br>
            <input type="text" id="id" name="id"><br>
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome"><br>
            <label for="cpf">CPF:</label><br>
            <input type="text" id="cpf" name="cpf"><br>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email"><br><br>
            <input type="submit" value="Enviar">
        </form>
    <?php 
        
    }
    else if ($acao == 'adicionar') { 
        $cliController->adicionar();
    }
    */
