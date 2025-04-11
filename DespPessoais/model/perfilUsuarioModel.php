<?php
require_once __DIR__ . "/../configuracaBanco/connection.php";

class PerfilUsuarioModel {
    private $pdo;

    public function __construct() {
        $connection = new BancoDados();
        $this->pdo = $connection->getConnection();
    }

    public function getPerfilUsuario() {
        if (!isset($_SESSION['codUsuario'])) {
            header('Location: loginModel.php');
            return null;
        }

        $id = $_SESSION['codUsuario'];

        $stmt = $this->pdo->prepare("SELECT nome FROM cadlogin WHERE  codUsuario= ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
