<?php
session_start(),
include('conexao_db.php');
echo 'logado:' . $_SESSION{'nome'};
?>