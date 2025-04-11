<?php
require_once __DIR__ . "/../model/cadastroModel.php";
    

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $descricao = $_POST ["descricao"]; 
        $categoria = $_POST["categoria"];
        $valor = $_POST["valor"];
        $data_pag = $_POST["data_pag"];
        $cadastro = new cadModel();
        if ($cadastro->cadastrarDespesas($descricao, $categoria, $valor, $data_pag)) 
        {
            header ( "Location: ../view/perfilUsuarioView.php?pagina=cadastrar_despesas");
            exit();
        } else 
        {
            return "Erro ao registrar a despesa."; 
        }
        
    }

?>