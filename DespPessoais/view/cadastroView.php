<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Despesas</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to right, #ffffff, #6d6d6d);
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
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
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        button[type="submit"] {
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

        button[type="submit"]:hover {
            background-color: #0a2540;
        }
    </style>
</head>
<body>

    <form action="../controller/cadastroController.php" method="POST">
        <div class="campo">
            <h2>Cadastro de Despesas</h2>

            <label for="descricao">Descrição:</label>
            <input type="text" name="descricao" id="descricao" required>

            <label for="categoria">Categoria:</label>
            <input type="text" name="categoria" id="categoria" required>

            <label for="valor">Valor:</label>
            <input type="text" name="valor" id="valor" required>

            <label for="data_pag">Data de Vencimento:</label>
            <input type="date" name="data_pag" id="data_pag" required>

            <button type="submit">Cadastrar</button>
        </div>
    </form>

</body>
</html>
