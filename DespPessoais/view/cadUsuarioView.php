<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to right, #ffffff, #6d6d6d);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .campo {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            width: 350px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h2 {
            color: #003c6d;
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            text-align: left;
            margin-top: 0.8rem;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        input[type="submit"] {
            margin-top: 1.5rem;
            width: 100%;
            padding: 0.75rem;
            background-color: #003c6d;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0a2540;
        }
    </style>
</head>
<body>

    <form action="../controller/CadUsuarioController.php" method="POST">
        <div class="campo">
            <h2>Cadastro de Usuário</h2>

            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" required>

            <label for="data_nasc">Data de Nascimento:</label>
            <input type="date" id="data_nasc" name="data_nasc" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <input type="submit" value="Cadastrar" name="bt1">
        </div>
    </form>

</body>
</html>
