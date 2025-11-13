<?php
    session_start();
    include_once('../backend/config/conexao_db.php');

    if(isset($_POST['submit'])){

        $confirm_password = $_POST['confirma_senha'];
        $password = $_POST['senha_atual'];
        $new_password = $_POST['nova_senha'];

        if($new_password==$confirm_password && $password == $_SESSION['senha']){
            $result = 'UPDATE usuarios SET senha="'.$new_password.'" WHERE login="'.$_SESSION['usuario'].'"';
            if(mysqli_query($conexao, $result)){
                echo "<script>alert('Senha alterada com sucesso!');</script>";
                $_SESSION['senha'] = $new_password;
            } else {
                echo "<script>alert('Erro ao alterar senha');</script>";
            }
        }
        else{
            echo "<script>alert('As senhas não correspondem ou senha atual está incorreta');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trocar Senha</title>
    <!-- Added external CSS link -->
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="password-wrapper">
        <div class="password-container">

            <form method="POST" action="trocasenha.php">
                <div class="form-group">
                    <label for="senha_atual">Senha Atual</label>
                    <input type="password" id="senha_atual" name="senha_atual" placeholder="Digite sua senha atual" required>
                </div>

                <div class="form-group">
                    <label for="nova_senha">Nova Senha</label>
                    <input type="password" id="nova_senha" name="nova_senha" placeholder="Digite a nova senha" required>
                </div>

                <div class="form-group">
                    <label for="confirma_senha">Confirmar Nova Senha</label>
                    <input type="password" id="confirma_senha" name="confirma_senha" placeholder="Confirme a nova senha" required>
                </div>

                <button type="submit" name="submit">Alterar Senha</button>
            </form>

            <div class="link-section">
                <p><a href="index.php">Voltar ao login</a></p>
            </div>
        </div>
    </div>
</body>
</html>
