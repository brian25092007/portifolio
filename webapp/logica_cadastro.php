<?php
    session_start();
    if(isset($_POST['login'])){

        include_once('conexao_db.php');

        $email = $_POST['login'];
        $password = $_POST['senha'];
        $name = $_POST['nome'];
        $number = $_POST['telefone'];

        if (mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM usuarios WHERE login='$email'")) > 0) {
            echo "<script>alert('Email already registered. Please use a different email.');</script>";
        } else {
            $result = mysqli_query($conexao, "INSERT INTO usuarios(login, senha, nome, quant_acesso) VALUES('$email', '$password', '$name', 0)");
        }
        header ('Location: login.php');
         $_SESSION['email'] = $email;
         $_SESSION['senha'] = $senha;
         $_SESSION['login'] = $login;
         $_SESSION['telefone'] = $telefone;
         $_SESSION['nome'] = $nome;
    }

?>