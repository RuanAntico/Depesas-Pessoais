<?php
require_once __DIR__ . '/../configuracaBanco/connection.php';

class GerenciarModel {
    private $conn;

    public function __construct() {
        $connection = new BancoDados();
        $this->conn = $connection->getConnection();
    }

    // Listar todas as despesas do usuário
    public function listarDespesas($codUsuario) {
        $query = "SELECT d.*, dd.nome AS nome_despesa, dd.descricao, dd.valor, dd.data_pag 
                  FROM despesas d
                  JOIN descricaodespesas dd ON d.codDescDesp = dd.codDescDesp
                  WHERE d.codUsuario = :codUsuario
                  ORDER BY dd.data_pag DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codUsuario', $codUsuario);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obter despesa específica
    public function obterDespesa($codDespesa, $codUsuario) {
        $query = "SELECT d.*, dd.nome AS nome_despesa, dd.descricao, dd.valor, dd.data_pag 
                  FROM despesas d
                  JOIN descricaodespesas dd ON d.codDescDesp = dd.codDescDesp
                  WHERE d.codDespesa = :codDespesa AND d.codUsuario = :codUsuario";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codDespesa', $codDespesa);
        $stmt->bindParam(':codUsuario', $codUsuario);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Adicionar nova despesa
    public function adicionarDespesa($codUsuario, $dados) {
        // Primeiro insere na descricao_despesas
        $queryDesc = "INSERT INTO descricaodespesas (nome, descricao, valor, data_pag) 
                      VALUES (:nome, :descricao, :valor, :data_pag)";
        
        $stmtDesc = $this->conn->prepare($queryDesc);
        $stmtDesc->bindParam(':nome', $dados['nome']);
        $stmtDesc->bindParam(':descricao', $dados['descricao']);
        $stmtDesc->bindParam(':valor', $dados['valor']);
        $stmtDesc->bindParam(':data_pag', $dados['data_pag']);
        $stmtDesc->execute();
        
        $codDescDesp = $this->conn->lastInsertId();
        
        // Depois insere na tabela despesas
        $queryDesp = "INSERT INTO despesas (codUsuario, codDescDesp) 
                      VALUES (:codUsuario, :codDescDesp)";
        
        $stmtDesp = $this->conn->prepare($queryDesp);
        $stmtDesp->bindParam(':codUsuario', $codUsuario);
        $stmtDesp->bindParam(':codDescDesp', $codDescDesp);
        
        return $stmtDesp->execute();
    }

    // Atualizar despesa
    public function atualizarDespesa($codDespesa, $codUsuario, $dados) {
        // Primeiro obtém o codDescDesp
        $queryGet = "SELECT codDescDesp FROM despesas WHERE codDespesa = :codDespesa AND codUsuario = :codUsuario";
        $stmtGet = $this->conn->prepare($queryGet);
        $stmtGet->bindParam(':codDespesa', $codDespesa);
        $stmtGet->bindParam(':codUsuario', $codUsuario);
        $stmtGet->execute();
        $result = $stmtGet->fetch(PDO::FETCH_ASSOC);
        
        if (!$result) return false;
        
        $codDescDesp = $result['codDescDesp'];
        
        // Atualiza a descricao_despesas
        $query = "UPDATE descricaodespesas 
                  SET nome = :nome, descricao = :descricao, valor = :valor, data_pag = :data_pag
                  WHERE codDescDesp = :codDescDesp";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $dados['nome']);
        $stmt->bindParam(':descricao', $dados['descricao']);
        $stmt->bindParam(':valor', $dados['valor']);
        $stmt->bindParam(':data_pag', $dados['data_pag']);
        $stmt->bindParam(':codDescDesp', $codDescDesp);
        
        return $stmt->execute();
    }

    // Excluir despesa
    public function excluirDespesa($codDespesa, $codUsuario) {
        // Primeiro obtém o codDescDesp para excluir da descricaodespesas
        $queryGet = "SELECT codDescDesp FROM despesas WHERE codDespesa = :codDespesa AND codUsuario = :codUsuario";
        $stmtGet = $this->conn->prepare($queryGet);
        $stmtGet->bindParam(':codDespesa', $codDespesa);
        $stmtGet->bindParam(':codUsuario', $codUsuario);
        $stmtGet->execute();
        $result = $stmtGet->fetch(PDO::FETCH_ASSOC);
        
        if (!$result) return false;
        
        $codDescDesp = $result['codDescDesp'];
        
        // Exclui da tabela despesas
        $queryDesp = "DELETE FROM despesas WHERE codDespesa = :codDespesa";
        $stmtDesp = $this->conn->prepare($queryDesp);
        $stmtDesp->bindParam(':codDespesa', $codDespesa);
        $stmtDesp->execute();
        
        // Exclui da tabela descricaodespesas
        $queryDesc = "DELETE FROM descricaodespesas WHERE codDescDesp = :codDescDesp";
        $stmtDesc = $this->conn->prepare($queryDesc);
        $stmtDesc->bindParam(':codDescDesp', $codDescDesp);
        
        return $stmtDesc->execute();
    }
}
?>