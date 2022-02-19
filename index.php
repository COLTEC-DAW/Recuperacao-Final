<?php

    include "conexao.php";
    include "usuarioDAO.php";
    include "pensamentoDAO.php";

    $conexao = new Conexao();
    $usuarioDAO = new UsuarioDAO($conexao->get_connection());

    if(!isset($_SESSION)){
        session_start();
    }

    //manipulação dos dados
    $reqType = $_SERVER["REQUEST_METHOD"];
    if(isset($_POST['signup-action'])) {
        $new_user = new Usuario(
                $id = null,
                $nome = $_POST["nome"],
                $login = $_POST["login"],
                $senha = $_POST["senha"]
        );

        $usuarioDAO->add($new_user);
    }

    if(isset($_POST['pensamento-action'])){
        $novo_pensamento = new Pensamento(
            $id = null,
            $pensamento = $_POST['pensamento'],
            $created_at = date('Y-m-d H:i:s'),
            $categoria_id = $_POST['categoria'],
            $usuario_id = $_SESSION['id']
        );
        var_dump($categoria_id);
        $usuarioDAO->novoPensamento($novo_pensamento);
        var_dump($usuarioDAO);
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello, MySQL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <h1>Diario Online</h1>
        <h4>Bem Vindo!!&#128540;</h4>
        <h5>Opções:</h5>
        <?php
            if(isset($_COOKIE['message'])){
                $message = $_COOKIE['message'];
                setcookie("message", "", time() - 3600);
            }
        ?>
        <?php if(isset($message)){?>
            <div class="alert alert-success col-4" role="alert">
                <?= $message ?>
            </div>
        <?php } ?>
        
        <ul>
            <?php
                if(!isset($_SESSION['id'])){
                    echo "<li><a href=\"signup.html\">Cadastrar usuário</a></li>";
                    echo "<li><a href=\"login.php\">login</a></li>";
        
                }   else {
                    echo "<li><a href=\"listaPensamentos.php\">Lista Pensamentos</a></li>";
                    echo "<li><a href=\"criar-pensamento.php\">Novo Pensamento</a></li>";
                    echo "<li><a href=\"logout.php\">logout</a></li>";
        
                }
            ?>
        </ul>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>