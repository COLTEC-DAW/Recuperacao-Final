<?php

if(isset($_POST["enviar"])) {
    $username = $_POST["usuario"];
    $senha = $_POST["senha"];

    require_once "dbconnection.inc.php";
    require_once "functions.inc.php";

    /*Tratamento de erros*/
    if (campoVazioLogin($username, $senha) !== false) {
        header("location: ../login.php?error=emptyField");
        exit();
    }

    loginUsuario($conn, $username, $senha);
}
else {
    header("location: ../login.php");
    exit();
}
?>