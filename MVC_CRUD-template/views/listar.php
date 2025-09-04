<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Listagem de Clientes</title>
</head>
<body>
    <div class="m-3">
        <h1>Clientes</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Email</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php while($cliente = $relacaoClientes->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo $cliente['id']; ?></td>
                    <td><?php echo $cliente['nome']; ?></td>
                    <td><?php echo $cliente['cpf']; ?></td>
                    <td><?php echo $cliente['email']; ?></td>
                    <td><a class="btn btn-warning" href="index.php?controller=cliente&action=alterar&id=<?php echo $cliente['id'] ?>">Editar</a></td>
                    <td><a class="btn btn-danger" href="">Excluir</a></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a class="btn btn-primary mt-3" href="index.php?controller=cliente&action=adicionar">Adicionar Usuário</a>
    </div>
</body>
</html>