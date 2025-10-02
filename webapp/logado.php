<?php
session_start();
include('conexao_db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $sql = "SELECT * FROM usuarios WHERE login = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        // Comparação direta da senha (texto puro)
        if ($senha === $usuario['senha']) {
            $_SESSION['usuario'] = $usuario['login'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['senha'] = $usuario['senha'];
            header('Location: principal.php');
            exit;
        } else {
            header('Location: login.php?error&erro=senha');
            exit;
        }
    } else {
        header('Location: login.php?error&erro=usuario&login=' . urlencode($login));
        exit;
    }
}
?>
