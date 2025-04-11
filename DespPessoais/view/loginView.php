<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to right, #ffffff, #c0c0c0);
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            width: 320px;
            text-align: center;
        }

        h2 {
            margin-bottom: 1.5rem;
            color: #003c6d;
        }

        label {
            display: block;
            text-align: left;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .btn-submit,
        .btn-secondary {
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-submit {
            background-color: #003c6d;
            color: white;
            margin-bottom: 0.5rem;
        }

        .btn-submit:hover {
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
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Entre na sua conta</h2>

        <form action="../controller/loginController.php" method="POST">
            <label for="caixauser">Login:</label>
            <input type="text" id="caixauser" name="caixauser" required>

            <label for="caixasenha">Senha:</label>
            <input type="password" id="caixasenha" name="caixasenha" required>

            <input type="submit" class="btn-submit" value="Entrar" name="bt1">
        </form>

        <a href="../view/cadUsuarioView.php">
            <button class="btn-secondary" type="button">Criar cadastro</button>
        </a>
    </div>

</body>
</html>
