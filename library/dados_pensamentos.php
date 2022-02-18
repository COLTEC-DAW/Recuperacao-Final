<?php 
session_start();
require_once 'conexao.php';

// Se houve um post com pensamento então atualizo a variavel
$p_pensamento = $_POST['pensamento'] ?? NULL;
$p_categoria_id = $_POST['categoria_id'] ?? NULL;

$conexaoDAO->insereRegistroPensamento($conexao, $p_pensamento, $p_categoria_id, $_SESSION['usuario']);

header ("Location: /recuperação_final/data_table.php");

?>