<?php
    require 'classes.php';
    session_start();

    if (isset($_SESSION["UID"])){
        header('location: userpage.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" type="text/css">
    <title>Home|Meu Querido Diário</title>
</head>
<body>
    <?php require 'header.inc'; ?>

    <div class='container'>
        <h2>Registre e organize seus pensamentos, ideias e acontecimentos neste diário online.</h2>
        <a href="./signup.php" class='btn_green_big'>Crie uma conta grátis</a>
    </div>
</body>
</html>