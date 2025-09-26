<?php require '_header.php'; ?>

<div class="card">
    <div class="card-header">
        <h2>Nova Tarefa</h2>
    </div>
    <div class="card-body">
        <form action="index.php?action=create" method="POST">
            <?php if (!empty($erros)): ?>
                <div class="alert alert-danger">
                    <strong>Por favor, corrija os erros abaixo:</strong>
                    <ul>
                        <?php foreach ($erros as $erro): ?>
                            <li><?php echo $erro; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo">
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="data_vencimento" class="form-label">Data de Vencimento</label>
                    <input type="date" class="form-control" id="data_vencimento" name="data_vencimento">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="pendente">Pendente</option>
                        <option value="concluida">Concluída</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="index.php?action=listar" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php require '_footer.php'; ?>