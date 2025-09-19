<?php require '_header.php'; ?>

<div class="card">
    <div class="card-header">
        <h2>Editar Tarefa</h2>
    </div>
    <div class="card-body">
        <form action="index.php?action=edit&id=<?php echo $tarefa['id']; ?>" method="POST">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo htmlspecialchars($tarefa['titulo']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3"><?php echo htmlspecialchars($tarefa['descricao']); ?></textarea>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="data_vencimento" class="form-label">Data de Vencimento</label>
                    <input type="date" class="form-control" id="data_vencimento" name="data_vencimento" value="<?php echo $tarefa['data_vencimento']; ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="pendente" <?php echo $tarefa['status'] == 'pendente' ? 'selected' : ''; ?>>Pendente</option>
                        <option value="concluida" <?php echo $tarefa['status'] == 'concluida' ? 'selected' : ''; ?>>Concluída</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Atualizar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php require '_footer.php'; ?>