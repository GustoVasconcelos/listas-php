<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cadastrar Cliente</title>
</head>
<body>
    <div class="m-3">
        <h1>Alterar Cliente</h1>
        <?php $usuario = $user->fetch(PDO::FETCH_ASSOC) ?>
        <form action="index.php?controller=cliente&action=update" method="POST">
            <input type="hidden" name="id" id="id" value="<?php echo $usuario['id'] ?>">
            <label for="nome">Nome:</label><br>
            <input type="text" name="nome" id="nome" value="<?php echo $usuario['nome'] ?>" required><br><br>

            <label for="cpf">CPF:</label><br>
            <input type="text" name="cpf" id="cpf" value="<?php echo $usuario['cpf'] ?>"><br><br>

            <label for="email">Email:</label><br>
            <input type="email" name="email" id="email" value="<?php echo $usuario['email'] ?>" required><br><br>

            <button class="btn btn-primary" type="submit">Alterar</button>
        </form>
        <br>
        <a class="btn btn-primary" href="index.php?controller=cliente&action=listar">Voltar</a>
    </div>
</body>
</html>