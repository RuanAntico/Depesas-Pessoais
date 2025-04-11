<?php
require_once __DIR__ . "/../model/cadUsuarioModel.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            $nome = $_POST["nome"];
            $cpf = $_POST["cpf"];
            $email = $_POST["email"];
            $data_nasc = $_POST["data_nasc"];
            $telefone = $_POST["telefone"];
            $senha = $_POST["senha"];

            $cadastro = new CadastroModel();

            

            if ($cadastro->cadastrarLogin($nome, $cpf, $email, $data_nasc, $telefone, $senha, "cpf")) 
            {
                header ( "Location: ../view/loginView.php");
                exit();
            } else 
            {
                echo "Erro ao cadastrar o usuário.";
            }
        } else {
            echo "Método inválido.";
        }
?>
