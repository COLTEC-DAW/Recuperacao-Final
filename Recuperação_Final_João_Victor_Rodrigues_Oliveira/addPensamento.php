<?php
    session_start();

    date_default_timezone_set('America/Sao_Paulo');

    $string = null;
    $verifica = true;
    $reqType = $_SERVER["REQUEST_METHOD"];
    $adicionou = false;

    include "conexao.php";
    include "pensamentoDAO.php";

    $conexao = new Conexao();
    $pensamentoDAO = new PensamentoDAO($conexao->get_connection());

    if ($reqType == 'POST' && isset($_POST["thought"]) && isset($_POST["category"])) {
        foreach ($_POST as $post) {
            if (empty($post) && $post != 0) {
                $verifica = false;
                $string = "Algum dado não foi enviado. Por favor, coloque todas as informacoes pedidas.";
            }
        }
        
        if ($verifica != false) {
            $res = mysqli_query($conexao->get_connection(), "SELECT MAX(id) FROM pensamentos;");
            $coluna = mysqli_fetch_array($res);
            
            $novo_pensamento = new Pensamento(
                $id = (intval($coluna[0]) + 1), // O ID será o ID do último pensamento mais 1
                $pensamento = $_POST["thought"],
                $criado_em = date('Y-m-d H:i:s'),
                $categorias_id = $_POST["category"],
                $usuarios_id = $_SESSION["id"]
            );

            $adicionou = $pensamentoDAO->add($novo_pensamento);
            if ($adicionou){            
                setcookie(("lastThought" . $_SESSION["login"]), date('j/n/Y, g:i a'), time() + (86400 * 30), '/');
                header("Location: ./index.php");
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
    <title>Adicionar pensamento - Meu Querido Diário</title>
</head>
<body>
    <?php include "./menu.inc"; ?>
    <h1>Adicionar novo pensamento</h1>
    <?php
    if ($string != null) echo "<h4>" . $string . "</h4>";
    ?>
    <form method="post">
        <label for="id">Pensamento:</label>
        <input type="text" name="thought" id=""> <br><br>
        
        <label for="id">Categoria do pensamento:</label> <br>
        <input type="radio" name="category" value="0" checked> Pessoal <br>
        <input type="radio" name="category" value="1"> Família <br>
        <input type="radio" name="category" value="2"> Trabalho <br>
        <input type="radio" name="category" value="3"> Sem categoria <br><br>
        
        <input type="submit" value="Enviar">
    </form>
</body>
</html>