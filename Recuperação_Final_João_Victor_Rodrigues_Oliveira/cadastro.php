<?php
    session_start();

    $string = null;
    $verifica = true;
    $reqType = $_SERVER["REQUEST_METHOD"];
    $adicionou = false;

    include "conexao.php";
    include "usuarioDAO.php";

    $conexao = new Conexao();
    $usuarioDAO = new UsuarioDAO($conexao->get_connection());

    if ($reqType == 'POST' && isset($_POST["nome"]) && isset($_POST["login"]) && isset($_POST["senha"])) {
        foreach ($_POST as $post) {
            if (empty($post) && $post != 0) {
                $verifica = false;
                $string = "Algum dado não foi enviado. Por favor, coloque todas as informacoes pedidas.";
            }
        }
        
        if ($verifica != false) {
            $res = mysqli_query($conexao->get_connection(), "SELECT MAX(id) FROM usuarios;");
            $coluna = mysqli_fetch_array($res);

            $novo_usuario = new Usuario(
                $id = (intval($coluna[0]) + 1),
                $nome = $_POST["nome"],
                $login = $_POST["login"],
                $senha = $_POST["senha"],
            );

            $adicionou = $usuarioDAO->add($novo_usuario);

            if ($adicionou){
                header("Location: /Recuperação_Final_João_Victor_Rodrigues_Oliveira/login.php");
            } else{
                $string = "Algo deu errado. :|";
            }
        }
    }
    mysqli_close($conexao->get_connection());
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Meu Querido Diário</title>
</head>
<body>

    <h1>Cadastro de novo usuário</h1>
    <?php
    if ($string != null) echo "<h4>" . $string . "</h4>";
    ?>
    <form method="post">            
        <label for="id">Nome:</label>
        <input type="text" name="nome" tabindex="0"><br><br>
        
        <label for="id">Login:</label>
        <input type="text" name="login" tabindex="0"><br><br>
        
        <label for="id">Senha:</label>
        <input type="password" name="senha" tabindex="0"><br><br>
        
        <input type="submit" value="Cadastrar">
    </form>

    <br><hr>

    <div class="login">
        Já tem uma conta?  
        <a href="login.php"><button>Login</button></a>
    </div>
</body>
</html>