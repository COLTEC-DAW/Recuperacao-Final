<?php 
    include "conexao.php";

    $conexao = new Conexao();

    if(isset($_POST['login-action'])){
        $login = $_POST['login'];
        $senha = $_POST['senha']; 
        $sql = "SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'";
        $mysqli_query = mysqli_query($conexao->get_connection(), $sql) or die(mysqli_error($this->conexao));

        $quantidade = mysqli_num_rows($mysqli_query);
        if($quantidade == 1){

            $usuario = mysqli_fetch_assoc($mysqli_query);
            if(!isset($_SESSION)){
                session_start();
            }
            $_SESSION['id'] = $usuario['id'];
            
            header("Location: index.php");

        }   else{
            setcookie("message", "Falha ao Logar");
            header("Location: login.php");
        }

    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container-fluid">
        <h1>Login:</h1>
        <?php
            if(isset($_COOKIE['message'])){
                $message = $_COOKIE['message'];
                setcookie("message", "", time() - 3600);
            }
        ?>
        <?php if(isset($message)){?>
            <p><b><?= $message ?></b></p>
        <?php } ?>
        <form class="form-label" action="login.php" method="post">
            <label for="id">Login:</label> <br>
            <input class="form-label" type="text" name="login" required> <br>
            <label for="id">Senha:</label> <br>
            <input class="form-label" type="password" name="senha" required> <br>
            <input type="hidden" name="login-action" value="login-action">
            <input class="btn btn-primary btn small" type="submit" value="Login">
        </form>
        <p><a href="index.php">Página Inicial</a></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>