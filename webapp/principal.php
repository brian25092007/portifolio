<?php
session_start();
include('conexao_db.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$login = $_SESSION['usuario'];

// Atualiza a quantidade de acessos
$sql = "UPDATE usuarios SET quant_acesso = quant_acesso + 1 WHERE login = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("s", $login);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Principal</title>
</head>
<body>
    <div>deu certo</div>
</body>
</html>

