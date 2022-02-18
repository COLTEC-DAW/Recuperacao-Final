<?php
if (isset($_POST["enviar"])) {
    $novoTexto = $_POST["texto"];
    $categoria = $_POST["categoria"];

    require_once 'dbconnection.inc.php';
    require_once 'functions.inc.php';

    /*Tratamento de erros*/
    if (campoVazioLogin($novoTexto, $categoria)) {
        header("location: ../escrever.php?error=emptyText");
        exit();
    }

    criarPensamento($conn, $novoTexto, $categoria);

} else {
    header("location: ../escrever.php");
    exit();
}