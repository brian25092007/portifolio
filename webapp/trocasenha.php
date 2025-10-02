<?php
    include_once('conexao_db.php');
    session_start();

    if(isset($_POST['submit'])){

        $confirm_password = $_POST['confirma_senha'];
        $password = $_POST['senha_atual'];
        $new_password = $_POST['nova_senha'];

        if($new_password==$confirm_password && $password == $_SESSION['senha']){
            $result = 'UPDATE usuarios SET senha="'.$new_password.'" WHERE login="'.$_SESSION['usuario'].'"';
            if(mysqli_query($conexao, $result)){
                echo "<script>alert('Password updated successfully');</script>";
                $_SESSION['senha'] = $new_password;
            } else {
                echo "<script>alert('Error updating password');</script>";
            }
        }
        else{
            echo $password;
            echo $_SESSION['senha'];
            echo '';
            echo $new_password;
            echo $confirm_password;
            echo "<script>alert('Passwords do not match');</script>";
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


<div class="form-container">
    <h2>Trocar Senha</h2>
    <form method="POST" action="trocasenha.php">
        <input type="password" name="senha_atual" placeholder="Senha Atual" required />
        <input type="password" name="nova_senha" placeholder="Nova Senha" required />
        <input type="password" name="confirma_senha" placeholder="Confirmar Nova Senha" required />
        <button type="submit" name="submit">Alterar Senha</button>
    </form>
</div>

</body>
</html>
