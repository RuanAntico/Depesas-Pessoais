<?php
require_once __DIR__ . "/../configuracaBanco/connection.php";

session_start();
class cadModel{
    private $pdo;

    public function __construct(){
        $connection = new BancoDados();
        $this->pdo = $connection->getConnection();
    }

    public function cadastrarDespesas($descricao, $categoria, $valor, $data_pag){
        
        $queryCategoria = "INSERT INTO  categoria(nome)  VALUES(:categoria)";
        $stmt2 = $this->pdo->prepare($queryCategoria);
        $stmt2->bindParam(":categoria", $categoria);
        $stmt2->execute();
        $codCategoria = $this->pdo->lastInsertId();

        $queryDespesa = "INSERT INTO  descricaodespesas(nome, valor, data_pag)  VALUES(:nome, :valor, :data_pag)";//criar tabela com nome despesas e colunas com os nomes<-
        $stmt = $this->pdo->prepare($queryDespesa);
        $stmt->bindParam(":nome", $descricao);
        $stmt->bindParam(":valor", $valor);
        $stmt->bindParam(":data_pag", $data_pag);
        $stmt->execute();
        $codDescDesp = $this->pdo->lastInsertId();

        $codUsuario = $_SESSION['codUsuario'] ?? null;
        if (!$codUsuario) {
            die("Sessão inválida. Usuário não está logado.");
        }
        if ($this->cadastrarRelacionamento($codDescDesp, $codCategoria, $_SESSION['codUsuario'])) {
            echo "Cadastro realizado";
        } else {
            echo "Erro";
        }
        
        return true;
    }

    public function cadastrarRelacionamento($codDescDesp, $codCategoria, $codUsuario)
    {
        $query3 = "INSERT INTO despesas (codUsuario, codCategoria, codDescDesp) VALUES (:codUsuario, :codCategoria, :codDescDesp )";
        $stmt3 = $this->pdo->prepare($query3);
        $stmt3->bindParam(":codUsuario", $_SESSION['codUsuario']);
        $stmt3->bindParam(":codCategoria", $codCategoria);
        $stmt3->bindParam(":codDescDesp", $codDescDesp);
        $stmt3->execute(); 

        return true;

    }
}

?>