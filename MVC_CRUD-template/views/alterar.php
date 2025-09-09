<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cadastrar Cliente</title>
</head>
<body>
    <div class="m-3">
        <h1>Alterar Cliente</h1>
        <form action="index.php?controller=cliente&action=update" method="POST">
            <input type="hidden" name="id" id="id" value="<?= $usuario['id'] ?>">
            <label for="nome">Nome:</label><br>
            <input type="text" name="nome" id="nome" value="<?= $usuario['nome'] ?>" required><br><br>

            <label for="cpf">CPF:</label><br>
            <input type="text" name="cpf" id="cpf" value="<?= $usuario['cpf'] ?>"><br><br>

            <label for="email">Email:</label><br>
            <input type="email" name="email" id="email" value="<?= $usuario['email'] ?>" required><br><br>

            <button class="btn btn-primary" type="submit">Alterar</button>
        </form>
        <br>
        <a class="btn btn-primary" href="index.php?controller=cliente&action=listar">Voltar</a>
    </div>
</body>
</html>