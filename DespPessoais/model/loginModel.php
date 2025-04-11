<?php
require_once __DIR__ . "/../configuracaBanco/connection.php";

session_start();

class LoginModel{
    private $pdo;

    public function __construct(){
        $connection = new BancoDados();
        $this->pdo = $connection->getConnection();
    }

    public function fazerLogin($user, $pass){
       
        $query = "SELECT * FROM usuario WHERE login = ? AND senha = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(1, $user);
        $stmt->bindParam(2, $pass);
        $stmt->execute();
       
        $dado = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['codUsuario'] = $dado['codUsuario'];

        return $stmt->rowCount();
      
    }
}
