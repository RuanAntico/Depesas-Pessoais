<?php
require_once __DIR__ . "/../model/ValorTotalModel.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['codUsuario'])) {
    die("Usuário não autenticado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dataInicio = $_POST["dataInicio"];
    $dataFim = $_POST["dataFim"];
    $codUsuario = $_SESSION['codUsuario'];

    $model = new ValorTotalModel();
    
    // Obter o valor total (como já faz)
    $valorTotal = $model->calcularTotal($codUsuario, $dataInicio, $dataFim);
    
    // Obter todas as despesas do período (novo)
    $despesas = $model->listarDespesas($codUsuario, $dataInicio, $dataFim);

    if ($valorTotal > 0) {
        $dataHoje = date('Y-m-d');
        $model->valorFinal($codUsuario, $dataHoje, $valorTotal, $dataInicio, $dataFim);
        
        echo "<h3>Pagamento registrado com sucesso! Valor Total: R$ " . number_format($valorTotal, 2, ',', '.') . "</h3>";
        
        // Exibir tabela com as despesas
        if (!empty($despesas)) {
            echo "<h4>Despesas do período:</h4>";
            echo "<table border='1' style='width:100%; border-collapse: collapse; margin-top: 20px;'>";
            echo "<thead>
                    <tr>
                        <th>Data</th>
                        <th>Descrição</th>
                        <th>Valor</th>
                        <th>Categoria</th>
                    </tr>
                  </thead>";
            echo "<tbody>";
            
            foreach ($despesas as $despesa) {
                echo "<tr>
                        <td>" . htmlspecialchars($despesa['data']) . "</td>
                        <td>" . htmlspecialchars($despesa['descricao']) . "</td>
                        <td>R$ " . number_format($despesa['valor'], 2, ',', '.') . "</td>
                        <td>" . htmlspecialchars($despesa['categoria']) . "</td>
                      </tr>";
            }
            
            echo "</tbody>";
            echo "</table>";
        }
    } 
    else {
        echo "Nenhuma despesa encontrada no período selecionado.";
    }
}
?>