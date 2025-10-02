<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="logado.php" method="POST">
        <div>
            <h1>Login</h1>

            <?php if (isset($erro)): ?>
                <div class="erro"><?php echo $erro; ?></div>
            <?php endif; ?>

            <input type="text" name="login" placeholder="Login" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <br><br>
            
            <?php
                if (isset($_GET['error'])) {
                    $errors = [
                        1 => 'E-mail ou senha incorretos!',
                        3 => 'Conta bloqueada! Tente novamente em 30 minutos.'
                    ];
                    echo '<div class="alert alert-danger">' . $errors[$_GET['error']];
                    
                    echo '</div>';
                }
                
                if (isset($_GET['success'])) {
                    echo '<div class="alert alert-success">Cadastro feito com sucesso</div>';
                }
            ?>

            <!-- Botão de login -->
            <button type="submit">Entrar</button>

            <!-- Botão de trocar senha que redireciona -->
            <button type="button" onclick="window.location.href='trocasenha.php'">
                Trocar Senha
            </button>
        </div>
    </form>
</body>
</html>
