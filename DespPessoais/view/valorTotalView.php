<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Calcular Despesas</title>
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

        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .btn {
            width: 100%;
            padding: 0.75rem;
            margin-top: 1rem;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: #003c6d;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0a2540;
        }

        .btn-secondary {
            background-color: #ccc;
            color: #333;
        }

        .btn-secondary:hover {
            background-color: #bbb;
        }

        a {
            display: block;
            margin-top: 1rem;
            color: #003c6d;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="campo">
        <h2>Selecione o Período</h2>

        <form method="POST" action="../controller/valorTotalController.php">
            <label for="dataInicio">Data Inicial:</label>
            <input type="date" name="dataInicio" required>

            <label for="dataFim">Data Final:</label>
            <input type="date" name="dataFim" required>

            <button type="submit" class="btn btn-primary">Calcular e Registrar Pagamento</button>
        </form>
    </div>

</body>
</html>
