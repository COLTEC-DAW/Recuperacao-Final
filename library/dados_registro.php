<?php 
session_start();
require_once 'conexao.php';

// Se houve um post com usuario e senha de registro, seta a variavel
$r_nome = $_POST['r_nome'] ?? NULL;
$r_usuario = $_POST['r_usuario'] ?? NULL;
$r_senha = $_POST['r_senha'] ?? NULL;


// Seta as variaveis da sessão caso o login exista no BDD
if ( $conexaoDAO->usuarioExisteBDD($conexao, $r_usuario) ){        
    $_SESSION['usuario_existe'] = true;
    header ('Location: /recuperação_final/form_registro.php');
} else {
    
    $conexaoDAO->insereRegistroUsuario($conexao, $r_nome, $r_usuario, $r_senha);
    $_SESSION['registro_sucesso'] = true;

    // Envia o usuário de volta pra página principal
    header ('Location: /recuperação_final/index.php');
}

?>