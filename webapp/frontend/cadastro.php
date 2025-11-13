<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-blue: #0066cc;
            --dark-blue: #004399;
            --light-blue: #e6f2ff;
            --white: #ffffff;
            --gray-light: #f5f5f5;
            --gray-medium: #808080;
            --gray-dark: #333333;
            --border-radius: 12px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--light-blue) 0%, var(--gray-light) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .signup-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }

        .signup-container {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: 0 8px 32px rgba(0, 102, 204, 0.15);
            width: 100%;
            max-width: 420px;
            padding: 50px 40px;
            border: 2px solid var(--light-blue);
        }

        .logo-section {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo-icon {
            width: 60px;
            height: 60px;
            background: var(--primary-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 32px;
            color: var(--white);
            font-weight: bold;
        }

        .logo-section h1 {
            color: var(--gray-dark);
            font-size: 32px;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .logo-section p {
            color: var(--gray-medium);
            font-size: 14px;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            color: var(--gray-dark);
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid var(--light-blue);
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
            font-family: inherit;
            color: var(--gray-dark);
        }

        input::placeholder {
            color: #aaa;
        }

        input:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
            background-color: #fafbff;
        }

        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        button {
            flex: 1;
            padding: 14px 16px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-family: inherit;
        }

        .btn-primary {
            background-color: var(--primary-blue);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: var(--dark-blue);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 102, 204, 0.3);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .link-section {
            text-align: center;
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid var(--light-blue);
        }

        .link-section a {
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
        }

        .link-section a:hover {
            color: var(--dark-blue);
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .signup-container {
                padding: 40px 25px;
            }

            .logo-section {
                margin-bottom: 30px;
            }

            .logo-section h1 {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <div class="signup-wrapper">
        <div class="signup-container">

            <form method="POST" action="../backend/auth/logica_cadastro.php">
                <div class="form-group">
                    <label for="nome">Nome Completo</label>
                    <input type="text" id="nome" name="nome" placeholder="Seu nome completo" required>
                </div>

                <div class="form-group">
                    <label for="login">Email</label>
                    <input type="email" id="login" name="login" placeholder="seu.email@exemplo.com" required>
                </div>

                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="tel" id="telefone" name="telefone" placeholder="(11) 99999-9999" required>
                </div>

                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Mínimo 6 caracteres" required>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn-primary">Cadastrar</button>
                </div>
            </form>

            <div class="link-section">
                <p>Já tem conta? <a href="index.php">Fazer login</a></p>
            </div>
        </div>
    </div>
</body>
</html>
