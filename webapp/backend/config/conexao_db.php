<?php 
$localhost = 'localhost';
$username = 'root';
$password = '';
$database = 'bd_crud_php';

$conexao = new mysqli($localhost, $username, $password, $database);

if ($conexao->connect_error) {
    die('Falha na conexão: ' . $conexao->connect_error);
}
?>
