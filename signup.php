<?php
    require 'classes.php';
    session_start();

    $conexao = mysqli_connect("localhost", "root", "", "MeuQueridoDiario");

    //Cadastro
    $reqType = $_SERVER["REQUEST_METHOD"];
    if($reqType == 'POST'){
        if (!empty($_POST["nome"]) && !empty($_POST["login"]) && !empty($_POST["senha"]))
        {
            $nome = $_POST["nome"];
            $login = $_POST["login"];
            $senha = $_POST["senha"];
            $res_insert = mysqli_query($conexao, "INSERT INTO usuarios (nome,login,senha) VALUES (\"$nome\",\"$login\",\"$senha\")");
            
            //automatic login
            $resultado = mysqli_query($conexao, "SELECT usuarios.id, usuarios.nome, usuarios.login FROM usuarios WHERE login = \"".$_POST["login"]."\" AND senha = \"".$_POST["senha"]."\" ");
            $row = mysqli_fetch_array($resultado);
            if ($resultado == FALSE || $row == NULL) {echo "Dados de login incorretos.";}
            else {$_SESSION["UID"] = new User($row["id"],$row["nome"],$row["login"]);}

            header('location: userpage.php');
        }
    }
    //Selecao
    $resultado = mysqli_query($conexao, "SELECT usuarios.nome, usuarios.login, pensamentos.pensamento, pensamentos.criado_em FROM usuarios JOIN pensamentos ON usuarios.id = pensamentos.usuarios_id");
    $num = mysqli_num_rows($resultado);

    mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" type="text/css">
    <title>Signup|Meu Querido Diário</title>
</head>
<body>
    <?php require 'header.inc'; ?>
    <div class='container'>
    <h2>Criar conta</h2>
        <form action="signup.php" method="post" id="form-registrar">
            <input type="text" name="nome" placeholder="Nome do usuário" autocomplete="off" required><br>
            <input type="text" name="login" placeholder="Login" autocomplete="off" maxlength="10" required><br>
            <input type="password" name="senha" placeholder="Senha" autocomplete="off" required><br>
            <input type="submit" name="registrar" value="Registrar" class='btn_green_big'>
        </form>
    </div>
</body>
</html>