<?php
$login = $_POST['login'];
$senha = $_POST['senha'];
$nome  = $_POST['nome'];

include('conexao_db.php');

$sql = "INSERT INTO usuarios (login, senha, nome, tipo, quant_acesso, statuts) 
        VALUES ('$login', '$senha', '$nome', 1, 0, 'A')";

if (mysqli_query($conexao, $sql)) {
    echo "Usuário cadastrado com sucesso!";
} else {
    echo "Erro: " . mysqli_error($conexao);
}

header('Location: login.php');

mysqli_close($conexao);
?>
