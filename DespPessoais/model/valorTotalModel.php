<?php
require_once __DIR__ . "/../configuracaBanco/connection.php";

class ValorTotalModel {
    private $pdo;

    public function __construct(){
        $connection = new BancoDados();
        $this->pdo = $connection->getConnection();
    }

   
    public function calcularTotal($codUsuario, $dataInicio, $dataFim){
        $query = "SELECT SUM(dd.valor) AS total
                  FROM despesas d
                  JOIN descricaodespesas dd ON d.codDescDesp = dd.codDescDesp
                  WHERE d.codUsuario = :codUsuario
                  AND dd.data_pag BETWEEN :dataInicio AND :dataFim";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':codUsuario', $codUsuario);
        $stmt->bindParam(':dataInicio', $dataInicio);
        $stmt->bindParam(':dataFim', $dataFim);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['total'] ?? 0;
    }

    public function valorFinal($codUsuario, $dataPagamento, $valorTotal, $dataInicio, $dataFim){
        $query = "INSERT INTO pagamento (codUsuario, data_pagamento, valor_total) 
                  VALUES (:codUsuario, :data_pagamento, :valor_total)";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':codUsuario', $codUsuario);
        $stmt->bindParam(':data_pagamento', $dataPagamento);
        $stmt->bindParam(':valor_total', $valorTotal);
        $stmt->execute();

        $codPagamento = $this->pdo->lastInsertId();

        $this->registrarDespesasNoPagamento($codPagamento, $codUsuario, $dataInicio, $dataFim);

        return true;
    }


    private function registrarDespesasNoPagamento($codPagamento, $codUsuario, $dataInicio, $dataFim){
        $query = "SELECT dd.codDescDesp
                  FROM despesas d
                  JOIN descricaodespesas dd ON d.codDescDesp = dd.codDescDesp
                  WHERE d.codUsuario = :codUsuario
                  AND dd.data_pag BETWEEN :dataInicio AND :dataFim";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':codUsuario', $codUsuario);
        $stmt->bindParam(':dataInicio', $dataInicio);
        $stmt->bindParam(':dataFim', $dataFim);
        $stmt->execute();

        $despesas = $stmt->fetchAll(PDO::FETCH_COLUMN);

        foreach ($despesas as $codDescDesp) {
            $insert = $this->pdo->prepare(
                "INSERT INTO pagamento_despesa (codPagamento, codDescDesp)
                 VALUES (:codPagamento, :codDescDesp)"
            );
            $insert->bindParam(':codPagamento', $codPagamento);
            $insert->bindParam(':codDescDesp', $codDescDesp);
            $insert->execute();
        }
    }

    public function mesAtual ($codUsuario)
    {
        $query = "
        SELECT data_pagamento
        FROM pagamento pag
        WHERE pag.codUsuario = :codUsuario
        ORDER BY pag.data_pagamento DESC
    ";

    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(':codUsuario', $codUsuario);
    $stmt->execute();

    $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $dtPag = $dados['data_pagamento'];
        
    if (substr($dtPag, 5, -3) <> substr(date('Y-m-d'),5, -3))
    {
        $mesDiff = true;
    }
    else
    {
        $mesDiff = false;
    }

    return;
    }

    public function listarDespesas($codUsuario) {
        $sql = "SELECT 
                    dd.data_pag AS dataDespesa,
                    dd.nome AS nomeDespesa,
                    dd.valor AS valorInicial,
                    DATE_FORMAT(dd.data_pag, '%Y-%m') AS mes_ano
                FROM descricaodespesas dd
                JOIN despesas d ON dd.codDescDesp = d.codDescDesp
                WHERE d.codUsuario = :codUsuario
                ORDER BY dd.data_pag DESC";
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':codUsuario', $codUsuario);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
