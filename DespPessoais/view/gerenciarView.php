<?php
if (!isset($_SESSION['codUsuario'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Despesas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Gerenciar Despesas</h1>
        
        <?php if (isset($_SESSION['mensagem'])): ?>
            <div class="alert alert-<?= $_SESSION['tipo_mensagem'] === 'sucesso' ? 'success' : 'danger' ?>">
                <?= $_SESSION['mensagem'] ?>
            </div>
            <?php unset($_SESSION['mensagem'], $_SESSION['tipo_mensagem']); ?>
        <?php endif; ?>
        
        <a href="gerenciar.php?action=adicionar" class="btn btn-primary mb-3">Adicionar Despesa</a>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($despesas as $despesa): ?>
                <tr>
                    <td><?= date('d/m/Y', strtotime($despesa['data_pag'])) ?></td>
                    <td><?= htmlspecialchars($despesa['nome_despesa']) ?></td>
                    <td><?= htmlspecialchars($despesa['descricao']) ?></td>
                    <td>R$ <?= number_format($despesa['valor'], 2, ',', '.') ?></td>
                    <td>
                        <a href="gerenciar.php?action=editar&id=<?= $despesa['codDespesa'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="gerenciar.php?action=excluir&id=<?= $despesa['codDespesa'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta despesa?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>