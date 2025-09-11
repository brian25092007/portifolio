<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Cadastro</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: grey;
        }

        div {
            background-color: rgba(0, 0, 0, 0.8);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 80px;
            border-radius: 15px;
            color: #fff;
        }

        input {
            padding: 15px;
            border: none;
            outline: none;
            font-size: 15px;
            width: 100%;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        button {
            background-color: blue;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 10px;
            color: white;
            font-size: 15px;
            margin-bottom: 15px;
        }

        button:hover {
            background-color: blue;
            cursor: pointer;
        }

        .msg {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(255, 0, 0, 0.8);
            color: white;
            padding: 15px 30px;
            border-radius: 10px;
            font-size: 15px;
            z-index: 10;
            max-width: 300px;
            text-align: center;
        }

        .msg.success {
            background-color: rgba(0, 128, 0, 0.8);
        }
    </style>
</head>
<body>

<div>
    <h2>Cadastro</h2>
    <form method="POST" action="logica_cadastro.php">
        <input type="text" name="nome" placeholder="Nome" required />
        <input type="text" name="login" placeholder="email" required />
        <input type="text" name="telefone" placeholder="Telefone" required />
        <input type="password" name="senha" placeholder="Senha" required />
        <button type="submit">Cadastrar</button>
        <button type="submit">Ir para Login</button>
    </form>
</div>

</body>
</html>
