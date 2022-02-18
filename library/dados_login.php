<?php 
session_start();
require_once 'conexao.php';


// Se houve um post com usuario e senha de login, seta a variavel
$p_usuario = $_POST['l_usuario'] ?? NULL;
$p_senha = $_POST['l_senha'] ?? NULL; 

// Seta as variaveis da sessão caso o login e senha existam no BDD
if ( $conexaoDAO->usuarioSenhaExistemBDD($conexao, $p_usuario, $p_senha) ){        

    $row = $conexaoDAO->getUsuario($conexao, $p_usuario, $p_senha);
    $_SESSION['nome'] = $row['nome'];
    $_SESSION['usuario'] = $row['usuario'];
    $_SESSION['senha'] = $row['senha'];
    $_SESSION['logged'] = true;
} else {
    $_SESSION['erro_login'] = true;
}

header('Location: /recuperação_final');
 
?>

