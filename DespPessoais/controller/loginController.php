<?php
session_start();
require_once __DIR__ . "/../model/loginModel.php";

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bt1'])) 
        {
            $user = $_POST['caixauser'] ?? '';
            $pass = $_POST['caixasenha'] ?? '';
            
            $login = new LoginModel();
            $resultado=$login->fazerLogin($user, $pass);
        
            if($resultado>0)
            {
                $_SESSION['user']=$user;
                $_SESSION['pass']=$pass;
                 header("Location: ../view/perfilUsuarioView.php");
                exit(); 
            }
            else
            {
                echo "Usuário e senha não conferem, tente de novo";   
            }
        } 
        else
        {
            echo "Metodo Invalido!";
        }

?>