<?php
require_once __DIR__ . "/../model/ValorTotalModel.php";

// Configura localização para português
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

if (session_status() === PHP_SESSION_NONE) session_start();

$model = new ValorTotalModel();
$dados = $model->listarDespesas($_SESSION['codUsuario']);

// Agrupa despesas por mês
$despesasPorMes = [];
foreach ($dados as $despesa) {
    $mesAno = $despesa['mes_ano'];
    if (!isset($despesasPorMes[$mesAno])) {
        $despesasPorMes[$mesAno] = [];
    }
    $despesasPorMes[$mesAno][] = $despesa;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Histórico de Despesas</title>
    <style>
        .tabela-mes {
            margin-bottom: 30px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }
        .mes-titulo {
            background-color: #003c6d;
            color: white;
            padding: 10px;
            font-weight: bold;
        }
        .tabela-despesas {
            width: 100%;
            border-collapse: collapse;
        }
        .tabela-despesas th, .tabela-despesas td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        .tabela-despesas th {
            background-color: #f2f2f2;
        }
        .total-mes {
            font-weight: bold;
            background-color: #e6f2ff;
        }
    </style>
</head>
<body>
    <h1>Histórico de Despesas</h1>

    <?php if (empty($despesasPorMes)): ?>
        <p>Nenhuma despesa cadastrada.</p>
    <?php else: ?>
        <?php foreach ($despesasPorMes as $mesAno => $despesas): ?>
            <?php
                $dataMes = DateTime::createFromFormat('Y-m', $mesAno);
                $nomeMes = strftime('%B de %Y', $dataMes->getTimestamp());
                $nomeMes = ucwords($nomeMes); // Garante primeira letra maiúscula
                $totalMes = 0;
            ?>
            
            <div class="tabela-mes">
                <div class="mes-titulo"><?= $nomeMes ?></div>
                <table class="tabela-despesas">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Descrição</th>
                            <th>Valor (R$)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($despesas as $despesa): ?>
                            <?php $totalMes += $despesa['valorInicial']; ?>
                            <tr>
                                <td><?= htmlspecialchars($despesa['dataDespesa']) ?></td>
                                <td><?= htmlspecialchars($despesa['nomeDespesa']) ?></td>
                                <td>R$ <?= number_format($despesa['valorInicial'], 2, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr class="total-mes">
                            <td colspan="2"><strong>Total do Mês</strong></td>
                            <td><strong>R$ <?= number_format($totalMes, 2, ',', '.') ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>