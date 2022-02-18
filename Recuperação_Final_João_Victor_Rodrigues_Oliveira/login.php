<?php
    include "conexao.php";
    include "usuarioDAO.php";
    session_start();

    $string = null;
    $conexao = new Conexao();
    $usuarioDAO = new UsuarioDAO($conexao->get_connection());

    if (isset($_POST["login"]) && isset($_POST["senha"])) {
        $login = $_POST["login"];
        $senha = $_POST["senha"];

        if (empty($login) || empty($senha)) {
            $string = "Algum dado não foi enviado. Por favor, coloque todas as informacoes pedidas.";
        } else {
            $user = $usuarioDAO->login($login, $senha);

            if ($user != null) {
                $_SESSION["login"] = $user->get_login();
                $_SESSION["id"] = intval($user->get_id());

                header("Location: /Recuperação_Final_João_Victor_Rodrigues_Oliveira/index.php");
            }
            else {
                $string = "Verifique o login e a senha inseridos";
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
    <title>Login - Meu Querido Diário</title>
</head>

<body class="container">
    <h1>Login</h1>
    <?php
    if ($string != null) echo "<h4>" . $string . "</h4>";
    ?>
    <div class="form">
        <form method="post">
            <label for="id">Login:</label>
            <input type="text" name="login" tabindex="0"><br><br>

            <label for="id">Senha:</label>
            <input type="password" name="senha" tabindex="0"><br><br>

            <input type="submit" value="Entrar">
        </form>
    </div>

    <br>
    <hr>

    <div class="register">
        <p>Não tem uma conta?</p>
        <a href="cadastro.php"><button>Cadastre-se</button></a>
    </div>
</body>

</html>