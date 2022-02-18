<?php
if (isset($_POST["enviar"])) {
    $nome = $_POST["nome"];
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    $confirmaSenha = $_POST["confirmaSenha"];

    require_once 'dbconnection.inc.php';
    require_once 'functions.inc.php';

    /*Tratamento de erros*/
    if (campoVazioSignup($nome, $usuario, $senha, $confirmaSenha) !== false) {
        header("location: ../signup.php?error=emptyField");
        exit();
    }
    if (nomeInvalido($nome) !== false) {
        header("location: ../signup.php?error=invalidNome");
        exit();
    }
    if (confereSenhas($senha, $confirmaSenha) !== false) {
        header("location: ../signup.php?error=senhasNaoConferem");
        exit();
    }
    if (usuarioExiste($conn, $usuario) !== false) {
        header("location: ../signup.php?error=usuarioJaExiste");
        exit();
    }

    criarUsuario($conn, $nome, $usuario, $senha);

} else {
    header("location: ../signup.php");
    exit();
}