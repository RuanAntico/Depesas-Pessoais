<?php

class BancoDados{

    private static $host = "localhost"; //endereço do servidor
    private static $bc_nome = "despesas_pessoais"; //nome do banco
    private static $user_name = "root"; //nome do usuario do banco
    private static $senha = ""; //senha do usuario
    private static $pdo = null; //conexão PDO

    public static function getConnection(){
        //O self:: é usado para acessar membros estáticos (propriedades e métodos) dentro da própria classe.
        if(self::$pdo === null){
            try{
                self::$pdo = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$bc_nome, self::$user_name, self::$senha
                );
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (PDOException $exception) {
                // Registra o erro em um log em vez de exibir na tela
                error_log("Erro de conexão: " . $exception->getMessage());
                die("Erro ao conectar ao banco de dados. Tente novamente mais tarde.");
            }
        }
        return self::$pdo;
    }
}

?>