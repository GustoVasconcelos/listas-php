<?php require '_header.php'; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2 class="mb-0">Minhas Tarefas</h2>
        <a href="index.php?action=create" class="btn btn-primary">Nova Tarefa</a>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Vencimento</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($tarefa = $tarefas->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($tarefa['titulo']); ?></td>
                    <td><?php echo htmlspecialchars($tarefa['descricao']); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($tarefa['data_vencimento'])); ?></td>
                    <td>
                        <?php if ($tarefa['status'] == 'concluida'): ?>
                            <span class="badge bg-success">Concluída</span>
                        <?php else: ?>
                            <span class="badge bg-warning text-dark">Pendente</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="index.php?action=edit&id=<?php echo $tarefa['id']; ?>" class="btn btn-sm btn-info">Editar</a>
                        <a href="index.php?action=delete&id=<?php echo $tarefa['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?');">Excluir</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require '_footer.php'; ?>