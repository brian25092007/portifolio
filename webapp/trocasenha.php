<?php
    if(isset($_POST['submit'])){
        include_once('conexao_db_php.php');

        $senha_atual = $_POST['senha_atual'];
        $nova_senha = $_POST['nova_senha'];
        $confirma_senha = $_POST['confirma_senha'];

        if($nova_senha == $confirma_senha) {
            $result = mysqli($conexao,'UPDATE senha WHERE');
        }


    }

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Trocar Senha</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: grey;
        }

        .form-container {
            background-color: rgba(0, 0, 0, 0.8);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 80px;
            border-radius: 15px;
            color: #fff;
            width: 350px;
            box-sizing: border-box;
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
        }

        button:hover {
            background-color: darkblue;
            cursor: pointer;
        }

        .msg {
            position: absolute;
            top: 30px;
            left: 50%;
            transform: translateX(-50%);
            width: 350px;
            text-align: center;
            padding: 15px;
            border-radius: 10px;
            font-size: 14px;
            z-index: 1;
        }

        .error {
            background-color: #ff4d4d;
            color: white;
        }

        .success {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>

<?php
$msg = "";
$msg_class = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senha_atual_correta = "senha123"; // senha fixa de teste

    $senha_atual = $_POST['senha_atual'] ?? '';
    $nova_senha = $_POST['nova_senha'] ?? '';
    $confirma_senha = $_POST['confirma_senha'] ?? '';

    if (!$senha_atual || !$nova_senha || !$confirma_senha) {
        $msg = "Por favor, preencha todos os campos.";
        $msg_class = "error";
    } elseif ($senha_atual !== $senha_atual_correta) {
        $msg = "Senha atual incorreta.";
        $msg_class = "error";
    } elseif ($nova_senha !== $confirma_senha) {
        $msg = "A nova senha e a confirmação não coincidem.";
        $msg_class = "error";
    } elseif (strlen($nova_senha) < 6) {
        $msg = "A nova senha deve ter pelo menos 6 caracteres.";
        $msg_class = "error";
    } else {
        $msg = "Senha alterada com sucesso!";
        $msg_class = "success";
        $_POST = [];
    }
}
?>

<?php if ($msg): ?>
    <div class="msg <?= $msg_class ?>">
        <?= htmlspecialchars($msg) ?>
    </div>
<?php endif; ?>

<div class="form-container">
    <h2>Trocar Senha</h2>
    <form method="POST" action="">
        <input type="password" name="senha_atual" placeholder="Senha Atual" required />
        <input type="password" name="nova_senha" placeholder="Nova Senha" required />
        <input type="password" name="confirma_senha" placeholder="Confirmar Nova Senha" required />
        <button type="submit">Alterar Senha</button>
    </form>
</div>

</body>
</html>
