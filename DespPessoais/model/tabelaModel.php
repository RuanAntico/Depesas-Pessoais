<?php
require_once __DIR__ . "/../configuracaBanco/connection.php";

class TabelaModel {
    private $pdo;

    public function __construct(){
        $connection = new BancoDados();
        $this->pdo = $connection->getConnection();
    }
    
    public function listarPagamentosComDespesas($codUsuario){
        $query = "
            SELECT 
                dd.data_pag AS dataDespesa,
                dd.nome AS nomeDespesa,
                dd.valor AS valorInicial,
                p.data_pagamento,
                DATE_FORMAT(p.data_pagamento, '%Y-%m') AS mes_ano
            FROM pagamento_despesa pd
            JOIN pagamento p ON pd.codPagamento = p.codPagamento
            JOIN descricaodespesas dd ON pd.codDescDesp = dd.codDescDesp
            WHERE p.codUsuario = :codUsuario
            ORDER BY p.data_pagamento DESC, dd.data_pag DESC
        ";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':codUsuario', $codUsuario);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}