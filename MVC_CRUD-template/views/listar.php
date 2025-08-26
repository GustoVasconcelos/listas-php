<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Clientes</title>
</head>
<body>
    <h1>Clientes</h1>
    <tabble>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php while($cliente = $relacaoClientes->fetch(PDO::FETCH_ASSOC)): ?>
                <td><?php echo $cliente['id']; ?></td>
                <td><?php echo $cliente['nome']; ?></td>
                <td><?php echo $cliente['cpf']; ?></td>
                <td><?php echo $cliente['email']; ?></td>
            <?php endwhile; ?>
        </tbody>
    </tabble>
</body>
</html>