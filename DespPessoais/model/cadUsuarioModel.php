<?php
require_once __DIR__ . "/../configuracaBanco/connection.php";

class CadastroModel {
    private $pdo;

    public function __construct() {
        $connection = new BancoDados();
        $this->pdo = $connection->getConnection();
    }

    public function cadastrarLogin($nome, $cpf, $email, $data_nasc, $telefone, $senha, $opcaoLogin) {
        try {
            $this->pdo->beginTransaction();
        
            // Primeiro INSERT (cadlogin)
            $query = "INSERT INTO cadlogin (nome, cpf, email, data_nasc, telefone) 
                      VALUES (:nome, :cpf, :email, :data_nasc, :telefone)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":cpf", $cpf);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":data_nasc", $data_nasc);
            $stmt->bindParam(":telefone", $telefone);
            $stmt->execute();
        
            // Pegando o ID gerado automaticamente
            $cod_usuario = $this->pdo->lastInsertId();
        
            // Verifica se o ID foi gerado corretamente
            if (!$cod_usuario) {
                throw new Exception("Erro ao obter cod_usuario.");
            }
        
            // Garante que $login não seja null
            if (empty($cpf) && empty($email)) {
                throw new Exception("CPF e Email não podem estar vazios.");
            }
            
            $login = ($opcaoLogin === "cpf") ? $cpf : $email;
        
            // Segundo INSERT (usuario)
            $query1 = "INSERT INTO usuario (login, senha, codUsuario) VALUES (:login, :senha, :cod_usuario)";
            $stmt = $this->pdo->prepare($query1);
            $stmt->bindParam(":login", $login);
            $stmt->bindParam(":senha", $senha);
            $stmt->bindParam(":cod_usuario", $cod_usuario);
        
            $stmt->execute();
        
            // Confirma a transação
            $this->pdo->commit();
            
            return true;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            echo "Erro no cadastro: " . $e->getMessage();
            return false;
        }
        
        
    }
    
}
